<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Form\FormulaireCommunType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FormulaireCommunController extends AbstractController
{
    #[Route('/formulaire/commun', name: 'app_formulaire_commun')]
    public function formulaireValidation(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Après l'inscription, je récupère l'utilisateur
        $user = $this->getUser();
        $apprenant = new Apprenant();

        // Création du formulaire
        $form = $this->createForm(FormulaireCommunType::class, $apprenant);

        // Soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $apprenant contient déjà les données du formulaire grâce au formulaire lié
            $apprenant->setUser($user);

            // Persiste l'entité apprenant
            $entityManager->persist($apprenant);

            // Envoie les modifications à la base de données
            $entityManager->flush();
            return $this->redirectToRoute('app_formulaire_commun');
        }
        
       
        return $this->render('formulaire_commun/formulaire_commun.html.twig', [
            'controller_name' => 'FormulaireCommunController',
            'form' => $form->createView(),
        ]);
    }
}
