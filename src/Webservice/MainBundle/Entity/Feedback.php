<?php

namespace Webservice\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback")
 * @ORM\Entity(repositoryClass="Webservice\MainBundle\Repository\FeedbackRepository")
 */
class Feedback
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
    private $idExaminer;

    /**
     * @var int
     *
     * @ORM\Column(name="idTarget", type="integer")
     */
    private $idTarget;
    /**
     * @var int
     *
     * @ORM\Column(name="typeFeedback", type="integer")
     */
    private $typeFeedback;

    /**
     * @var string
     *
     * @ORM\Column(name="evaluation", type="string", length=255)
     */
    private $evaluation;

    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="string", length=255)
     */
    private $rating;

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
     * Set idExaminer
     *
     * @param \Webservice\MainBundle\Entity\User $idExaminer
     *
     * @return Feedback
     */
    public function setIdExaminer(\Webservice\MainBundle\Entity\User $idExaminer =null)
    {
        $this->idExaminer = $idExaminer;

        return $this;
    }

    /**
     * Get idExaminer
     *
     * @return \Webservice\MainBundle\Entity\User
     */
    public function getIdExaminer()
    {
        return $this->idExaminer;
    }

    /** set Id target = id de l entité à évaluer
     *
     * @param int $idTarget
     * @return Feedback
     */
    public function setIdTarget($idTarget )
    {
        $this->idTarget = $idTarget ;
        return $this;
    }

    /**
     * Get getIdTarget
     *
     * @return int
     */
    public function getIdTarget(){
        return $this->idTarget;
    }

    /** set TypeFeedback : 1 sceance ; 2 equipement ; 3 film ; users
     *
     * @param int $idTarget
     * @return Feedback
     */
    public function setTypeFeedback($typeFeedback )
    {
        $this->typeFeedback = $typeFeedback ;
        return $this;
    }

    /**
     * Get getTypeFeedback
     *
     * @return int
     */
    public function getTypeFeedback(){
        return $this->typeFeedback;
    }

    /**
     * Set evaluation
     *
     * @param string $evaluation
     *
     * @return Feedback
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    /**
     * Get evaluation
     *
     * @return string
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }


    /** set rating
     *
     * @param int $rating
     * @return Feedback
     */
    public function setRating($rating )
    {
        $this->rating = $rating ;
        return $this;
    }

    /**
     * Get getIdTarget
     *
     * @return int
     */
    public function getRating(){
        return $this->rating;
    }


}
