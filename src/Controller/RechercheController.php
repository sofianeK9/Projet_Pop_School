<?php

namespace App\Controller;

use App\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Apprenant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// src/Controller/RechercheController.php
namespace App\Controller;

use App\Form\RechercheType;
use App\Entity\Apprenant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche')]
    public function recherche(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);

        $results = [];
        $keyword = '';

        if ($form->isSubmitted() && $form->isValid()) {
            $keyword = $form->get('keyword')->getData();

            $results = $entityManager->getRepository(Apprenant::class)->RechercheApprenant($keyword, null, null);
        }



        return $this->render('recherche/recherche.html.twig', [
            'form' => $form->createView(),
            'results' => $results,
            'keyword' => $keyword,
        ]);
    }
}
