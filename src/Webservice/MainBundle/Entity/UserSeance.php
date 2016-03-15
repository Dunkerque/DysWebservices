<?php

namespace Webservice\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserSeance
 *
 * @ORM\Table(name="user_seance")
 * @ORM\Entity(repositoryClass="Webservice\MainBundle\Repository\UserSeanceRepository")
 */
class UserSeance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Webservice\MainBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */

    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="Webservice\MainBundle\Entity\Seance")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSeance;

    /**
     * @var bool
     *
     * @ORM\Column(name="validate", type="boolean")
     */
    private $validate;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return UserSeance
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idSeance
     *
     * @param integer $idSeance
     *
     * @return UserSeance
     */
    public function setIdSeance($idSeance)
    {
        $this->idSeance = $idSeance;

        return $this;
    }

    /**
     * Get idSeance
     *
     * @return int
     */
    public function getIdSeance()
    {
        return $this->idSeance;
    }

    /**
     * Set validate
     *
     * @param boolean $validate
     *
     * @return UserSeance
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;

        return $this;
    }

    /**
     * Get validate
     *
     * @return bool
     */
    public function getValidate()
    {
        return $this->validate;
    }
}

