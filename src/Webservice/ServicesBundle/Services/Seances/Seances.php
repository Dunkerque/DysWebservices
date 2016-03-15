<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 13/03/2016
 * Time: 16:17
 */

namespace Webservice\ServicesBundle\Services\Seances;


use Doctrine\ORM\EntityManager;
use JMS\Serializer\Serializer;
use Webservice\MainBundle\Entity\Seance;

/**
 * @Doctrine\ORM\Mapping\Entity
 * @Doctrine\ORM\Mapping\Table(name="seance")
 */
class Seances
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
     * Seances constructor.
     * @param EntityManager $em
     * @param Serializer $serializer
     */
    // TODO Add method to get film from a date
    public function __construct(EntityManager $em, Serializer $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    /**
     * Créer une séance
     *
     * @param $id_film
     * @param $id_organizer
     * @param $id_address
     * @param $start_Seance
     * @param $end_Seance
     * @param $nbrPlace
     * @param $price
     * @param $details
     * @param $rating
     * @return string
     */

    public function createSeance($id_film, $id_organizer, $id_address, $start_Seance, $end_Seance, $nbrPlace, $price, $details, $rating)
    {
        // TODO Add start_seance and end_seance date from client
        $em = $this->em;
        $id_film = $this->em->getRepository("WebserviceMainBundle:Film")->find($id_film);
        $id_organizer = $this->em->getRepository("WebserviceMainBundle:User")->find($id_organizer);
        $id_address = $this->em->getRepository("WebserviceMainBundle:Address")->find($id_address);
        $seance = new Seance();

        $seance->setIdFilm($id_film);
        $seance->setIdOrganizer($id_organizer);

        $seance->setIdAddress($id_address);

        $seance->setStartSeance(new \DateTime());

        $seance->setEndSeance(new \DateTime());

        $seance->setNbrPlace($nbrPlace);
        $seance->setPrice($price);
        $seance->setDetails($details);

        $seance->setRating($rating);

        $em->persist($seance);

        $em->flush();

        if($seance) {
            return "La séance a bien été créer";
        }
    }

    /**
     * Récupère toutes les séances gratuite
     *
     * @return array|string
     */
    public function getFreeSeance() {

        $seance = $this->em->getRepository("WebserviceMainBundle:Seance")->findBy(array("price" => 0));

        if(!$seance) {
            return "Il n'y a pas de séance gratuite en ce moment";
        }

        $seance = $this->serializer->toArray($seance);

        return $seance;
    }

    /**
     * Récupère toutes les séances payante
     *
     * @return array|string
     */
    public function getPaidSeance() {

        $seance = $this->em->getRepository("WebserviceMainBundle:Seance")->findSeanceNotFree();

        if(!$seance) {
            return "Il n'y a pas de séance payante en ce moment";
        }

        $seance = $this->serializer->toArray($seance);
        return $seance;
    }

    /**
     * Récupère tous les séance par le genre recherché
     *
     * @param string $genre
     * @return mixed|string
     */
    public function getFilmGenreBySeance($genre) {

        $seanceGenre = $this->em->getRepository("WebserviceMainBundle:Seance")->findSeanceByFilmGenre($genre);

        if(!$seanceGenre) {
            return "Il n'y a pas de séance avec le genre" . $genre;
        }
        $seance = $this->serializer->serialize($seanceGenre, "json");
        $seance = json_decode($seance, true);
        return $seance;

    }

}