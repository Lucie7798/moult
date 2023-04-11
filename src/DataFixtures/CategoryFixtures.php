<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = new Category();
        $category->setName('Veste');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Casquette');
        $manager->persist($category);

        $this->addReference('category_accessoires', $category);

        $manager->flush();
    }
}
