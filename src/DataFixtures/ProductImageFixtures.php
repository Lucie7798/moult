<?php

namespace App\DataFixtures;

use App\Entity\ProductImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $productImage = new ProductImage();
        $productImage->setPosition(1);
        $productImage->setPath('https://via.placeholder.com/150');
        $productImage->setProduct($this->getReference(ProductFixtures::PRODUCT_VESTE));
        $manager->persist($productImage);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}