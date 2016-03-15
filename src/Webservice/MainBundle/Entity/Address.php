<?php

namespace Webservice\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="Webservice\MainBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\JoinColumn(name="id_user",nullable=false)
     *
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="numbre", type="integer")
     */
    private $numbre;

    /**
     * @var string
     *
     * @ORM\Column(name="avenue", type="string", length=100)
     */
    private $avenue;

    /**
     * @var string
     *
     * @ORM\Column(name="complement", type="string", length=100, nullable=true)
     */
    private $complement;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=70)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=20)
     */
    private $postcode;




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
     * Set numbre
     *
     * @param int $numbre
     *
     * @return Address
     */
    public function setNumbre($numbre)
    {
        $this->numbre = $numbre;

        return $this;
    }

    /**
     * Get numbre
     *
     * @return int
     */
    public function getNumbre()
    {
        return $this->numbre;
    }

    /**
     * Set avenue
     *
     * @param string $avenue
     *
     * @return Address
     */
    public function setAvenue($avenue)
    {
        $this->avenue = $avenue;

        return $this;
    }

    /**
     * Get avenue
     *
     * @return string
     */
    public function getAvenue()
    {
        return $this->avenue;
    }

    /**
     * Set complement
     *
     * @param string $complement
     *
     * @return Address
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return Address
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }


    /**
     * Set idUser
     *
     * @param \Webservice\MainBundle\Entity\User $idUser
     *
     * @return Address
     */
    public function setIdUser(\Webservice\MainBundle\Entity\User $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \Webservice\MainBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }


}
