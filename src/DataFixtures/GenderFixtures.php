<?php

namespace App\DataFixtures;

use App\Entity\Gender;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenderFixtures extends Fixture
{
    public const GENDER_HOMME = 'gender_homme';
    public const GENDER_FEMME = 'gender_femme';

    public function load(ObjectManager $manager): void
    {
        // Création de l'entité 'Homme'
        $gender = new Gender();
        $gender->setName('Homme');
        $manager->persist($gender);
        $this->addReference(self::GENDER_HOMME, $gender);

        // Création de l'entité 'Femme'
        $gender = new Gender();
        $gender->setName('Femme');
        $manager->persist($gender);
        $this->addReference(self::GENDER_FEMME, $gender);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
    
}
