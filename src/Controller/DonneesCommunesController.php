<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\User;
use App\Form\DonneesCommunesType;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/donnees/communes')]
class DonneesCommunesController extends AbstractController
{
    #[Route('/', name: 'app_donnees_communes_index', methods: ['GET'])]
    public function index(ApprenantRepository $apprenantRepository): Response
    {
        $user = $this->getUser();
        /** @var \App\Entity\User $user */
        if ($user) {
            $apprenant = $user->getApprenant();
        }

        return $this->render('donnees_communes/index.html.twig', [
            'apprenant' => $apprenant,
        ]);
    }

    #[Route('/new', name: 'app_donnees_communes_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $apprenant = new Apprenant();
        $form = $this->createForm(DonneesCommunesType::class, $apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($apprenant);
            $entityManager->flush();

            return $this->redirectToRoute('app_donnees_pedagogiques', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('donnees_communes/new.html.twig', [
            'apprenant' => $apprenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_donnees_communes_show', methods: ['GET'])]
    #[IsGranted('ROLE_APPRENANT')]
    public function show(Apprenant $apprenant): Response
    {
        $user = $this->getUser();
        $this->filterSessionUser($user, $apprenant);
        // $this->denyAccessUnlessGranted('VIEW', $apprenant);

        return $this->render('donnees_communes/show.html.twig', [
            'apprenant' => $apprenant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_donnees_communes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Apprenant $apprenant, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $this->filterSessionUser($user, $apprenant);

        $form = $this->createForm(DonneesCommunesType::class, $apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_donnees_communes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('donnees_communes/edit.html.twig', [
            'apprenant' => $apprenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_donnees_communes_delete', methods: ['POST'])]
    public function delete(Request $request, Apprenant $apprenant, EntityManagerInterface $entityManager): Response
    {
        $redirectTo = $request->request->get('_redirect');

        if ($this->isCsrfTokenValid('delete' . $apprenant->getId(), $request->request->get('_token'))) {
            $entityManager->remove($apprenant);
            $entityManager->flush();
        }
        // Ajoutez une alerte pour confirmer la suppression du compte
        $this->addFlash('success', 'Votre compte a été supprimé avec succès.');

        // Redirige vers la page de connexion
        return $this->redirectToRoute('app_login');
    }

    private function filterSessionUser(User $user, Apprenant $apprenant)
    {
        if ($user != $apprenant->getUser()) {
            throw new NotFoundHttpException();
        }
    }
}
