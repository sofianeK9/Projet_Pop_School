<?php

namespace App\Controller;

use App\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Apprenant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche')]
    public function recherche(Request $request, EntityManagerInterface $entityManager)
    {
        // création du formulaire et soumission grace à l'objet requete
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);

        // initialisation de varaible results pour y mettre le resultat et keyword pour stocker les mots reccherches
        $results = [];
        $keyword = '';

        // condition : si mon formulaire est valide et soumis : je recupere le contenu saisie par l'utilisateur
        if ($form->isSubmitted() && $form->isValid()) {
            $keyword = $form->get('keyword')->getData();

            // j'effectue une recherche dans le repo des apprenants pour voir si il y a correspondance
            $results = $entityManager->getRepository(Apprenant::class)->recherche($keyword);
        }



        return $this->render('recherche/recherche.html.twig', [
            'form' => $form->createView(),
            'results' => $results,
            'keyword' => $keyword,
        ]);
    }
}
