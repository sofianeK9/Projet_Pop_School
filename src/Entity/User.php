<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

#[Gedmo\SoftDeleteable(fieldName: "deletedAt", timeAware: false, hardDelete: false)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Il existe déjà un compte avec cet email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Email(
        message: 'Cet email {{ value }} n\'est pas valide.',
    )]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
 
    #[ORM\Column]
    private ?string $password = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resetToken = null;
    
    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Formateur $formateur = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?ResponsableTerritorial $responsableTerritorial = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Administrateur $administrateur = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Apprenant $apprenant = null;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(string $resetToken) : static
    {
        $this->resetToken = $resetToken;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFormateur(): ?Formateur
    {
        return $this->formateur;
    }

    public function setFormateur(?Formateur $formateur): static
    {
        // unset the owning side of the relation if necessary
        if ($formateur === null && $this->formateur !== null) {
            $this->formateur->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($formateur !== null && $formateur->getUser() !== $this) {
            $formateur->setUser($this);
        }

        $this->formateur = $formateur;

        return $this;
    }

    public function getResponsableTerritorial(): ?ResponsableTerritorial
    {
        return $this->responsableTerritorial;
    }

    public function setResponsableTerritorial(?ResponsableTerritorial $responsableTerritorial): static
    {
        // unset the owning side of the relation if necessary
        if ($responsableTerritorial === null && $this->responsableTerritorial !== null) {
            $this->responsableTerritorial->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($responsableTerritorial !== null && $responsableTerritorial->getUser() !== $this) {
            $responsableTerritorial->setUser($this);
        }

        $this->responsableTerritorial = $responsableTerritorial;

        return $this;
    }

    public function getAdministrateur(): ?Administrateur
    {
        return $this->administrateur;
    }

    public function setAdministrateur(?Administrateur $administrateur): static
    {
        // unset the owning side of the relation if necessary
        if ($administrateur === null && $this->administrateur !== null) {
            $this->administrateur->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($administrateur !== null && $administrateur->getUser() !== $this) {
            $administrateur->setUser($this);
        }

        $this->administrateur = $administrateur;

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
            $this->apprenant->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($apprenant !== null && $apprenant->getUser() !== $this) {
            $apprenant->setUser($this);
        }

        $this->apprenant = $apprenant;

        return $this;
    }

    public function __toString()
    {
        return "{$this->getEmail()}";

    }
}
