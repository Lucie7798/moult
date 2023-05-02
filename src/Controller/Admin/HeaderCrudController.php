<?php

namespace App\Controller\Admin;

use App\Entity\Header;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HeaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Header::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'header.list_title')
            ->setPageTitle(Crud::PAGE_NEW, 'header.new_title')
            ->setPageTitle(Crud::PAGE_EDIT, 'header.edit_title')
            ->setEntityLabelInSingular('Header')
            ->setEntityLabelInPlural('Headers')
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(25)
            ->setHelp('new', 'Remplissez les champs obligatoire *.')
            ->setHelp('edit', 'Remplissez les champs obligatoire *.')
            ->setFormOptions([
                'validation_groups' => ['create', 'Default'],
            ]);           
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        // Informations générales (title, description, buttonTitle, buttonUrl)
        yield FormField::addTab('Informations générales')->setIcon('fas fa-info');
        yield ChoiceField::new('page')->setLabel('header.header.page')
            ->setChoices([
                'Accueil' => 'home',
                'Homme' => 'homme',
                'Femme' => 'femme',
                'Notre histoire' => 'our_story',
                // Ajoutez d'autres choix de pages ici, si nécessaire
            ]);
        yield TextField::new('title')->setLabel('header.title');
        yield TextareaField::new('description');
        yield Field::new('active')->setLabel('Publier l\'entête ?');
        yield TextField::new('buttonTitle')->setLabel('header.buttonTitle');
        yield ChoiceField::new('buttonUrl')->setLabel('header.buttonUrl')
            ->setChoices([
                'Page d\'accueil' => '/',
                'Homme' => '/homme',
                'Femme' => '/femme',
                'Notre histoire' => '/notre-histoire',
            ]);

        // Images
        yield FormField::addTab('Image')->setIcon('fas fa-images');
        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            $imageField = ImageField::new('image')
                ->setBasePath('/uploads/images/headers')
                ->setLabel('header.image');
        } else { // Sinon (par exemple, Crud::PAGE_NEW et Crud::PAGE_EDIT), utilisez le champ Field avec VichImageType
            $imageField = Field::new('imageFile', 'header.image')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'required' => false,
                    'allow_delete' => false,
                    'download_uri' => false,
                ])
                ->setRequired(false);
        }
        yield $imageField;
    }

    public function createEntity(string $entityFqcn): Header
    {
        $header = new Header();
        $header->setActive(false);
        // Set other default values for the Header entity here, if any.

        return $header;
    }
}
