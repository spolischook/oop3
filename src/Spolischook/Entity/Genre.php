<?php

namespace Spolischook\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="genre")
 */
class Genre
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $title;

    /** @Column(type="string") **/
    protected $slug;

    /** @ManyToMany(targetEntity="Film", inversedBy="genres") */
    protected $films;

    public function __construct()
    {
        $this->films = new ArrayCollection();
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
     * @param string $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param ArrayCollection $films
     * @return $this
     */
    public function setFilms(ArrayCollection $films)
    {
        $this->films = $films;

        return $this;
    }

    /**
     * @param Film $film
     * @return $this
     */
    public function addFilm(Film $film)
    {
        $this->films->add($film);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getFilms()
    {
        return $this->films;
    }
}