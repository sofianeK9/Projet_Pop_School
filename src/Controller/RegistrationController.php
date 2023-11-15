<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\EmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, EmailService $emailService): Response
     {
        // création d'un user lors de l'inscription et attribution du role apprenant
        $user = new User();
        $user->setRoles(['ROLE_APPRENANT']);

        // création du formualire avec l'objet user et soumission avec la requete http
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        // si mon formulaire est soumis et valide : je récupére le mdp et la confirmation du mdp et la promo
        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            $confirmedPassword = $form->get('confirmedPassword')->getData();

            // condition : si les deux mdp sont différents : j'affiche une erreur avec le message
            if ($plainPassword !== $confirmedPassword) {
                $form->get('confirmedPassword')->addError(new FormError('Le mot de passe doit être identique'));
            } else {
                // récupère le mdp et le hashe
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
                // appelle de la fonction email service afin d'envoyer un mail automatique lors de l'inscription
                $emailService->envois($user->getEmail());
                
                return $this->redirectToRoute('app_rgpd');
            }
            
        }

        // ...

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
