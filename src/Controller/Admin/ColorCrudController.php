<?php

namespace App\Controller\Admin;

use App\Entity\Color;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ColorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Color::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'color.list_title')
            ->setPageTitle(Crud::PAGE_NEW, 'color.new_title')
            ->setPageTitle(Crud::PAGE_EDIT, 'color.edit_title');
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')->setLabel('color.name');
        yield ColorField::new('code')->setLabel('color.code');
    }
}