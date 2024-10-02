<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\EnregistrementPatientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class EnregistrementPatientController extends AbstractController
{
    #[Route('/enregistrement/patient', name: 'app_enregistrement_patient')]
    public function index(Request $request, EntityManagerInterface $doctrine): Response
    {
        $patient = new Patient();
   $medecin = $this->getUser(); // Récupérer le médecin connecté

    $form = $this->createForm(EnregistrementPatientType::class, $patient);
       // entre parenthèse le premier param:class de ton formulaire ici: PatientType , deuxieme param l'objet qui recoit les données du formulaire
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $patient->setMedecinT($medecin);
        $patient->setRoles(["ROLE_PATIENT"]);
        $entityManager = $this->$doctrine->getManager();
        $entityManager->persist($patient);
        $entityManager->flush();

        return $this->redirectToRoute('patient_success'); // Redirection après succès
    }


        return $this->render('enregistrement_patient/index.html.twig', [
            'form' => $form,
        ]);
    }
}

