<?php

namespace App\DataFixtures;

use App\Entity\Gender;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $gender = new Gender();
        $gender->setName('Homme');

        $gender = new Gender();
        $gender->setName('Femme');

        $manager->persist($gender);
        $this->addReference('Homme', $gender);

        $manager->flush();
    }
}
