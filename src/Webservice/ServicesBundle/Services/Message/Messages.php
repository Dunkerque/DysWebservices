<?php
/**
 * Created by PhpStorm.
 * User: vdmdev12
 * Date: 11/03/2016
 * Time: 18:32
 */

namespace Webservice\ServicesBundle\Services\Message;

use Doctrine\ORM\EntityManager;
use JMS\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Webservice\MainBundle\Entity\Message;



class Messages extends Controller
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
     * Créer un message
     * @param $idSend
     * @param $idRecived
     * @param $content
     * @return Response
     */
    public function createMessage($idSend, $idRecived, $content)
    {
        $sender =$this->em->getRepository("WebserviceMainBundle:User")->find($idSend);
        $recived =$this->em->getRepository("WebserviceMainBundle:User")->find($idRecived);

        $message= new Message();
            $message->setIdSend($sender);
            $message->setIdRecived($recived);
            $message->setContent($content);
            $message->setMsgRead(false);
            $message->setFlag(0); // 0 :message n'est pas supprimé ; 1 message supprimé par le sender ;2 par le recived; 3 supprimé par les 2
            $this->em->persist($message);
            $this->em->flush();
            return "le message  a bien été bien envoyé";
    }


    /**
     * recuperer les messages récus
     *
     * @param $id
     * @return array
     */
    public function getMessagesReceived($idUser)
    {
        $messages = $this->em->getRepository("WebserviceMainBundle:Message")->findBy(array("idRecived" => $idUser, "flag"=> array(1,0)));
        //Convert l'object en array
        $messages = $this->serializer->toArray($messages);
        return $messages;
    }

    /**
     * recuperer les messages envoyés
     * @param $id
     * @return array
     */
    public function getMessagesSend($idUser)
    {
        $messages = $this->em->getRepository("WebserviceMainBundle:Message")->findBy(array("idSend" => $idUser, "flag"=> array(2,0)));
        if(!$messages) {
            return "Aucun message pour cet utilisateur";
        }
        //Convert l'object en array
        $messages = $this->serializer->toArray($messages);
        return $messages;
    }

    /**
     * recuperer le message selection pour affiché
     * @param $id
     * @return array
     */
    public function getMessage($idMessage)
    {
        $message = $this->em->getRepository("WebserviceMainBundle:Message")->findBy(array("id" => $idMessage));
        if(!$message) {
            return "Il n'y a pas de message";
        }
        $message = $this->serializer->toArray($message);
        return $message;
    }

    /**
     * delete message
     *     $idMessage : le message à supprimer
     *     $idUser :le user qui veut supprimer le message
     * la suppression d un message consiste à changer le flag ( 1 supprimé par le sendre; par le recived ; 3 par les 2)
     * @param $idMessage
     * @param $idUser
     * @return Response
     */
    public function deleteMessage($idMessage, $idUser)
    {
        $message = $this->em->getRepository("WebserviceMainBundle:Message")->find($idMessage);

        if ($message ==null) {

            return "Le message n'existe pas ";

        }
        $sender = $message->getIdSend();
        $revived = $message->getIdRecived();
        if ($idUser == $sender->getId() or $idUser == $revived->getId()) {


            if ($sender->getId() == $idUser) {
                if ($message->getFlag() == 0 and $message->getFlag() != 1) {
                    $message->setFlag(1);
                } // le message serai supprimé par le sendre

                else $message->setFlag(3);
            } elseif ($message->getFlag() == 0 and $message->getFlag() != 2) {
                $message->setFlag(2);
            } else $message->setFlag(3);

            $this->em->flush();
            return "le message est bien supprime";

        } else  return "l utilisateur n'existe pas ";
    }
}