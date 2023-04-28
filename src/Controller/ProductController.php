<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Header;
use App\Repository\GenderRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $productRepository;
    private $genderRepository;

    public function __construct(ProductRepository $productRepository, GenderRepository $genderRepository)
    {
        $this->productRepository = $productRepository;
        $this->genderRepository = $genderRepository;
    }
    
    #[Route("/homme", name: "app_products_homme")]

    public function listHomme(ManagerRegistry $doctrine): Response
    {
        $headerRepository = $doctrine->getRepository(Header::class);
        $header = $headerRepository->findOneBy([]);
        $homme = $this->genderRepository->findOneBy(['name' => 'femme']);
        $products = $this->productRepository->findBy(['gender' => $homme]);

        return $this->render('product/homme/list.html.twig', [
            'header' => $header,
            'products' => $products,
        ]);
    }

    #[Route("/femme", name: "app_products_femme")]

    public function listFemme(ManagerRegistry $doctrine): Response
    {
        $headerRepository = $doctrine->getRepository(Header::class);
        $header = $headerRepository->findOneBy([]);
        $femme = $this->genderRepository->findOneBy(['name' => 'femme']);
        $products = $this->productRepository->findBy(['gender' => $femme]);

        return $this->render('product/femme/list.html.twig', [
            'header' => $header,
            'products' => $products,
        ]);
    }

    #[Route('/products/{id<\d+>}', name: 'app_product')]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
