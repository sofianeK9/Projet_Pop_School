<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class EmailService
{
    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function envois(string $recepteurEmail): void 
    {
        $email = (new TemplatedEmail())
        ->from('popschool@pop.eu.com')
        ->to($recepteurEmail)
        ->subject('Bienvenue chez Pop School')
        ->html('<p>Merci de vous être inscrit et d\'avoir choisit Pop SChool. N\'oubliez pas de compléter les formulaires afin d\'accéder à votre compte !</p>');

        $this->mailer->send($email);
    }

}