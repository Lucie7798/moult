<?php

namespace App\Controller;

use App\Repository\HeaderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HeaderRepository $headerRepository): Response
    {
        $header = $headerRepository->findActiveHeader();

        return $this->render('home/index.html.twig', [
            'header' => $header,
        ]);
    }

    #[Route("/notre-histoire", name: "app_our_story")]
    public function ourStory(HeaderRepository $headerRepository): Response
    {
        $header = $headerRepository->findActiveHeaderForPage('our_story');

        return $this->render('static_pages/notre_histoire.html.twig', [ 
            'header' => $header,
        ]);
    }
}
