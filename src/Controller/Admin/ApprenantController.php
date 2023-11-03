<?php

namespace App\Controller\Admin;

use App\Entity\Apprenant;
use App\Form\ApprenantType;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/apprenant')]
class ApprenantController extends AbstractController
{
    #[Route('/', name: 'app_admin_apprenant_index', methods: ['GET'])]
    public function index(ApprenantRepository $apprenantRepository): Response
    {
        return $this->render('admin/apprenant/index.html.twig', [
            'apprenants' => $apprenantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_apprenant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $apprenant = new Apprenant();
        $form = $this->createForm(ApprenantType::class, $apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $apprenant->getUser();
            $user->setRoles(['ROLE_APPRENANT']);
            
            $entityManager->persist($apprenant);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_apprenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/apprenant/new.html.twig', [
            'apprenant' => $apprenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_apprenant_show', methods: ['GET'])]
    public function show(Apprenant $apprenant): Response
    {
        return $this->render('admin/apprenant/show.html.twig', [
            'apprenant' => $apprenant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_apprenant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Apprenant $apprenant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ApprenantType::class, $apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_apprenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/apprenant/edit.html.twig', [
            'apprenant' => $apprenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_apprenant_delete', methods: ['POST'])]
    public function delete(Request $request, Apprenant $apprenant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$apprenant->getId(), $request->request->get('_token'))) {
            $entityManager->remove($apprenant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_apprenant_index', [], Response::HTTP_SEE_OTHER);
    }
}
