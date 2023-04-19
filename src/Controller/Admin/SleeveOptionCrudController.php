<?php

namespace App\Controller\Admin;

use App\Entity\SleeveOption;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;

class SleeveOptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SleeveOption::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('Général')->setIcon('fas fa-info');
        yield AssociationField::new('jacket')->setLabel('sleeve_option.jacket');
        yield AssociationField::new('sleeve')->setLabel('sleeve_option.sleeve');
    }
}
