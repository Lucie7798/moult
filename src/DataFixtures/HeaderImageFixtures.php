<?php

namespace App\DataFixtures;

use App\Entity\HeaderImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HeaderImageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $headerImage = new HeaderImage();
        $headerImage->setPath('https://via.placeholder.com/600x400');
        $manager->persist($headerImage);

        $manager->flush();
    }
}
