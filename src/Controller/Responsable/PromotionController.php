<?php

namespace App\Controller\Responsable;

use App\Entity\Promotion;
use App\Form\PromotionResponsable;
use App\Repository\PromotionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/responsable/promotion')]
class PromotionController extends AbstractController
{
    #[Route('/', name: 'app_responsable_promotion_index', methods: ['GET'])]
    public function index(PromotionRepository $promotionRepository): Response
    {
        return $this->render('responsable/promotion/index.html.twig', [
            'promotions' => $promotionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_responsable_promotion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $promotion = new Promotion();
        $form = $this->createForm(PromotionResponsable::class, $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($promotion);
            $entityManager->flush();

            return $this->redirectToRoute('app_responsable_promotion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('responsable/promotion/new.html.twig', [
            'promotion' => $promotion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_responsable_promotion_show', methods: ['GET'])]
    public function show(Promotion $promotion): Response
    {
        $formateur = $promotion->getFormateurs();

        return $this->render('responsable/promotion/show.html.twig', [
            'promotion' => $promotion,
            'formateurs' => $formateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_responsable_promotion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Promotion $promotion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PromotionResponsable::class, $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_responsable_promotion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('responsable/promotion/edit.html.twig', [
            'promotion' => $promotion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_responsable_promotion_delete', methods: ['POST'])]
    public function delete(Request $request, Promotion $promotion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promotion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($promotion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_responsable_promotion_index', [], Response::HTTP_SEE_OTHER);
    }
}
