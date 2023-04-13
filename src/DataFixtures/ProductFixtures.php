<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_VESTE = 'PRODUCT_VESTE';

    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Veste');
        $product->setPrice(100);
        $product->setDescription('Veste en jean');
        $product->setGender($this->getReference(GenderFixtures::GENDER_HOMME));
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_VESTE));
        $product->setIsAccessory(true); // Indique que c'est un accessoire
        $manager->persist($product);
        $this->addReference(self::PRODUCT_VESTE, $product);

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