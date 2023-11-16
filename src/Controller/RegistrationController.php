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
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        EmailService $emailService,
        TokenStorageInterface $tokenStorage
    ): Response {
        // création d'un user lors de l'inscription et attribution du rôle apprenant
        $user = new User();
        $user->setRoles(['ROLE_APPRENANT']);

        // création du formulaire avec l'objet user et soumission avec la requête http
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        // si mon formulaire est soumis et valide : je récupère le mdp et la confirmation du mdp et la promo
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

                // initialisation d'une variable token créant un objet qui représente les infos d'idetifications du user :
                // l'objet user qui s'inscrit, le mdp qui est nul car déjà authentifié, le nom du pare-feu utilisé par symfony
                // pour l'authentification, et le role
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                // assignation du token, symfony reconnaitra cet utilisateur comme étant authentifié
                $tokenStorage->setToken($token);

                // Envoyer un e-mail après l'inscription
                $emailService->envois($user->getEmail());

                // Rediriger l'utilisateur vers la page de RGPD
                return $this->redirectToRoute('app_rgpd');
            }
        }

        // ...

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
