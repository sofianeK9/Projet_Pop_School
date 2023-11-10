<?php

namespace App\Controller;

use App\Entity\DonneesPedagogiques;
use App\Form\DonneesPedagogiquesFormulairesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DonneesPedagogiquesController extends AbstractController
{
    #[Route('/donnees/pedagogiques', name: 'app_donnees_pedagogiques')]
    public function donneesPedagogiquesValidation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
         /** @var \App\Entity\User $user */
         $apprenant = $user->getApprenant();

         // je créée le formualire avec un objet données pedagogiques
         $donneesPedagogiques = new DonneesPedagogiques();
         $form = $this->createForm(DonneesPedagogiquesFormulairesType::class, $donneesPedagogiques);
        // je soumets le formulaire
         $form->handleRequest($request);
        // je metsà jour les données administratives de l'apprenant en lui ajoutant ces données
         if ($form->isSubmitted() && $form->isValid()) {
            $apprenant->setDonneesPedagogiques($donneesPedagogiques);
             // je persiste les données de l'apprenant
            $entityManager->persist($apprenant);
            $entityManager->flush();
        // je redirige vers une autre page après la soumission réussie

            return $this->redirectToRoute('app_home');
         }

        return $this->render('donnees_pedagogiques/index.html.twig', [
            'controller_name' => 'DonneesPedagogiquesController',
            'form' => $form->createView(),
        ]);
    }
}
