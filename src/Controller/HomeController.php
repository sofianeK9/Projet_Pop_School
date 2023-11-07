<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\Promotion;
use App\Repository\PromotionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PromotionRepository $promotionRepository): Response
    {
        $promotions = $promotionRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'promotions' => $promotions,
        ]);
    }
    #[Route('/promotion/{id}', name: 'app_home_promotion_show')]
    public function promotionShow(Promotion $promotion): Response
    {
        $formateurs = $promotion->getFormateurs();
        $apprenants = $promotion->getApprenants();

        return $this->render('home/promotion_show.html.twig', [
            'promotion' => $promotion,
            'formateurs' => $formateurs,
            'apprenants' => $apprenants,
        ]);
    }
    #[Route('/apprenant/{id}', name: 'app_home_apprenant_show')]
    public function apprenantShow(Apprenant $apprenant): Response
    {
        

        return $this->render('home/apprenant_show.html.twig', [
            'apprenant' => $apprenant,
        ]);
    }
}
