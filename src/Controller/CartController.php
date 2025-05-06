<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, ProduitRepository $produitsRepository): Response
    {
        $panier = $session->get('panier', []);
        $data = [];
        $total = 0;

        foreach ($panier as $id => $quantite) {
            $produit = $produitsRepository->find($id);

            if (!$produit) {
                continue;
            }

            $data[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
            $total += $produit->getPrix() * $quantite;
        }

        return $this->render('cart/index.html.twig', [
            'data' => $data,
            'total' => $total
        ]);
    }

    #[Route('/add/{id}', name: 'cart_add')]
    public function add(Produit $produit, SessionInterface $session): Response
    {
        $id = $produit->getId();
        $panier = $session->get('panier', []);

        if (!isset($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/remove/{id}', name: 'cart_remove')]
    public function remove(Produit $produit, SessionInterface $session): Response
    {
        $id = $produit->getId();
        $panier = $session->get('panier', []);

        if (isset($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/delete/{id}', name: 'cart_delete')]
    public function delete(Produit $produit, SessionInterface $session): Response
    {
        $id = $produit->getId();
        $panier = $session->get('panier', []);

        if (isset($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/empty', name: 'cart_empty')]
    public function empty(SessionInterface $session): Response
    {
        $session->set('panier', []);
        $this->addFlash('success', 'Le panier a été vidé.');

        return $this->redirectToRoute('app_cart');
    }
}
