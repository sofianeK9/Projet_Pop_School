<?php

namespace App\Controller;

use App\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Apprenant;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);

        $keyword = $form->get('keyword')->getData();
        $results = [];

        if ($keyword) {
            $entityManager = $this->getDoctrine()->getManager();
            $results = $entityManager->getRepository(Apprenant::class)
                ->createQueryBuilder('a')
                ->where('a.nom LIKE :keyword OR a.prenom LIKE :keyword')
                ->setParameter('keyword', '%' . $keyword . '%')
                ->getQuery()
                ->getResult();
        }

        return $this->render('recherche/recherche.html.twig', [
            'form' => $form->createView(),
            'keyword' => $keyword,
            'results' => $results,
        ]);
    }
}
