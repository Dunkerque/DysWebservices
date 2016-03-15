<?php
namespace Webservice\MainBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Film
 *
 * @ORM\Table(name="film")
 * @ORM\Entity(repositoryClass="Webservice\MainBundle\Repository\FilmRepository")
 */
class Film
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
     * @ORM\Column(name="title", type="string", length=200)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=45)
     */
    private $category;
    /**
     * @var string
     *
     * @ORM\Column(name="isan", type="string", length=100)
     */
    private $isan;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500)
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=true)
     */
    private $image;
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
     * Set title
     *
     * @param string $title
     *
     * @return Film
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Set category
     *
     * @param string $category
     *
     * @return Film
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Set isan
     *
     * @param string $isan
     *
     * @return Film
     */
    public function setIsan($isan)
    {
        $this->isan = $isan;
        return $this;
    }
    /**
     * Get isan
     *
     * @return string
     */
    public function getIsan()
    {
        return $this->isan;
    }
    /**
     * Set description
     *
     * @param string $description
     *
     * @return Film
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Set image
     *
     * @param string $image
     *
     * @return Film
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }
    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

}