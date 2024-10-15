<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        // Vérification du rôle 'ROLE_PATIENT'
        if ($this->isGranted('ROLE_PATIENT')) {
            //creer page de vue patient avec exos?
            return $this->redirectToRoute("app_liste_exercices_a");
        }

        // // Vérification du rôle 'ROLE_MEDIC'
        // if ($this->isGranted('ROLE_MEDIC')) {
        //     // Rediriger les médecins vers leur page d'accueil medecins avec les différents liens.
        //     return $this->redirectToRoute('');
        // }

        // Si l'utilisateur n'a aucun rôle particulier, on affiche la page d'accueil générale
        return $this->render('accueil/index.html.twig');
    }
}
