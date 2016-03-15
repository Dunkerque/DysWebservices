<?php
/**
 * Created by PhpStorm.
 * User: vdmdev12
 * Date: 11/03/2016
 * Time: 18:32
 */

namespace Webservice\ServicesBundle\Services\Film;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use JMS\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\All;
use Webservice\MainBundle\Entity\Film;
use Webservice\ServicesBundle\Libs\Allocine\AllocineApi;


/**
 * @Doctrine\ORM\Mapping\Entity
 * @Doctrine\ORM\Mapping\Table(name="film")
 */
class Films extends Controller
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Films constructor.
     * @param EntityManager $em
     * @param Serializer $serializer
     * @param ContainerInterface $container
     */
    public function __construct(EntityManager $em, Serializer $serializer, ContainerInterface $container)
    {
        $this->em = $em;
        $this->serializer = $serializer;
        $this->container = $container;
    }


    /**
     * Créer un film pour une scéance
     *
     * @param string $title
     * @param string $category
     * @param string $isan
     * @param string $description
     * @param string $image
     * @return string
     */
    public function createFilm($title, $category, $isan, $description, $image)
    {
        $film = new Film();
        $filmExist = $this->findFilmByTitle($title);
        if($filmExist)
        {
            $film->setTitle($title);
            $film->setCategory($category);
            $film->setIsan($isan);
            $film->setDescription($description);
            $film->setImage($image);

            $this->em->persist($film);
            $this->em->flush();

            return "Le film ".$title." a bien été créer";
        }

        return "Le film existe déjà";

    }

    /**
     * Récupère un film par son titre
     *
     * @param string $title
     * @return array|string
     */
    public function findFilmByTitle($title)
    {
        $filmTitle = $this->em->getRepository("WebserviceMainBundle:Film")->findBy(array("title" => $title));
        if(!$filmTitle) {
            return "Le film ".$title. " n'existe pas ";
        }
        //Convert l'object en array
        $title = $this->serializer->toArray($filmTitle);
        return $title;
    }


    /**
     * Récupèrere un film par son id
     *
     * @param int $id
     * @return array|null|object|string
     */
    public function findFilmById($id)
    {
        $filmId = $this->em->getRepository("WebserviceMainBundle:Film")->find($id);
        if(!$filmId) {
            return "Le film avec l".$id. "n'existe pas ";
        }
       $id = $this->serializer->serialize($filmId, 'json');
        $id = json_decode($id, true);
       return $id;
    }

    /**
     * Récupèrer un film par son titre ou son id
     *
     * @param int|string $idOrTitle
     * @return array|null|object|string
     */
    public function findFilmByIdOrTitle($idOrTitle)
    {
        if(is_int($idOrTitle)) {
            return $this->findFilmById($idOrTitle);
        }
        return $this->findFilmByTitle($idOrTitle);
    }


    /**
     * Récupère toutes les infos d'un film depuis Allocine
     *
     * @param string $name
     * @return array
     */
    public function getInfoFilmFromAllocine($name)
    {

        $allocine = new AllocineApi($this->container->getParameter("partner_key"), $this->container->getParameter("secret_key"));
        $name = $allocine->search($name, "movie");


        // l'object json qu'on récupère de l'Api Allocine contient des antislash
        // l'object semble être mal formaté
        // on le clean avec la fonction json_decode et l'option true pour avoir un array assoc
        $name      = json_decode($name, true);

        $film      = array();
        $infoFilm  = array();
        $infoSynopsis = array();
        foreach($name["feed"]["movie"] as $info) {

           $code   = $info["code"];

           $synopsis =  $allocine->get($code, "movie");
           $infoSynopsis[] = json_decode($synopsis, true);

        }
        $infoFilm["film"]  = $name;
        $infoFilm["synopsis"] = $infoSynopsis;

        $film["Films"] = $infoFilm;

        return $film;
    }

//    public function getInfoFilm($name)
//    {
//        $allocine = new AllocineApi($this->container->getParameter("partner_key"), $this->container->getParameter("secret_key"));
//        $result = $allocine->search($name, "movie");
//
//        $film = json_decode($result, true);
////        dump($film); exit();
//        $infoFilm = array();
//        $res = array();
//        foreach($film["feed"]["movie"] as $item) {
//            $infoFilm[] = $item["originalTitle"];
//            $infoFilm[] = $item["code"];
//            $infoFilm[] = $item["productionYear"];
//            $infoFilm[] = $item["castingShort"]["directors"];
//
//        }
//        dump($infoFilm);
//
//    }

    /**
     * Récupère les films par leur genre
     *  ex: action|comedie etc ...
     *
     * @param $genre
     * @return array|mixed|string
     */
    public function findFilmByGenre($genre) {
        $em = $this->em;
        $film = $em->getRepository("WebserviceMainBundle:Film")->findBy(array("category" => $genre));
        if(!$film) {
            return "aucun résultat pour le genre " . $genre;
        }
        $genre = array();
        $film = $this->serializer->serialize($film, "json");
        //$genre["genre"] = $film;
        $film = json_decode($film, true);
        return $film;
    }
}