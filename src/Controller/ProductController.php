<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\GenderRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    #[Route("/homme", name: "app_products_homme")]

    public function listHomme(GenderRepository $genderRepository): Response
    {
        $homme = $genderRepository->findOneBy(['name' => 'homme']);
        $products = $this->productRepository->findBy(['gender' => $homme]);

        return $this->render('product/homme/list.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route("/femme", name: "app_products_femme")]

    public function listFemme(GenderRepository $genderRepository): Response
    {
        $femme = $genderRepository->findOneBy(['name' => 'femme']);
        $products = $this->productRepository->findBy(['gender' => $femme]);

        return $this->render('product/femme/list.html.twig', [
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
