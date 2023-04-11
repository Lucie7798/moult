<?php

namespace App\DataFixtures;

use App\Entity\Accessory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AccessoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $accessory = new Accessory();
        $accessory->setName('Chapeau');
        $accessory->setDescription('description');
        $accessory->setPrice(100);
        $accessory->setCategory($this->getReference('category_accessoires'));

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            GenderFixtures::class,
        ];
    }
}
