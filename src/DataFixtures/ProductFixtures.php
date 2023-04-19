<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_VESTE = 'PRODUCT_VESTE';
    public const PRODUCT_MANCHE = 'PRODUCT_MANCHE';

    public function load(ObjectManager $manager): void
    {
        $jacket = new Product();
        $jacket->setName('Veste');
        $jacket->setPrice(100);
        $jacket->setDescription('Veste en jean');
        $jacket->setGender($this->getReference(GenderFixtures::GENDER_HOMME));
        $jacket->setCategory($this->getReference(CategoryFixtures::CATEGORY_VESTE));
        $jacket->setIsAccessory(false);
        $manager->persist($jacket);
        $this->addReference(self::PRODUCT_VESTE, $jacket);

        $sleeve = new Product();
        $sleeve->setName('Manche');
        $sleeve->setPrice(30);
        $sleeve->setDescription('Manche en jean');
        $sleeve->setGender($this->getReference(GenderFixtures::GENDER_HOMME));
        $sleeve->setCategory($this->getReference(CategoryFixtures::CATEGORY_MANCHES));
        $sleeve->setIsAccessory(true);
        $manager->persist($sleeve);
        $this->addReference(self::PRODUCT_MANCHE, $sleeve);

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
