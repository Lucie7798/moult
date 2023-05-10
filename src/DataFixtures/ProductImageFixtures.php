<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductImage;
use App\DataFixtures\ProductFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class ProductImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($j = 0; $j < 50; $j++) {
            /** @var Product $product */
            $product = $this->getReference('product_'.$j);

            for ($i = 0; $i < 3; $i++) {
                $productImage = new ProductImage();
                $productImage->setPosition($i+1);
                $productImage->setPath($faker->imageUrl('https://picsum.photos/seed/picsum/200/300')); // Génère une URL d'image aléatoire
                $productImage->setProduct($product);
                $manager->persist($productImage);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}
