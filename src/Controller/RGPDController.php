<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\User;
use App\Form\RGPDType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RGPDController extends AbstractController
{
    #[Route('/rgpd', name: 'app_rgpd')]
    public function rgpdValidation(Request $request, EntityManagerInterface $entityManager): Response {
        // Aprés l'inscription, je récupére le user 
        $user = $this->getUser();
        // $apprenant = new Apprenant();
        // $apprenant->setUser($this->getUser());
        // ;
        // $apprenant->setNom('');
        // $apprenant->setPrenom('');
        // $apprenant->setGenre('');
        // $apprenant->setDateNaissance(new \DateTime(''));
        // $apprenant->setTelephone('');


        // création du formulaire et soumission
        $form = $this->createForm(RGPDType::class);
        $form->handleRequest($request);

        // si le formulaire est valide et soumis : l'apprenant consent au réglement
        if ($form->isSubmitted() && $form->isValid()) 
             {
                // préparation de la requête et envoit de la requête
                $entityManager->persist($user);
                $entityManager->flush();

                // if ($apprenant instanceof Apprenant && $form->get('consentement')->getData() === true) {
                //     echo 'conditon vraie';
                //     $apprenant->setConsentement(true);
                    
                    return $this->redirectToRoute('app_formulaire_commun');
    
            
        }

        return $this->render('rgpd/index.html.twig', [
            'controller_name' => 'RGPDController',
            'form' => $form->createView(),
        ]);
    }
}
