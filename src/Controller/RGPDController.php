<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RGPDType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RGPDController extends AbstractController
{
    #[Route('/r/g/p/d', name: 'app_r_g_p_d')]
    public function index(): Response
    {
        return $this->render('rgpd/index.html.twig', [
            'controller_name' => 'RGPDController',
        ]);
    }

    #[Route('/r/g/p/d/validation', name: 'app_r_g_p_d_validation')]
    public function validationRGPD(Request $request, EntityManagerInterface $entityManager)
    {
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
            $apprenant->setConsentement(true);

            // préparation de la requete et envoit de la requete
            $entityManager->persist($apprenant);
            $entityManager->flush();
        }

        return $this->render('rgpd/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
