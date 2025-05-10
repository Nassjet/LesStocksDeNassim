<?php

// src/Controller/OrderController.php

namespace App\Controller;

use App\Entity\Commandes;
use App\Entity\CommandLine;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandesController extends AbstractController
{
    #[Route('/panier/valider', name: 'app_orders_add')]
    public function validerPanier(Request $request, EntityManagerInterface $em, SecurityBundleSecurity $security, ProduitRepository $productRepository): Response {

        $session = $request->getSession();
        $panier = $session->get('panier', []); // exemple : [idProduit => quantité]

        if (!$panier) {
            $this->addFlash('warning', 'Votre panier est vide.');
            return $this->redirectToRoute('app_home');
        }

        $user = $security->getUser();

        // Crée la commande
        $commande = new Commandes();
        $commande->setOrderNumber(random_int(100000, 999999));
        $commande->setValid(true);
        $commande->setDate(new \DateTime());
        $commande->setUser($user);

        // Crée les lignes de commande
        foreach ($panier as $productId => $quantite) {
            $product = $productRepository->find($productId);
            if ($product) {
                $line = new CommandLine();
                $line->setProduit($product);
                $line->setQuantite($quantite);
                $line->setCommandes($commande);
                $em->persist($line);
            }
        }

        $em->persist($commande);
        $em->flush();

        // Vide le panier
        $session->remove('panier');

        return $this->render('commandes/index.html.twig', [
            'commande' => $commande
        ]);
    }
}
