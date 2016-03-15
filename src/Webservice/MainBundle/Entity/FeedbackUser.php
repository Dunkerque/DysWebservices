<?php

namespace Webservice\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeedbackUser
 *
 * @ORM\Table(name="feedback_user")
 * @ORM\Entity(repositoryClass="Webservice\MainBundle\Repository\FeedbackUserRepository")
 */
class FeedbackUser
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
     * @ORM\ManyToOne(targetEntity="Webservice\MainBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idValued;

    /**
     * @var string
     *
     * @ORM\Column(name="evaluation", type="string", length=255)
     */
    private $evaluation;


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
     * @param integer $idExaminer
     *
     * @return FeedbackUser
     */
    public function setIdExaminer($idExaminer)
    {
        $this->idExaminer = $idExaminer;

        return $this;
    }

    /**
     * Get idExaminer
     *
     * @return int
     */
    public function getIdExaminer()
    {
        return $this->idExaminer;
    }

    /**
     * Set idValued
     *
     * @param integer $idValued
     *
     * @return FeedbackUser
     */
    public function setIdValued($idValued)
    {
        $this->idValued = $idValued;

        return $this;
    }

    /**
     * Get idValued
     *
     * @return int
     */
    public function getIdValued()
    {
        return $this->idValued;
    }

    /**
     * Set evaluation
     *
     * @param string $evaluation
     *
     * @return FeedbackUser
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
}

