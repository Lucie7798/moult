<?php

namespace App\Controller;

use App\Repository\HeaderRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HeaderRepository $headerRepository, ProductRepository $productRepository): Response
    {
        $header = $headerRepository->findActiveHeader();

        // Récupérer les produits homme et femme
        $menProducts = $productRepository->findBy(['gender' => 'homme']); // Remplacez 'homme' par la valeur appropriée pour les produits homme
        $womenProducts = $productRepository->findBy(['gender' => 'femme']); // Remplacez 'femme' par la valeur appropriée pour les produits femme

        return $this->render('home/index.html.twig', [
            'header' => $header,
            'menProducts' => $menProducts,
            'womenProducts' => $womenProducts,
        ]);
    }
}
