<?php

namespace App\DataFixtures;

use App\Entity\Accessory;
use App\Entity\ItemImage;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ItemImageFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        // Créer une instance de Product
        $product = new Product();
        // Initialisez les propriétés de $product selon vos besoins
        $manager->persist($product);

        // Créer une instance de Accessory
        $accessory = new Accessory();
        // Initialisez les propriétés de $accessory selon vos besoins
        $manager->persist($accessory);

        // Création d'une image pour un produit
        $productImage = new ItemImage();
        $productImage->setPath('https://via.placeholder.com/150');
        $productImage->setPosition(1);
        $productImage->setProduct($product); // Assurez-vous que $product est une instance de Product
        $productImage->setAccessory(null); // Ceci est important, définissez-le comme null
        $manager->persist($productImage);
        $manager->flush();
        
        // Création d'une image pour un accessoire
        $accessoryImage = new ItemImage();
        $accessoryImage->setPath('https://via.placeholder.com/150');
        $accessoryImage->setPosition(1);
        $accessoryImage->setProduct(null); // Ceci est important, définissez-le comme null
        $accessoryImage->setAccessory($accessory); // Assurez-vous que $accessory est une instance de Accessory
        $manager->persist($accessoryImage);
        $manager->flush();
    }

}