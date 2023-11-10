<?php

namespace App\Entity;

use App\Repository\ApprenantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;


#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false, hardDelete: false)]
#[ORM\Entity(repositoryClass: ApprenantRepository::class)]
class Apprenant
{
    use TimestampableEntity;
    use SoftDeleteableEntity;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $nom = null;

    #[ORM\Column(length: 190)]
    private ?string $prenom = null;

    #[ORM\Column(length: 190)]
    private ?string $genre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 190)]
    private ?string $telephone = null;

    #[ORM\Column]
    private ?bool $consentement = false;

    #[ORM\OneToOne(inversedBy: 'apprenant', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToOne(inversedBy: 'apprenant', cascade: ['persist', 'remove'])]
    private ?DonneesAdministratives $donneesAdministratives = null;

    #[ORM\OneToOne(inversedBy: 'apprenant', cascade: ['persist', 'remove'])]
    private ?DonneesPedagogiques $donneesPedagogiques = null;

    #[ORM\ManyToOne(inversedBy: 'apprenants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Promotion $promotion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function isConsentement(): ?bool
    {
        return $this->consentement;
    }

    public function setConsentement(bool $consentement): static
    {
        $this->consentement = $consentement;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getDonneesAdministratives(): ?DonneesAdministratives
    {
        return $this->donneesAdministratives;
    }

    public function setDonneesAdministratives(?DonneesAdministratives $donneesAdministratives): static
    {
        $this->donneesAdministratives = $donneesAdministratives;

        return $this;
    }

    public function getDonneesPedagogiques(): ?DonneesPedagogiques
    {
        return $this->donneesPedagogiques;
    }

    public function setDonneesPedagogiques(?DonneesPedagogiques $donneesPedagogiques): static
    {
        $this->donneesPedagogiques = $donneesPedagogiques;

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): static
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function __toString()
{
    return $this->getNom() . ' ' . $this->getPrenom();
}

}
