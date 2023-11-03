<?php

namespace App\Entity;

use App\Repository\DonneesPedagogiquesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false, hardDelete: false)]
#[ORM\Entity(repositoryClass: DonneesPedagogiquesRepository::class)]
class DonneesPedagogiques
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

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

    #[ORM\OneToOne(mappedBy: 'donneesPedagogiques', cascade: ['persist', 'remove'])]
    private ?Apprenant $apprenant = null;

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

    public function getApprenant(): ?Apprenant
    {
        return $this->apprenant;
    }

    public function setApprenant(?Apprenant $apprenant): static
    {
        // unset the owning side of the relation if necessary
        if ($apprenant === null && $this->apprenant !== null) {
            $this->apprenant->setDonneesPedagogiques(null);
        }

        // set the owning side of the relation if necessary
        if ($apprenant !== null && $apprenant->getDonneesPedagogiques() !== $this) {
            $apprenant->setDonneesPedagogiques($this);
        }

        $this->apprenant = $apprenant;

        return $this;
    }
    public function __toString()
    {
        return $this->getCompteDiscord();
    }
  
}
