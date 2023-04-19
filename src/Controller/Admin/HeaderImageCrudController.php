<?php

namespace App\Controller\Admin;

use App\Entity\HeaderImage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class HeaderImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HeaderImage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield CollectionField::new('headerImages')
            ->setEntryType(HeaderImageType::class)
            ->setFormTypeOption('by_reference', false)
            ->setFormTypeOption('allow_add', true)
            ->setFormTypeOption('allow_delete', true)
            ->setFormTypeOption('delete_empty', true)
            ->setFormTypeOption('prototype', true)
            ->setFormTypeOption('prototype_name', '__headerimage__')
            ->setFormTypeOption('entry_options', [
                'label' => false,
            ]);
    }
}
