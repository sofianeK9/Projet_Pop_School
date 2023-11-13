<?php

namespace App\Entity;

use App\Repository\DonneesAdministrativesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false, hardDelete: false)]
#[ORM\Entity(repositoryClass: DonneesAdministrativesRepository::class)]
class DonneesAdministratives
{
    use TimestampableEntity;
    use SoftDeleteableEntity;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[Assert\NotBlank]
    #[Assert\Length(min: 1,  max: 190)]
    #[ORM\Column(length: 190)]
    private ?string $lieuNaissance = null;


    #[Assert\NotBlank]
    #[Assert\Length(min: 1,  max: 190)]
    #[ORM\Column(length: 190)]
    private ?string $email = null;


    #[Assert\NotBlank]
    #[ORM\Column(length: 190)]
    private ?string $paysNaissance = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 1,  max: 190)]
    #[ORM\Column(length: 190)]
    private ?string $adresse = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 1,  max: 190)]
    #[Assert\Regex('/^[0-9]{5}$/')]
    #[ORM\Column(length: 190)]
    private ?string $codePostal = null;


    #[Assert\NotBlank]
    #[Assert\Length(min: 1,  max: 190)]
    #[ORM\Column(length: 190)]
    private ?string $commune = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 1,  max: 190)]
    #[ORM\Column(length: 190)]
    private ?string $nationalite = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 1,  max: 190)]
    #[ORM\Column(length: 190)]
    private ?string $situationProfessionnelle = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 1,  max: 190)]
    #[Assert\Regex('/^[a-zA-Z]{1}[0-9]{7}$/')]
    #[ORM\Column(length: 190)]
    private ?string $numeroPoleEmploi = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 1,  max: 190)]
    #[ORM\Column(length: 190)]
    private ?string $derniereClasseSuivie = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 1,  max: 190)]
    #[ORM\Column(length: 190)]
    private ?string $dernierDiplomeObtenu = null;

    #[ORM\OneToOne(mappedBy: 'donneesAdministratives', cascade: ['persist', 'remove'])]
    private ?Apprenant $apprenant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): static
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPaysNaissance(): ?string
    {
        return $this->paysNaissance;
    }

    public function setPaysNaissance(string $paysNaissance): static
    {
        $this->paysNaissance = $paysNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): static
    {
        $this->commune = $commune;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getSituationProfessionnelle(): ?string
    {
        return $this->situationProfessionnelle;
    }

    public function setSituationProfessionnelle(string $situationProfessionnelle): static
    {
        $this->situationProfessionnelle = $situationProfessionnelle;

        return $this;
    }

    public function getNumeroPoleEmploi(): ?string
    {
        return $this->numeroPoleEmploi;
    }

    public function setNumeroPoleEmploi(string $numeroPoleEmploi): static
    {
        $this->numeroPoleEmploi = $numeroPoleEmploi;

        return $this;
    }

    public function getDerniereClasseSuivie(): ?string
    {
        return $this->derniereClasseSuivie;
    }

    public function setDerniereClasseSuivie(string $derniereClasseSuivie): static
    {
        $this->derniereClasseSuivie = $derniereClasseSuivie;

        return $this;
    }

    public function getDernierDiplomeObtenu(): ?string
    {
        return $this->dernierDiplomeObtenu;
    }

    public function setDernierDiplomeObtenu(string $dernierDiplomeObtenu): static
    {
        $this->dernierDiplomeObtenu = $dernierDiplomeObtenu;

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
            $this->apprenant->setDonneesAdministratives(null);
        }

        // set the owning side of the relation if necessary
        if ($apprenant !== null && $apprenant->getDonneesAdministratives() !== $this) {
            $apprenant->setDonneesAdministratives($this);
        }

        $this->apprenant = $apprenant;

        return $this;
    }
    public function __toString()
    {
        return $this->getLieuNaissance();
    }
}
