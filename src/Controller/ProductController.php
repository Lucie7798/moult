<?php

namespace App\Controller;

use App\Repository\HeaderRepository;
use App\Repository\GenderRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $productRepository;
    private $genderRepository;
    private $headerRepository;

    public function __construct(
        ProductRepository $productRepository,
        GenderRepository $genderRepository,
        HeaderRepository $headerRepository
    ) {
        $this->productRepository = $productRepository;
        $this->genderRepository = $genderRepository;
        $this->headerRepository = $headerRepository;
    }

    #[Route("/homme", name: "app_products_homme")]
    public function listHomme(): Response
    {
        $header = $this->headerRepository->findActiveHeaderForPage('homme');
        $homme = $this->genderRepository->findOneBy(['name' => 'homme']);
        $products = $this->productRepository->findBy(['gender' => $homme]);
        $sleeves = $this->productRepository->findSleevesByGender($homme);

        return $this->render('product/homme/list.html.twig', [
            'header' => $header,
            'products' => $products,
            'sleeves' => $sleeves,
        ]);
    }

    #[Route("/femme", name: "app_products_femme")]
    public function listFemme(): Response
    {
        $header = $this->headerRepository->findActiveHeaderForPage('femme');
        $femme = $this->genderRepository->findOneBy(['name' => 'femme']);
        $products = $this->productRepository->findBy(['gender' => $femme]);
        $sleeves = $this->productRepository->findSleevesByGender($femme);

        return $this->render('product/femme/list.html.twig', [
            'header' => $header,
            'products' => $products,
            'sleeves' => $sleeves,
        ]);
    }

    #[Route('/homme/{id<\d+>}', name: 'app_products_homme_show')]
    public function showHomme(int $id): Response
    {
        $product = $this->productRepository->find($id);
        $homme = $this->genderRepository->findOneBy(['name' => 'homme']);
        $sleeves = $this->productRepository->findSleevesByGender($homme);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'sleeves' => $sleeves,
        ]);
    }
    
    #[Route('/femme/{id<\d+>}', name: 'app_products_femme_show')]
    public function showFemme(int $id): Response
    {
        $product = $this->productRepository->find($id);
        $femme = $this->genderRepository->findOneBy(['name' => 'femme']);
        $sleeves = $this->productRepository->findSleevesByGender($femme);
    
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'sleeves' => $sleeves,
        ]);
    }    
}
