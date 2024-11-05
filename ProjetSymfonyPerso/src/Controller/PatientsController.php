<?php

namespace App\Controller;

use App\Repository\PatientRepository;
use App\Repository\ExerciceRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PatientsController extends AbstractController
{
    #[Route('/patient/liste', name: 'app_liste_patients')]
    public function index(PatientRepository $rep): Response
    {
        $medecin = $this->getUser();
        
        $patients = $medecin->getPatients();


        return $this->render('patient/liste.html.twig', [
            "patients" => $patients
        ]);
    }

    #[Route('/exercice/listeass', name: 'app_liste_exercices_a')]
    public function listeExos(PatientRepository $rep): Response
    {
        $patient = $this->getUser();
        
        $exercices = $patient->getExercicesAssignes();


        return $this->render('patient/exerciceAssignePatient.html.twig', [
            "exercices" => $exercices
        ]);

    }


}
























    //Code proposer par GPT apres relation faite entre realisationExoPatient et Patient pour creer un resultat
//
//     #[Route('/patient/{id}/add-exercice/{exerciceId}', name: 'patient_add_exercice')]
//     public function addExercice(int $id, int $exerciceId, EntityManagerInterface $entityManager): Response
//     {
//         // Récupérer le patient et l'exercice à partir de leur ID
//         $patient = $entityManager->getRepository(Patient::class)->find($id);
//         $exercice = $entityManager->getRepository(Exercice::class)->find($exerciceId);

//         if (!$patient || !$exercice) {
//             throw $this->createNotFoundException('Patient ou exercice non trouvé.');
//         }

//         // Créer une nouvelle instance de ResultatExercicePatient
//         $resultatExercicePatient = new ResultatExercicePatient();
//         $resultatExercicePatient->setPatient($patient);
//         $resultatExercicePatient->setExercice($exercice);
//         $resultatExercicePatient->setResultat(85.5); // Exemple de résultat
//         $resultatExercicePatient->setDate(new \DateTime()); // Date actuelle
//          $resultatExercicePatient->setFeedback("texte"); // 

//         // Persister l'entité intermédiaire
//         $entityManager->persist($resultatExercicePatient);
//         $entityManager->flush();

//         return $this->redirectToRoute('patient_show', ['id' => $patient->getId()]);
//     }
// }

