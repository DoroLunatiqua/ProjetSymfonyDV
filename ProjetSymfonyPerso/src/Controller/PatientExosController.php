<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PatientExosController extends AbstractController
{
    #[Route('/patient/exos', name: 'app_patient_exos')]
    public function index(): Response
    {
        return $this->render('patient_exos/index.html.twig', [
            'controller_name' => 'PatientExosController',
        ]);
    }
}
