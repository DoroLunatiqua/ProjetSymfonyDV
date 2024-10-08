<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\Patient;
use App\Form\CreationExerciceType;
use App\Repository\ExerciceRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExerciceController extends AbstractController
{
    
    #[Route('/exercice/liste', name: 'app_liste_exercices')]
    public function listeExercices(ExerciceRepository $rep): Response
    {
        $exercices = $rep->findAll();
        return $this->render('exercice/liste.html.twig', [
            'exercices' => $exercices,
        ]);
    }


    #[Route('/exercice/create', name: 'app_creation_exercice')]
    public function exerciceCreate(Request $request, ManagerRegistry $doctrine): Response
    {
        $exercice = new Exercice();
        $formexercice = $this->createForm(CreationExerciceType::class, $exercice);
        $formexercice->handleRequest($request);

        if($formexercice->isSubmitted() && $formexercice->isValid()){
            // $exercice->setTheme();
            // $exercice->setQuestion();
            // $exercice->setReponse();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($exercice);
            $entityManager->flush();
            return $this->redirectToRoute('app_liste_exercices');
        }

        return $this->render('exercice/create.html.twig', [
            'formexercice' => $formexercice,
        ]);
    }


    
    #[Route('/exercice/attribuer/{id}', name: 'exercice_attribuer')]
    public function exerciceAttribuer(ExerciceRepository $rep, Patient $patient): Response
    {
        
        $exercices = $rep->findAll();
        $vars = ['exercices' => $exercices, 'patient'=> $patient];

        return $this->render('patient/exercicesPatient.html.twig', $vars);

        
        // afficher une page qui contient:
        // - tous les exos attribues
        // - tous les exercices possibles



    }

}
