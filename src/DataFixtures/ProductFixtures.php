<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_VESTE = 'PRODUCT_VESTE';
    public const PRODUCT_MANCHE = 'PRODUCT_MANCHE';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $genders = [
            GenderFixtures::GENDER_HOMME,
            GenderFixtures::GENDER_FEMME,
        ];

        $categories = [
            CategoryFixtures::CATEGORY_VESTE,
            CategoryFixtures::CATEGORY_MANCHES,
            // Ajoutez d'autres catégories ici si nécessaire
        ];

        for ($i = 0; $i < 50; $i++) {
            $product = new Product();
            $product->setName($faker->word);
            $product->setPrice($faker->randomFloat(50, 60, 100));
            $product->setDescription($faker->sentence);
            $product->setGender($this->getReference($faker->randomElement($genders)));
            $product->setCategory($this->getReference($faker->randomElement($categories)));
            $manager->persist($product);

            // Ajoutez une référence pour chaque produit
            $this->addReference('product_' . $i, $product);

            // Ajoutez des références spécifiques pour les produits "Veste" et "Manche"
            if ($product->getCategory()->getName() === 'Veste' && !$this->hasReference(self::PRODUCT_VESTE)) {
                $this->addReference(self::PRODUCT_VESTE, $product);
            }

            if ($product->getCategory()->getName() === 'Manches' && !$this->hasReference(self::PRODUCT_MANCHE)) {
                $this->addReference(self::PRODUCT_MANCHE, $product);
            }
            
        }

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
