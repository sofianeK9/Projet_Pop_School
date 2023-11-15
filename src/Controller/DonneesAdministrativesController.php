<?php

namespace App\Controller;


use App\Entity\DonneesAdministratives;
use App\Form\DonneesAdministrativesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class DonneesAdministrativesController extends AbstractController
{
    #[Route('/donnees/administratives', name: 'app_donnees_administratives')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        /** @var \App\Entity\User $user */
        $apprenant = $user->getApprenant();

        // je créée le formualire avec un objet données administratives
        $donneesAdministratives = new DonneesAdministratives();
        $form = $this->createForm(DonneesAdministrativesType::class, $donneesAdministratives);
        // je soumets le formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // je metsà jour les données administratives de l'apprenant en lui ajoutant ces données
            $apprenant->setDonneesAdministratives($donneesAdministratives);

            // je persiste les données de l'apprenant
            $entityManager->persist($apprenant);
            $entityManager->flush();

            // je redirige vers une autre page après la soumission réussie
            return $this->redirectToRoute('app_donnees_pedagogiques');
        }

        return $this->render('donnees_administratives/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
