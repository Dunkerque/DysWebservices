<?php
/**
 * Created by PhpStorm.
 * User: vdmdev12
 * Date: 11/03/2016
 * Time: 18:32
 */

namespace Webservice\ServicesBundle\Services\Adresse;

use Doctrine\ORM\EntityManager;
use JMS\Serializer\Serializer;
use Metadata\Tests\Driver\Fixture\A\A;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Webservice\MainBundle\Entity\Address;
use Webservice\MainBundle\Entity\User;

;



class Adresses extends Controller
{
    /**
     * @var EntityManager
     */
    protected $em;

    protected $serializer;

    public function __construct(EntityManager $em, Serializer $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    /**
     * pour créer une adresse
     *
     * @param $idUser
     * @param $numbre
     * @param $avenue
     * @param $complement
     * @param $city
     * @param $postcode
     * @return string
     */
    public function createAdresse($idUser,$numbre,$avenue,$complement,$city, $postcode)
    {

        $user =$this->em->getRepository("WebserviceMainBundle:User")->find($idUser);

        if ($user) {
            $adresse = new Address();
            $adresse->setIdUser($user);
            $adresse->setNumbre($numbre);
            $adresse->setAvenue($avenue);
            $adresse->setComplement($complement);
            $adresse->setCity($city);
            $adresse->setPostcode($postcode);

            $this->em->persist($adresse);
            $this->em->flush();

            return "l'adresse est bien enrengistré";
        }

        return 'erreur';
    }

    /**
     * supprimer un adresse
     *
     * @param $idAdress
     * @return string
     */
    public function deleteAdresse($idAdress)
    {
        $addresse =$this->em->getRepository("WebserviceMainBundle:Address")->find($idAdress);

        $this->em->remove($addresse);

        $this->em->flush();
        return "l'adresse a été bien supprimée ";
    }

    /**
     * recuperer toutes les adresses d'un user
     * @param $idUser
     * @return array
     */

    public function getAddressUser($idUser)
    {
        $user = $this->em->getRepository("WebserviceMainBundle:User")->find($idUser);
        $adresse = $this->em->getRepository("WebserviceMainBundle:Address")->findAdressUser($idUser,$user);

        $adresse= $this->serializer->toArray($adresse);

        return $adresse;
    }


    /**
     * Met à jour l'adresse d'un user
     *
     * @param $idAdress
     * @param $numbre
     * @param $avenue
     * @param $complement
     * @param $city
     * @param $postcode
     * @return string
     */
    public function updateAdress($idAdress,$numbre,$avenue,$complement,$city, $postcode)
    {
        $adress =$this->em->getRepository("WebserviceMainBundle:Address")->find($idAdress);

        $user = $adress->getIdUser();

        if ($adress) {
            $adress = new Address();
            $adress->setIdUser($user);
            $adress->setNumbre($numbre);
            $adress->setAvenue($avenue);
            $adress->setComplement($complement);
            $adress->setCity($city);
            $adress->setPostcode($postcode);

            $this->em->flush();
            return "'l adresse est  à jour '";
         }

        return 'l adresse est  à jour ';
    }

}