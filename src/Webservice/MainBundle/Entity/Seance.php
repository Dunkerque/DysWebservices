<?php

namespace Webservice\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Seance
 *
 * @ORM\Table(name="seance")
 * @ORM\Entity(repositoryClass="Webservice\MainBundle\Repository\SeanceRepository")
 */
class Seance
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
     * @var string
     *
     * @ORM\Column(name="start_Seance", type="string")
     */
    private $startSeance;

    /**
     * @var string
     *
     * @ORM\Column(name="end_Seance", type="string")
     */
    private $endSeance;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrPlace", type="integer")
     */
    private $nbrPlace;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="text",nullable=true)
     */
    private $details;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="text",nullable=true)
     */
    private $rating;

    /**
     * @ORM\ManyToOne(targetEntity="Webservice\MainBundle\Entity\Film")
     * @ORM\JoinColumn(name="id_film",nullable=false)
     */
    private $idFilm;

    /**
     * @ORM\ManyToOne(targetEntity="Webservice\MainBundle\Entity\User")
     * @ORM\JoinColumn(name="id_organizer",nullable=false)
     *
     */
    private $idOrganizer;

    /**
     * @ORM\ManyToOne(targetEntity="Webservice\MainBundle\Entity\Address")
     * @ORM\JoinColumn(name="id_address",nullable=false)
     */
    private $idAddress;


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
     * Set startSeance
     *
     * @param \DateTime $startSeance
     *
     * @return Seance
     */
    public function setStartSeance($startSeance)
    {
        $this->startSeance = $startSeance;

        return $this;
    }

    /**
     * Get startSeance
     *
     * @return \DateTime
     */
    public function getStartSeance()
    {
        return $this->startSeance;
    }

    /**
     * Set endSeance
     *
     * @param \DateTime $endSeance
     *
     * @return Seance
     */
    public function setEndSeance($endSeance)
    {
        $this->endSeance = $endSeance;

        return $this;
    }

    /**
     * Get endSeance
     *
     * @return \DateTime
     */
    public function getEndSeance()
    {
        return $this->endSeance;
    }

    /**
     * Set nbrPlace
     *
     * @param integer $nbrPlace
     *
     * @return Seance
     */
    public function setNbrPlace($nbrPlace)
    {
        $this->nbrPlace = $nbrPlace;

        return $this;
    }

    /**
     * Get nbrPlace
     *
     * @return int
     */
    public function getNbrPlace()
    {
        return $this->nbrPlace;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Seance
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return Seance
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set rating
     *
     * @param string $rating
     *
     * @return Seance
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }



    /**
     * Set idFilm
     *
     * @param \Webservice\MainBundle\Entity\Film $idFilm
     *
     * @return Seance
     */
    public function setIdFilm(\Webservice\MainBundle\Entity\Film $idFilm)
    {
        $this->idFilm = $idFilm;

        return $this;
    }

    /**
     * Get idFilm
     *
     * @return \Webservice\MainBundle\Entity\Film
     */
    public function getIdFilm()
    {
        return $this->idFilm;
    }

    /**
     * Set idOrganizer
     *
     * @param \Webservice\MainBundle\Entity\User $idOrganizer
     *
     * @return Seance
     */
    public function setIdOrganizer(\Webservice\MainBundle\Entity\User $idOrganizer)
    {
        $this->idOrganizer = $idOrganizer;

        return $this;
    }

    /**
     * Get idOrganizer
     *
     * @return \Webservice\MainBundle\Entity\User
     */
    public function getIdOrganizer()
    {
        return $this->idOrganizer;
    }

    /**
     * Set idAddress
     *
     * @param \Webservice\MainBundle\Entity\Address $idAddress
     *
     * @return Seance
     */
    public function setIdAddress(\Webservice\MainBundle\Entity\Address $idAddress)
    {
        $this->idAddress = $idAddress;

        return $this;
    }

    /**
     * Get idAddress
     *
     * @return \Webservice\MainBundle\Entity\Address
     */
    public function getIdAddress()
    {
        return $this->idAddress;
    }
}
