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
    // #[Route('/r/g/p/d', name: 'app_rgpd')]
    #[Route('/rgpd', name: 'app_rgpd')]
    public function rgpdValidation(Request $request, EntityManagerInterface $entityManager): Response {
        // Aprés l'inscription, je récupére le user 
        $user = $this->getUser();

        // condition : verifie si user est bien une instance de la classe user sinon il le redirige vers la page inscription
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_register');
        }

        // recupére apprenant associé à l'user
        $apprenant = $user->getApprenant();

        // création du formulaire et soumission
        $form = $this->createForm(RGPDType::class);
        $form->handleRequest($request);

        // si le formulaire est valide et soumis : l'apprenant consent au réglement
        if ($form->isSubmitted() && $form->isValid()) {
            if ($apprenant instanceof Apprenant && $form->get('consentement')->getData() === true) {
                $apprenant->setConsentement(true);

                // préparation de la requête et envoit de la requête
                $entityManager->persist($apprenant);
                $entityManager->persist($user);
                $entityManager->flush();

                // Redirige vers le formulaire commun si le consentement est true
                return $this->redirectToRoute('app_formulaire_commun');
            }
        } elseif ($apprenant instanceof Apprenant && $form->get('consentement')->getData() === false) {
            $form->get('consentement')->addError(new FormError('Vous devez valider le règlement RGPD afin de pouvoir continuer'));
        }

        return $this->render('rgpd/index.html.twig', [
            'controller_name' => 'RGPDController',
            'form' => $form->createView(),
        ]);
    }
}
