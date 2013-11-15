<?php

namespace Spolischook\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Spolischook\Entity\Genre;
use Gedmo\Sluggable\Util\Urlizer;

class LoadGenreData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getGenresArray() as $genreTitle) {
            $genre = new Genre();

            $genre->setTitle($genreTitle);
            $slug = Urlizer::transliterate($genreTitle);
            $genre->setSlug($slug);

            $manager->persist($genre);
            $this->addReference($slug, $genre);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2; // number in which order to load fixtures
    }

    protected function getGenresArray()
    {
        return array(
            "мультфильм",
            "мюзикл",
            "комедия",
            "приключения",
            "аниме",
            "сериал",
            "совецкий",
            "фэнтези",
            "короткометражный",
        );
    }
}