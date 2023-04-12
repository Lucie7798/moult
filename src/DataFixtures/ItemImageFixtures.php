<?php

namespace App\DataFixtures;

use App\Entity\ItemImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ItemImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Image pour le produit
        $itemImage = new ItemImage();
        $itemImage->setPosition(1);
        $itemImage->setPath('https://via.placeholder.com/150');
        $itemImage->setProduct($this->getReference(ProductFixtures::PRODUCT_VESTE));
        $manager->persist($itemImage);

        // Image pour l'accessoire
        $accessoryImage = new ItemImage();
        $accessoryImage->setPosition(1);
        $accessoryImage->setPath('https://via.placeholder.com/150');
        $accessoryImage->setAccessory($this->getReference(AccessoryFixtures::ACCESSORY_CHAPEAU));
        $manager->persist($accessoryImage);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            AccessoryFixtures::class,
        ];
    }
}