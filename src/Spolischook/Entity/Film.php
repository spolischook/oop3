<?php

namespace Spolischook\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="film")
 */
class Film
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $title;

    /** @Column(type="text") **/
    protected $description;

    /** @OneToMany(targetEntity="Image", mappedBy="film", cascade={"remove"}) */
    protected $images;

    /** @Column(type="string") **/
    protected $videoSrc;

    /** @OneToOne(targetEntity="Image", mappedBy="film", cascade={"remove"}) */
    protected $poster;

    /** @Column(type="integer") **/
    protected $year;

    /** @ManyToOne(targetEntity="Country", inversedBy="films") */
    protected $country;

    /** @ManyToMany(targetEntity="Genre", mappedBy="films") */
    protected $genres;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->genres = new ArrayCollection();
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
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param ArrayCollection $images
     * @return $this
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @param Image $image
     * @return $this
     */
    public function addImage(Image $image)
    {
        $this->images->add($image);
        $image->setFilm($this);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Image $poster
     * @return $this
     */
    public function setPoster(Image $poster)
    {
        $this->poster = $poster;
        $poster->setFilm($this);

        return $this;
    }

    /**
     * @return Image
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * @param string $videoSrc
     * @return $this
     */
    public function setVideoSrc($videoSrc)
    {
        $this->videoSrc = $videoSrc;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVideoSrc()
    {
        return $this->videoSrc;
    }

    /**
     * @param integer $year
     * @return $this
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param Country $country
     * @return $this
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;
        $country->getFilms()->add($this);

        return $this;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param ArrayCollection $genres
     * @return $this
     */
    public function setGenres(ArrayCollection $genres)
    {
        $this->genres = $genres;
        $genres->forAll(function ($key, $element) {
            $element->addFilm($this);

            return true;
        });

        return $this;
    }

    /**
     * @param Genre $genre
     * @return $this
     */
    public function addGenre(Genre $genre)
    {
        $this->genres->add($genre);
        $genre->addFilm($this);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getGenres()
    {
        return $this->genres;
    }

    //ToDo: Use Twig extension instead
    public function getShortDescription($wordsNumber)
    {
        return substr($this->description, 0, $wordsNumber) . '...';
    }

    //ToDo: Use Twig extension instead
    public function getEmbedVideo($width, $height)
    {
        preg_match(
            '/[\\?\\&]v=([^\\?\\&]+)/',
            $this->getVideoSrc(),
            $matches
        );
        $id = $matches[1];

        echo '<object width="' . $width . '" height="' . $height . '"><param name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' . $width . '" height="' . $height . '"></embed></object>';
    }
}