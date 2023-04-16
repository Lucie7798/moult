<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ItemImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'product.list_title')
            ->setPageTitle(Crud::PAGE_NEW, 'product.new_title')
            ->setPageTitle(Crud::PAGE_EDIT, 'product.edit_title');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('price')
            ->add('category')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('Info générales')->setIcon('fas fa-info');
        yield Field::new('name')->setLabel('product.name');
        yield AssociationField::new('category')->setLabel('product.category')->setRequired(false);
        yield AssociationField::new('gender')->setLabel('product.gender')->setRequired(false);
        yield TextEditorField ::new('description')->hideOnIndex();
        yield MoneyField::new('price')->setLabel('product.price')->setStoredAsCents(false)->setCurrency('EUR');

        yield FormField::addTab('Images')->setIcon('fas fa-images');
        yield CollectionField::new('itemImages')->setLabel('product.itemImages')->setEntryType(ItemImageType::class)->onlyOnForms();
    }
}
