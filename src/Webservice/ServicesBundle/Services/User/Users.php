<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 13/03/2016
 * Time: 20:36
 */

namespace Webservice\ServicesBundle\Services\User;


use Doctrine\ORM\EntityManager;
use JMS\Serializer\Serializer;
use Webservice\MainBundle\Entity\User;

class Users
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
     * Users constructor.
     * @param EntityManager $em
     * @param Serializer $serializer
     */
    public function __construct(EntityManager $em, Serializer $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    /**
     * Récupère tous les utilisateurs
     *
     * @return array
     */
    public function getAllUsers()
    {
//        dump("ici"); exit();
        $users = $this->em->getRepository("WebserviceMainBundle:User")->findAll();
        $users = $this->serializer->serialize($users, "json");
        $user = json_decode($users, true);
        return $user;
    }

    /**
     * Récupère l'utilisateur par son id ou son email
     *
     * @param string|int $IdOrEmail
     *
     * @return object
     */
    public function findUserByMailOrId($IdOrEmail)
    {
        if (filter_var($IdOrEmail, FILTER_VALIDATE_EMAIL)) {
            return $this->findUserByEmail($IdOrEmail);
        }
        return $this->findUserById($IdOrEmail);
    }

    /**
     * Récupère l'utilisateur depuis son email
     *
     * @param string $mail
     * @return array
     */
    public function findUserByEmail($mail)
    {
        $userMail = $this->em->getRepository("WebserviceMainBundle:User")->findBy(array("mail" => $mail));
        if(!$userMail) {
            return "L'utilisateur avec le mail ".$mail . " n'existe pas ";
        }
        $mail = $this->serializer->serialize($userMail, "json");
        $mail = json_decode($mail ,true);
        return $mail;
    }

    /**
     * Récupère un utilisateur par son id
     *
     * @param int $id
     * @return object
     */
    public function findUserById($id)
    {
        $userId = $this->em->getRepository("WebserviceMainBundle:User")->find($id);
        if(!$userId) {
            return "L'utilisateur avec l'id ".$id . " n'existe pas";
        }
        $userId = $this->serializer->serialize($userId,"json");
        $userId = json_decode($userId, true);
        return $userId;
    }

    /**
     * Verifié si l'utilisateur est déjà existant
     *
     * @param string $mail
     * @return bool
     */
    private function checkUserExist($mail)
    {
        $mail = $this->em->getRepository("WebserviceMainBundle:User")->findBy(array("mail" => $mail));
        if(!$mail) {
            return false;
        }
        return true;
    }

    /**
     * Créer un utilisateur
     *
     * @param string $name
     * @param string $lastName
     * @param string $phone
     * @param string $mail
     * @param string $password
     * @param int $age
     * @return string
     */
    public function createUser($name, $lastName, $phone, $mail, $password, $age)
    {

        if(!$this->checkUserExist($mail)) {
            $user = new User();
            $user->setFirstName($name);
            $user->setLastName($lastName);
            $user->setPhone($phone);
            $user->setMail($mail);
            $user->setPassword($password);
            $user->setAge($age);

            $this->em->persist($user);
            $this->em->flush();

            return "L'utilisateur ".$name." a bien été créer";
        }

        return "L'utilisateur existe déjà";
    }

//    /**
//     * Supprime un utilisateur
//     *
//     * @param $id
//     * @return string
//     */
//    public function deleteUser($id)
//    {
//        $em = $this->em;
//        $userId = $this->findUserById($id);
//        $userId = $this->serializer->deserialize($userId, 'Webservice\MainBundle\Entity\User', "json");
//        if($userId == null) {
//            return "L'utilisateur n'existe pas";
//        }
//        $em->remove($userId);
//        $em->flush();
//        return "L'utilisateur a bien été supprimé";
//
//    }

    /**
     * Modifie un utilisateur
     *
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $phone
     * @param string $mail
     * @param string $password
     * @param int $age
     *
     * @return string
     */

    public function updateUser($id, $firstName, $lastName, $phone, $mail, $password, $age)
    {
        $user = $this->em->getRepository("WebserviceMainBundle:User")->find($id);

        if($user) {

            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setPhone($phone);
            $user->setMail($mail);
            $user->setPassword($password);
            $user->setAge($age);

            $this->em->flush();

            return "L'utilisateur a bien été modifiés";
        }
    }
}