<?php

namespace App\Controller;

use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListePatientsController extends AbstractController
{
    #[Route('/liste/patients', name: 'app_liste_patients')]
    public function index(PatientRepository $rep): Response
    {
        $medecin = $this->getUser();
        
        $patients = $medecin->getPatients();


        return $this->render('liste_patients/index.html.twig', [
            "patients" => $patients
        ]);
    }
}
