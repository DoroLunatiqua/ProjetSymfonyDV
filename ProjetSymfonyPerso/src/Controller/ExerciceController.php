<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Exercice;
use App\Form\CreationExerciceType;
use App\Entity\RealisationExoPatient;
use App\Form\RealisationExerciceType;
use App\Repository\PatientRepository;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
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


    }

    #[Route('/exercice/attribuer/{patientId}/{exerciceId}', name:'exercice_attribuer_action')]
    public function exerciceAttribuerAction(PatientRepository $rep, int $patientId, ExerciceRepository $rep2, int $exerciceId, ManagerRegistry $doctrine){
        
        $patient= $rep->find($patientId);
        // dd($patient);
        $exercice= $rep2->find($exerciceId);
        $patient->addExercicesAssigne($exercice);
        
        $em=$doctrine->getManager();
        // $em->persist($patient);
        $em->flush();

        return $this->redirectToRoute('exercice_attribuer', ['id'=>$patientId]);
    }

    #[Route('/exercice/supprimer/{patientId}/{exerciceId}', name:'exercice_supprimer_patient')]
    public function exercicePatientSupprimer(PatientRepository $rep, int $patientId, ExerciceRepository $rep2, int $exerciceId, ManagerRegistry $doctrine): Response
    {
        $patient= $rep->find($patientId);
        $exercice= $rep2->find($exerciceId);
        $patient->removeExercicesAssigne($exercice);
        $em=$doctrine->getManager();
        $em->flush();

        return $this->redirectToRoute('exercice_attribuer',['id'=>$patientId] );
    }


    #[Route('/exercice/realisation/{exerciceId}', name: 'app_realisation_exercice')]
    public function exerciceRealisation(Request $request, ManagerRegistry $doctrine, int $exerciceId): Response
    {
        // Récupérer l'exercice avec ses questions associées
        $exercice = $doctrine->getRepository(Exercice::class)->find($exerciceId);
        if (!$exercice) {
            throw $this->createNotFoundException("L'exercice demandé n'existe pas.");
        }

        // Créer une nouvelle instance de RealisationExoPatient
        $realisationExoPatient = new RealisationExoPatient();
        $realisationExoPatient->setQuestion($exercice->getQuestion()); // Définit la question
        $realisationExoPatient->setQuestion2($exercice->getQuestion2());
        $realisationExoPatient->setQuestion3($exercice->getQuestion3());
        $realisationExoPatient->setQuestion4($exercice->getQuestion4());
        $realisationExoPatient->setQuestion5($exercice->getQuestion5());
        
        // Obtenir l'utilisateur connecté (patient)
        $currentPatient = $this->getUser(); //entité Patient
        if ($currentPatient) {
            $realisationExoPatient->setPatient($currentPatient); // Ajoute l'ID du patient connecté
        } else {
            throw $this->createAccessDeniedException("Vous devez être connecté pour soumettre ce formulaire.");
        }

        // Créer le formulaire
        $formresultat = $this->createForm(RealisationExerciceType::class, $realisationExoPatient);  
        $formresultat->handleRequest($request);

        if ($formresultat->isSubmitted() && $formresultat->isValid()) {
            // Définir la date actuelle
            $realisationExoPatient->setDate(new \DateTime());

            $entityManager = $doctrine->getManager();
            $entityManager->persist($realisationExoPatient); 
            $entityManager->flush();

            // Supprimer l'exercice des exercices assignés du patient
        $currentPatient->removeExercicesAssigne($exercice);
        $entityManager->flush(); // Sauvegarder les changements

            return $this->redirectToRoute('app_liste_exercices_a');
        }

        return $this->render('realisation_exercice/realisationExercice.html.twig', [
            'formresultat' => $formresultat->createView(),
        ]);
    }

    #[Route('afficher/exercice/{exerciceId}', name: 'afficher_exercice')]
public function afficherExercice(int $exerciceId, ExerciceRepository $rep)
{
    $exercice = $rep->find($exerciceId);
    if (!$exercice) {
        throw $this->createNotFoundException('Exercice non trouvé');
    }

    return $this->render('exercice/affichage.html.twig', [
        'exercice' => $exercice,
    ]);
}

}


//////////////////////////ESSAI CODE ///////////////////////
// //lorsque le patient click sur l'exercice celui ci renvoit son id et va vers cette route:
//     #[Route('/exercice/realisation/{exerciceId}', name: 'app_realisation_exercice')]
//     public function exerciceRealisation(Request $request, ManagerRegistry $doctrine, int $exerciceId): Response
//     {
//         $resultat = new RealisationExoPatient();
//         $formresultat = $this->createForm(CreationExerciceType::class, $resultat);
//         $formresultat->handleRequest($request);

//     //     //trouver le moyen d'afficher les questions de la BD en rapport avec l'exo dont l'id est dans la route

//         if($formresultat->isSubmitted() && $formresultat->isValid()){
        
//             $entityManager = $doctrine->getManager();
//             $entityManager->persist($resultat);
//             $entityManager->flush();
//             return $this->redirectToRoute('app_liste_exercices');
//         }

//         return $this->render('realisation_exercice/realisationExercice.html.twig', [
//             'formresultat' => $formresultat,
//         ]);
//     }

    
    // #[Route('/exercice/realisation/{exerciceId}', name: 'app_realisation_exercice')]
    // public function exerciceRealisation(Request $request, ManagerRegistry $doctrine, int $exerciceId): Response
    // {
    //     $resultat = new RealisationExoPatient();
    
    //     // Récupérer l'exercice avec ses questions associées
    //     $exercice = $doctrine->getRepository(Exercice::class)->find($exerciceId);
    //     if (!$exercice) {
    //         throw $this->createNotFoundException("L'exercice demandé n'existe pas.");
    //     }
        
    
    //     $realisationExoPatient = new RealisationExoPatient();
    //     $realisationExoPatient->setQuestion($exercice->getQuestion()); // Définit la question
    //     $realisationExoPatient->setDate(new \DateTime());
        
    //     $formresultat = $this->createForm(RealisationExerciceType::class, $realisationExoPatient);  
    //     $formresultat->handleRequest($request);
    
    //     if ($formresultat->isSubmitted() && $formresultat->isValid()) {
    //         $entityManager = $doctrine->getManager();
    //         $entityManager->persist($resultat);
    //         $entityManager->flush();
    //         return $this->redirectToRoute('app_liste_exercices');
    //     }
    
    //     return $this->render('realisation_exercice/realisationExercice.html.twig', [
    //         'formresultat' => $formresultat->createView(),
    //     ]);
    // }