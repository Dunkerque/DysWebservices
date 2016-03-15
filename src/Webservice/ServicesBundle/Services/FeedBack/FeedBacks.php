<?php
/**
 * Created by PhpStorm.
 * User: vdmdev12
 * Date: 11/03/2016
 * Time: 18:32
 */

namespace Webservice\ServicesBundle\Services\FeedBack;

use Doctrine\ORM\EntityManager;
use JMS\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Webservice\MainBundle\Entity\Feedback;
use Webservice\MainBundle\Repository\FeedbackRepository;



class FeedBacks extends Controller
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
     * Créer un feedback
     *
     * @param $idExaminer
     * @param $idTarget
     * @param $typeFeedBack
     * @param $evaluation
     * @param $rating
     * @return Response
     */
    public function createFeedBack($idExaminer ,$idTarget,$typeFeedBack,$evaluation,$rating)
    {

        $examine =$this->em->getRepository("WebserviceMainBundle:User")->find($idExaminer);

        $feedBack= new Feedback();
        $feedBack->setIdExaminer($examine);
        $feedBack->setIdTarget($idTarget);
        $feedBack->setTypeFeedback($typeFeedBack);
        $feedBack->setEvaluation($evaluation);
        $feedBack->setRating($rating);

        $this->em->persist($feedBack);
        $this->em->flush();

        return "le feedBack est bien enrigistré";
    }

    /**
     * recuperer les feed back d une seance
     *
     * @param $idSeance
     * @return array
     */
    public function getFeedBackSeance($idSeance)
    {
        $seances =$this->em->getRepository("WebserviceMainBundle:Feedback")->findAllFeedbackSeance($idSeance);
        if(!$seances) {
            return "Aucun feedback pour cette séance";
        }
        $seances = $this->serializer->toArray($seances);
        return $seances;
    }



    /**
     * supprimer le feedBack d'une séance
     *
     * @param $idSeance
     * @param $idExaminer
     * @return string
     */
    public function deleteFeedBackSeance($idFeedback,$idExaminer,$idSeance)
    {
        $seances =$this->em->getRepository("WebserviceMainBundle:Feedback")->findFbSeanceDelete($idFeedback,$idExaminer,$idSeance);
        if(!$seances) {
            return "Aucun feedback pour cette séance";
        }
        foreach($seances as $feedback)
        {
            $this->em->remove($feedback);
        }
        $this->em->flush();
        return "le feedBack a été bien supprimé ";
    }

    /**
     * recuperer les feed back d un film par rapport à une seance
     * @param $idFilm
     * @return array
     */
    public function getFeedBackFilm($idFilm)
    {
        $films =$this->em->getRepository("WebserviceMainBundle:Feedback")->findAllFeedbackFilm($idFilm);
        if(!$films) {
            return "Aucun feedback pour ce film";
        }
        $films = $this->serializer->toArray($films);
        return $films;
    }

    /**
     * delete le feedback d un film
     * @param $idFilm
     * @param $idExaminer
     * @param $idFeedback
     * @return string
     */
    public function deleteFeedBackFilm($idFeedback,$idExaminer,$idFilm)
    {
        $films =$this->em->getRepository("WebserviceMainBundle:Feedback")->findFbFilmDelete($idFeedback,$idExaminer,$idFilm);
        if(!$films) {
            return "Ce feedback n'existe pas";
        }
        foreach($films as $feedback)
        {
            $this->em->remove($feedback);
        }
        $this->em->flush();
        return "le feedBack a été bien supprimé ";
    }

    /**
     * recuperer les feed back d un user (participant ou bien organisateur)
     * @param $idUser
     * @return array
     */
    public function getFeedBackUser($idUser)
    {
        $users =$this->em->getRepository("WebserviceMainBundle:Feedback")->findAllFeedbackUser($idUser);
        if(!$users) {
            return "Ce feedback n'existe pas";
        }
        $users = $this->serializer->toArray($users);
        return $users;
    }

    /**
     * delete le feedback d un user ( pour supprimer l avais qu on a laisé à un user
     * @param $idUser
     * @param $idExaminer
     * @param $idFeedback
     * @return string
     */
    public function deleteFeedBackUser($idFeedback,$idExaminer,$idUser)
    {
        $users =$this->em->getRepository("WebserviceMainBundle:Feedback")->findFbUserDelete($idFeedback,$idExaminer,$idUser);
        if(!$users) {
            return "Ce feedback n'existe pas";
        }
        foreach($users as $feedback)
        {
            $this->em->remove($feedback);
        }
        $this->em->flush();
        return "le feedBack a été bien supprimé";
    }

    /**
     *  recuperer les feed back d un equipment
     * @param $idEquip
     * @return array
     */

    public function getFeedBackEquipment($idEquip)
    {
        $equipment =$this->em->getRepository("WebserviceMainBundle:Feedback")->findAllFeedbackEquipment($idEquip);
        if(!$equipment) {
            return "Ce feedback n'existe pas";
        }
        $equipment = $this->serializer->toArray($equipment);
        return $equipment;
    }

    /**
     * delete le feedback d un equipment
     * @param $idEquipment
     * @param $idExaminer
     * @param $idFeedback
     * @return string
     */
    public function deleteFeedBackEquipment($idFeedback,$idExaminer,$idEquip)
    {
        $Equipments =$this->em->getRepository("WebserviceMainBundle:Feedback")->findFbEquipmentDelete($idFeedback,$idExaminer,$idEquip);
        if(!$Equipments) {
            return "Ce feedback n'existe pas";
        }
        foreach($Equipments as $feedback)
        {
            $this->em->remove($feedback);
        }
        $this->em->flush();
        return "le feedBack a été bien supprimé ";
    }




}