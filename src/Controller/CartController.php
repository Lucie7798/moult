<?php

namespace App\Controller;

use App\Cart\Cart;
use App\Form\CartRowType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(
        Request $request,
        ProductRepository $productRepository
    ): Response
    {   
        $session = $request->getSession();
        if (!$session->has('cart')) {
            $session->set('cart', new Cart());
        }

        /** @var Cart */
        $cart = $session->get('cart');

        $form = $this->createForm(CartRowType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $product = $productRepository->find($data['productId']);

            if (!$product) {
                throw new \InvalidArgumentException('Product not found');
            }

            $cart->add($product, $data['quantity']);

            return $this->redirectToRoute('app_cart');
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
        ]);
    }
}
