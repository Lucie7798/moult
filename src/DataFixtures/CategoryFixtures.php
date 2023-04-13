<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture 
{
    public const CATEGORY_VESTE = 'CATEGORY_VESTE';

    public function load(ObjectManager $manager): void
    {
        $category = new Category();
        $category->setName('Veste');
        $manager->persist($category);
        $this->addReference(self::CATEGORY_VESTE, $category);

        $manager->flush();
    }
}
