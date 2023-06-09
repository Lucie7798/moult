<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'user.list_title')
            ->setPageTitle(Crud::PAGE_NEW, 'user.new_title')
            ->setPageTitle(Crud::PAGE_EDIT, 'user.edit_title');
    }

    public function configureFields(string $pageName): iterable
    {
        yield EmailField::new('email')->setLabel('user.email');
        yield Field::new('plainPassword')->setLabel('user.password')->setHelp('Laisser vide pour ne pas changer le mot de passe')->hideOnIndex();
        yield ChoiceField::new('roles')
                ->setLabel('user.roles')
                ->setChoices([
                    'Administrateur' => 'ROLE_ADMIN',
                    'Utilisateur' => 'ROLE_USER',
                ])
                ->allowMultipleChoices();

        yield Field::new('updatedAt')->setLabel('user.updated_at')->onlyOnIndex();
    }
}
