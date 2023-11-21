<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\Promotion;
use App\Repository\PromotionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, PromotionRepository $promotionRepository, PaginatorInterface $paginator): Response
    {
        $promotions = $promotionRepository->findAll();
        $pagination = $paginator->paginate(
            $promotions,
            $request->query->getInt('page', 1),
            10 // Limite d'éléments par page
        );


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'promotions' => $pagination,
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
    
    #[Route('/mentions_legales', name: 'app_home_mentions_legales')]
    public function mentionsLegales(): Response
    {
        
        $mentions = 'Mentions légales de Pop SChool';

        return $this->render('home/mentions_legales.html.twig', [
            'mentions'=> $mentions,
        ]);
    }
}
