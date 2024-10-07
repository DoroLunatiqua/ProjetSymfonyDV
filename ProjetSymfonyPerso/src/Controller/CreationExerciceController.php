<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreationExerciceController extends AbstractController
{
    #[Route('/creation/exercice', name: 'app_creation_exercice')]
    public function index(): Response
    {
        return $this->render('creation_exercice/index.html.twig', [
            'controller_name' => 'CreationExerciceController',
        ]);
    }
}
