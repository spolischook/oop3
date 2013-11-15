<?php

namespace Spolischook\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Yaml\Yaml;
use Spolischook\Entity\Image;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $images = Yaml::parse($this->getYmlFile());

        foreach ($images['images'] as $key => $image) {
            $image = $this->processImage($image);

            $manager->persist($image);
            $this->addReference($key, $image);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3; // number in which order to load fixtures
    }

    protected function processImage($image)
    {
        $imagine = new \Imagine\Imagick\Imagine();
        $newImageSrc = $this->getUploadDir() . basename($image['src']);
        $imageTitle = $image['title'];
        $imagine->open(__DIR__ . '/' . $image['src'])->save($newImageSrc);
        list($width, $height, $type, $attr) = getimagesize($newImageSrc);

        $image = new Image();
        $image
            ->setTitle($imageTitle)
            ->setSrc($newImageSrc)
            ->setWidth($width)
            ->setHeight($height)
        ;

        return $image;
    }

    protected function getYmlFile()
    {
        return __DIR__ . '/data/image.yml';
    }

    protected function getUploadDir()
    {
        return __DIR__ . '/../../../public/uploads/';
    }
}