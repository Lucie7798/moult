<?php

namespace App\Controller;

use App\Form\CartRowType;
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

    #[Route("/male", name: "app_products_male")]
    public function listMale(): Response
    {
        $header = $this->headerRepository->findActiveHeaderForPage('male');
        $male = $this->genderRepository->findOneBy(['name' => 'male']);
        $products = $this->productRepository->findBy(['gender' => $male]);
        $sleeves = $this->productRepository->findSleevesByGender($male);

        return $this->render('product/male/list.html.twig', [
            'header' => $header,
            'products' => $products,
            'sleeves' => $sleeves,
        ]);
    }

    #[Route("/female", name: "app_products_female")]
    public function listFemale(): Response
    {
        $header = $this->headerRepository->findActiveHeaderForPage('female');
        $female = $this->genderRepository->findOneBy(['name' => 'female']);
        $products = $this->productRepository->findBy(['gender' => $female]);
        $sleeves = $this->productRepository->findSleevesByGender($female);

        return $this->render('product/female/list.html.twig', [
            'header' => $header,
            'products' => $products,
            'sleeves' => $sleeves,
        ]);
    }

    #[Route('/male/{id<\d+>}', name: 'app_products_male_show')]
    public function showMale(int $id): Response
    {
        $product = $this->productRepository->find($id);
        if ($product->getGender()->getName() !== 'male') {
            return $this->redirectToRoute('app_products_female_show', ['id' => $id]);
        }

        $male = $this->genderRepository->findOneBy(['name' => 'male']);
        $sleeves = $this->productRepository->findSleevesByGender($male);

        $form = $this->createForm(CartRowType::class, [
            'productId' => $product->getId(),
        ], [
            'action' => $this->generateUrl('app_cart'),
        ]);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'sleeves' => $sleeves,
            'form' => $form,
        ]);
    }

    #[Route('/female/{id<\d+>}', name: 'app_products_female_show')]
    public function showFemale(int $id): Response
    {
        $product = $this->productRepository->find($id);
        if ($product->getGender()->getName() !== 'female') {
            return $this->redirectToRoute('app_products_male_show', ['id' => $id]);
        }

        $female = $this->genderRepository->findOneBy(['name' => 'female']);
        $sleeves = $this->productRepository->findSleevesByGender($female);

        $form = $this->createForm(CartRowType::class, [
            'productId' => $product->getId(),
        ]);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'sleeves' => $sleeves,
            'form' => $form,
        ]);
    }
}
