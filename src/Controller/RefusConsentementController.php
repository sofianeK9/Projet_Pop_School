<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RefusConsentementController extends AbstractController
{
    #[Route('/refus/consentement', name: 'app_refus_consentement')]
    public function index(): Response
    {
        return $this->render('refus_consentement/index.html.twig', [
            'controller_name' => 'RefusConsentementController',
        ]);
    }
}
