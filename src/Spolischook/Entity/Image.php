<?php

namespace Spolischook\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Spolischook\Entity\Film;

/**
 * @Entity @Table(name="image")
 */
class Image
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $title;

    /** @Column(type="string") **/
    protected $src;

    /** @ManyToOne(targetEntity="Film", inversedBy="images") */
    protected $film;

    /** @ManyToOne(targetEntity="Image", inversedBy="thumbnails") */
    protected $originalImage;

    /** @OneToMany(targetEntity="Image", mappedBy="originalImage") */
    protected $thumbnails;

    /** @Column(type="integer") **/
    protected $width;

    /** @Column(type="integer") **/
    protected $height;

    public function __construct()
    {
        $this->thumbnails = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $src
     * @return $this
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @param Film $film
     * @return $this
     */
    public function setFilm($film)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * @return Film
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * @param Image $originalImage
     * @return $this
     */
    public function setOriginalImage(Image $originalImage)
    {
        $this->originalImage = $originalImage;

        return $this;
    }

    /**
     * @return Image
     */
    public function getOriginalImage()
    {
        return $this->originalImage;
    }

    /**
     * @param ArrayCollection $thumbnails
     * @return $this
     */
    public function setThumbnails(ArrayCollection $thumbnails)
    {
        $this->thumbnails = $thumbnails;

        return $this;
    }

    /**
     * @param Image $thumbnail
     * @return $this
     */
    public function addThumbnail(Image $thumbnail)
    {
        $this->thumbnails->add($thumbnail);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getThumbnails()
    {
        return $this->thumbnails;
    }

    /**
     * @param integer $width
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param integer $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }
}