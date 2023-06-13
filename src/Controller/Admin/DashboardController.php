<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Color;
use App\Entity\Header;
use App\Entity\Product;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class DashboardController extends AbstractDashboardController
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Moult');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard(
            $this->translator->trans('dashboard'),
            'fa fa-home'
        );
        yield MenuItem::linkToCrud(
            $this->translator->trans('categories'),
            'fas fa-list', 
            Category::class
        );
        yield MenuItem::linkToCrud(
            $this->translator->trans('products'),
            'fas fa-tag', 
            Product::class
        );
        yield MenuItem::linkToCrud(
            $this->translator->trans('headers'),
            'fas fa-desktop', 
            Header::class
        );
        yield MenuItem::linkToCrud(
            $this->translator->trans('users'),
            'fas fa-users', 
            User::class
        );
        yield MenuItem::linkToCrud(
            $this->translator->trans('colors'),
            'fas fa-palette', 
            Color::class
        );
    }
}