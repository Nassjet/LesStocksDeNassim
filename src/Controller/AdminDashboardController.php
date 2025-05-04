<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

final class AdminDashboardController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $categorie = new Categorie();
        $formCategorie = $this->createForm(CategorieType::class, $categorie);
        $formCategorie->handleRequest($request);

        if ($formCategorie->isSubmitted() && $formCategorie->isValid()) {
            $em->persist($categorie);
            $em->flush();
            $this->addFlash('success', 'Catégorie ajoutée avec succès.');
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin_dashboard/index.html.twig', [
            'controller_name' => 'AdminDashboardController',
            'formCategorie' => $formCategorie->createView(),
        ]);
    }
}
