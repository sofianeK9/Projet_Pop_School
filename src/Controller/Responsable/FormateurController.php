<?php

namespace App\Controller\Responsable;

use App\Entity\Formateur;
use App\Form\FormateurResponsable;
use App\Repository\FormateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/responsable/formateur')]
class FormateurController extends AbstractController
{
    #[Route('/', name: 'app_responsable_formateur_index', methods: ['GET'])]
    public function index(FormateurRepository $formateurRepository): Response

    {


        return $this->render('responsable/formateur/index.html.twig', [
            'formateurs' => $formateurRepository->findAll(),

        ]);
    }

    #[Route('/new', name: 'app_responsable_formateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formateur = new Formateur();
        $form = $this->createForm(FormateurResponsable::class, $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $formateur->getUser();
            $user->setRoles(['ROLE_FORMATEUR']);

            $entityManager->persist($formateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_responsable_formateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('responsable/formateur/new.html.twig', [
            'formateur' => $formateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_responsable_formateur_show', methods: ['GET'])]
    public function show(Formateur $formateur): Response
    {
        $promotions = $formateur->getPromotions();

        return $this->render('responsable/formateur/show.html.twig', [
            'formateur' => $formateur,
            'promotions' => $promotions,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_responsable_formateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formateur $formateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormateurResponsable::class, $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_responsable_formateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('responsable/formateur/edit.html.twig', [
            'formateur' => $formateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_responsable_formateur_delete', methods: ['POST'])]
    public function delete(Request $request, Formateur $formateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $formateur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_responsable_formateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
