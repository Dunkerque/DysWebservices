<?php

namespace Webservice\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="Webservice\MainBundle\Repository\MessageRepository")
 */
class Message
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
    private $idSend;

    /**
     * @ORM\ManyToOne(targetEntity="Webservice\MainBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idRecived;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="msgRead", type="boolean")
     */
    private $msgRead;

    /**
     * @var int
     *
     * @ORM\Column(name="flag", type="integer")
     */
    private $flag;

    public function __construct()
    {
        $this->date = new \Datetime();
    }

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
     * Set content
     *
     * @param string $content
     *
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Message
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set msgRead
     *
     * @param boolean $msgRead
     *
     * @return Message
     */
    public function setMsgRead($msgRead)
    {
        $this->msgRead = $msgRead;

        return $this;
    }

    /**
     * Get msgRead
     *
     * @return bool
     */
    public function getMsgRead()
    {
        return $this->msgRead;
    }

    /**
     * Set idSend
     *
     * @param \Webservice\MainBundle\Entity\User $idSend
     *
     * @return Message
     */
    public function setIdSend(\Webservice\MainBundle\Entity\User $idSend = null)
    {
        $this->idSend = $idSend;

        return $this;
    }

    /**
     * Get idSend
     *
     * @return \Webservice\MainBundle\Entity\User
     */
    public function getIdSend()
    {
        return $this->idSend;
    }

    /**
     * Set idRecived
     *
     * @param \Webservice\MainBundle\Entity\User $idRecived
     *
     * @return Message
     */
    public function setIdRecived(\Webservice\MainBundle\Entity\User $idRecived = null)
    {
        $this->idRecived = $idRecived;

        return $this;
    }

    /**
     * Get idRecived
     *
     * @return \Webservice\MainBundle\Entity\User
     */
    public function getIdRecived()
    {
        return $this->idRecived;
    }

    /**
     * Set flag
     *
     * @param integer $flag
     *
     * @return Message
     */
    public function setFlag($flag)
    {
        $this->flag= $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return int
     */
    public function getFlag()
    {
        return $this->flag;
    }
}
