<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        // création d'un user lors de l'inscription et attribution du rôle apprenant
        $user = new User();
        $user->setRoles(['ROLE_APPRENANT']);
    
        // création du formulaire avec l'objet user et soumission avec la requête HTTP
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
    
        // si mon formulaire est soumis et valide : je récupère le mdp, la confirmation du mdp et la promo
        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            $promotion = $form->get('promotion')->getData();
    
            // Vérifier si l'utilisateur est déjà associé à un Apprenant
            $apprenant = $user->getApprenant();
            if (!$apprenant) {
                // Si non, créer une nouvelle instance d'Apprenant et l'associer à l'utilisateur
                $apprenant = new Apprenant();
                $apprenant->setUser($user);
                $apprenant->setPromotion($promotion);
                
            }
    
            // Récupérer le mot de passe et le hasher
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $plainPassword
                )
            );
    
            // préparation de la requête et envoi de la requête
            $entityManager->persist($user);
            $entityManager->flush();
    
            // do anything else you need here, like send an email
    
            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }
    
        // ...
    
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
