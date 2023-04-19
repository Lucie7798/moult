<?php

namespace App\DataFixtures;

use App\Entity\SleeveOption;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SleeveOptionFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $sleeveOption = new SleeveOption();
        $sleeveOption->setJacket($this->getReference(ProductFixtures::PRODUCT_VESTE));
        $sleeveOption->setSleeve($this->getReference(ProductFixtures::PRODUCT_MANCHE));
        $manager->persist($sleeveOption);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}
