<?php

namespace Spolischook\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Yaml\Yaml;
use Spolischook\Entity\Film;

class LoadFilmData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $films = Yaml::parse($this->getYmlFile());

        foreach ($films['films'] as $slug => $film) {
            $filmObject = new Film();

            $filmObject
                ->setTitle($film['title'])
                ->setDescription($film['description'])
                ->setVideoSrc($film['videoSrc'])
                ->setPoster($this->getReference($film['poster']))
                ->setYear($film['year'])
                ->setCountry($this->getReference($film['country']))
                ->setGenres($this->getReferencesFromArray($film['genres']))
            ;

            $manager->persist($filmObject);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5; // number in which order to load fixtures
    }

    protected function getYmlFile()
    {
        return __DIR__ . '/data/film.yml';
    }

    protected function getReferencesFromArray(array $array)
    {
        $outputReferences = new ArrayCollection();

        foreach ($array as $reference) {
            $outputReferences->add($this->getReference($reference));
        }

        return $outputReferences;
    }
}