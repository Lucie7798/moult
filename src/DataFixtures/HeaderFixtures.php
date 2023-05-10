<?php

namespace App\DataFixtures;

use App\Entity\Header;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HeaderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Vérifie si un en-tête avec le titre 'Bienvenue sur notre site' existe déjà
        $header = $manager->getRepository(Header::class)->findOneBy(['title' => 'Bienvenue sur notre site']);

        if (!$header) {
            $header = new Header();
            $header->setTitle('Bienvenue sur notre site');
            $header->setDescription('Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.');
            $header->setButtonTitle('Découvrir');
            $header->setButtonUrl('/');
            $header->setImage('header1.jpg');
            $header->setActive(false);

            $manager->persist($header);
        }

        $manager->flush();
    }
}
