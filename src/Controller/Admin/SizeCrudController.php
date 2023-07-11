<?php

namespace App\Controller\Admin;

use App\Entity\Size;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SizeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Size::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'size.list_title')
            ->setPageTitle(Crud::PAGE_NEW, 'size.new_title')
            ->setPageTitle(Crud::PAGE_EDIT, 'size.edit_title');
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')->setLabel('size.name');
    }
}
