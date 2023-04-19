<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_VESTE = 'CATEGORY_VESTE';
    public const CATEGORY_MANCHES = 'CATEGORY_MANCHES';

    public function load(ObjectManager $manager): void
    {
        $categoryVeste = new Category();
        $categoryVeste->setName('Veste');
        $manager->persist($categoryVeste);
        $this->addReference(self::CATEGORY_VESTE, $categoryVeste);

        $categoryManches = new Category();
        $categoryManches->setName('Manches');
        $manager->persist($categoryManches);
        $this->addReference(self::CATEGORY_MANCHES, $categoryManches);

        $manager->flush();
    }
}
