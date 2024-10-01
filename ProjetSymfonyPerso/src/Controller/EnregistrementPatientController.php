<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EnregistrementPatientController extends AbstractController
{
    #[Route('/enregistrement/patient', name: 'app_enregistrement_patient')]
    public function index(): Response
    {
        return $this->render('enregistrement_patient/index.html.twig', [
            'controller_name' => 'EnregistrementPatientController',
        ]);
    }
}

// // src/Controller/PatientController.php
// namespace App\Controller;

// use App\Entity\Patient;
// use App\Form\PatientType;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;

// class PatientController extends AbstractController
// {
//     /**
//      * @Route("/patient/new", name="patient_new")
//      */
//     public function new(Request $request): Response
//     {
//         $patient = new Patient();
//         $medecin = $this->getUser(); // Récupérer le médecin connecté

//         $form = $this->createForm(PatientType::class, $patient);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $patient->setMedecin($medecin);
//             $entityManager = $this->getDoctrine()->getManager();
//             $entityManager->persist($patient);
//             $entityManager->flush();

//             return $this->redirectToRoute('patient_success'); // Redirection après succès
//         }

//         return $this->render('patient/new.html.twig', [
//             'form' => $form->createView(),
//         ]);
//     }
// }
