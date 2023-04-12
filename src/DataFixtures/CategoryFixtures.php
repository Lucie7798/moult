<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_ACCESSOIRES = 'category_accessoires';

    public function load(ObjectManager $manager): void
    {
        $category = new Category();
        $category->setName('Veste');
        $manager->persist($category);


        $category = new Category();
        $category->setName('Casquette');
        $manager->persist($category);
        $this->addReference(self::CATEGORY_ACCESSOIRES, $category);

        $manager->flush();
    }
}
