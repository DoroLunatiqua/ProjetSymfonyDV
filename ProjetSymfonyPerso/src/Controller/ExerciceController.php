<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Exercice;
use App\Form\CreationExerciceType;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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



        //liste des exercices
        $exercices = $rep->findAll();

        //avoir les exercices assigné pour le  patient
        $exercicesass=$patient->getExercicesAssignes();

        //variable pour envoyé a la vue
        $vars = ['exercices' => $exercices, 'patient'=> $patient,'exercicesass' =>$exercicesass];

        return $this->render('patient/exercicesPatient.html.twig', $vars);

        
        // afficher une page qui contient:
        // - tous les exos attribues
        // - tous les exercices possibles
        // il faut donner la reference de l'exercice au patient indiqué lors du click
        // Get the exercise reference
        // $exercise = $this->getReference('exercice' . $randomExerciseIndex);

        // // Add the exercise to the patient
        // $patient->addExercicesAssigne($exercise);


    }
    //  /**
    //  * Cette méthode sert à assigner un exercice à un patient via une requête AJAX
    // //  * 
    // #[Route('/exercice/{id}/assigner', name: 'exercice_assigner', methods: ['POST'])]


    // public function assignerExercice($id, Request $request, EntityManagerInterface $em): JsonResponse
    // {
    //     // Décoder le contenu JSON de la requête
    //     $data = json_decode($request->getContent(), true);

    //     // Récupérer l'exercice par son ID
    //     $exercice = $em->getRepository(Exercice::class)->find($id);
    //     if (!$exercice) {
    //         return new JsonResponse(['status' => 'Exercice non trouvé'], 404);
    //     }

    //     // Récupérer le patient par son ID 
    //     $patientId = $data['patient_id'];
    //     $patient = $em->getRepository(Patient::class)->find($patientId);
    //     if (!$patient) {
    //         return new JsonResponse(['status' => 'Patient non trouvé'], 404);
    //     }

    //     // Lier l'exercice au patient (sans supprimer l'exercice)
    //     $patient->addExerciceAssigne($exercice); 

    //     // Sauvegarder les modifications
    //     $em->persist($patient);
    //     $em->flush();

    //     // Répondre par un succès en JSON
    //     return new JsonResponse(['status' => 'Exercice assigné avec succès']);
    // }

}
