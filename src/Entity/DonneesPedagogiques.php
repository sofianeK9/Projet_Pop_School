<?php

namespace App\Entity;

use App\Repository\DonneesPedagogiquesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonneesPedagogiquesRepository::class)]
class DonneesPedagogiques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $compteGithub = null;

    #[ORM\Column(length: 190)]
    private ?string $compteDiscord = null;

    #[ORM\Column(length: 190)]
    private ?string $compteLinkedin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompteGithub(): ?string
    {
        return $this->compteGithub;
    }

    public function setCompteGithub(string $compteGithub): static
    {
        $this->compteGithub = $compteGithub;

        return $this;
    }

    public function getCompteDiscord(): ?string
    {
        return $this->compteDiscord;
    }

    public function setCompteDiscord(string $compteDiscord): static
    {
        $this->compteDiscord = $compteDiscord;

        return $this;
    }

    public function getCompteLinkedin(): ?string
    {
        return $this->compteLinkedin;
    }

    public function setCompteLinkedin(string $compteLinkedin): static
    {
        $this->compteLinkedin = $compteLinkedin;

        return $this;
    }
}
