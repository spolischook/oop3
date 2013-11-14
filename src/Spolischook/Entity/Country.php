<?php

namespace Spolischook\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="country")
 */
class Country
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="string") **/
    protected $code;

    /** @OneToMany(targetEntity="Film", mappedBy="film") */
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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
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