<?php

namespace App\Controller\Admin;

use App\Entity\ResponsableTerritorial;
use App\Form\ResponsableTerritorialType;
use App\Repository\ResponsableTerritorialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/responsable/territorial')]
class ResponsableTerritorialController extends AbstractController
{
    #[Route('/', name: 'app_admin_responsable_territorial_index', methods: ['GET'])]
    public function index(ResponsableTerritorialRepository $responsableTerritorialRepository): Response
    {
        return $this->render('admin/responsable_territorial/index.html.twig', [
            'responsable_territorials' => $responsableTerritorialRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_responsable_territorial_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $responsableTerritorial = new ResponsableTerritorial();

        $form = $this->createForm(ResponsableTerritorialType::class, $responsableTerritorial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $responsableTerritorial->getUser();
            $user->setRoles(['ROLE_RESPONSABLE_TERRITORIAL']);
            $entityManager->persist($responsableTerritorial);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_responsable_territorial_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/responsable_territorial/new.html.twig', [
            'responsable_territorial' => $responsableTerritorial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_responsable_territorial_show', methods: ['GET'])]
    public function show(ResponsableTerritorial $responsableTerritorial): Response
    {
        return $this->render('admin/responsable_territorial/show.html.twig', [
            'responsable_territorial' => $responsableTerritorial,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_responsable_territorial_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ResponsableTerritorial $responsableTerritorial, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ResponsableTerritorialType::class, $responsableTerritorial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_responsable_territorial_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/responsable_territorial/edit.html.twig', [
            'responsable_territorial' => $responsableTerritorial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_responsable_territorial_delete', methods: ['POST'])]
    public function delete(Request $request, ResponsableTerritorial $responsableTerritorial, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$responsableTerritorial->getId(), $request->request->get('_token'))) {
            $entityManager->remove($responsableTerritorial);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_responsable_territorial_index', [], Response::HTTP_SEE_OTHER);
    }
}
