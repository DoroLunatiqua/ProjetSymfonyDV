<?php

namespace App\Controller;

use App\Repository\ExerciceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListeExercicesController extends AbstractController
{
    #[Route('/liste/exercices', name: 'app_liste_exercices')]
    public function index(ExerciceRepository $rep): Response
    {
        $exercices = $rep->findAll();
        return $this->render('liste_exercices/index.html.twig', [
            'exercices' => $exercices,
        ]);
    }
}
