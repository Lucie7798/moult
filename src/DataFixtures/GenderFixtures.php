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
        // Check if 'Homme' already exists
        $homme = $manager->getRepository(Gender::class)->findOneBy(['name' => 'Homme']);
        if (!$homme) {
            // Création de l'entité 'Homme'
            $homme = new Gender();
            $homme->setName('Homme');
            $manager->persist($homme);
        }
        $this->addReference(self::GENDER_HOMME, $homme);

        // Check if 'Femme' already exists
        $femme = $manager->getRepository(Gender::class)->findOneBy(['name' => 'Femme']);
        if (!$femme) {
            // Création de l'entité 'Femme'
            $femme = new Gender();
            $femme->setName('Femme');
            $manager->persist($femme);
        }
        $this->addReference(self::GENDER_FEMME, $femme);

        $manager->flush();
    }
}
