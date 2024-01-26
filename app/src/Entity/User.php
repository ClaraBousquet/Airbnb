<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

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
    private ?string $userHouses = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $userReservations = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $userMessages = null;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    #[ORM\Column]
     private $isHost;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: House::class)]
    private Collection $House;

    public function __construct()
    {
        $this->House = new ArrayCollection();
    }

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

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserHouses(): ?string
    {
        return $this->userHouses;
    }

    public function setUserHouses(?string $userHouses): static
    {
        $this->userHouses = $userHouses;

        return $this;
    }

    public function getUserReservations(): ?string
    {
        return $this->userReservations;
    }

    public function setUserReservations(?string $userReservations): static
    {
        $this->userReservations = $userReservations;

        return $this;
    }

    public function getUserMessages(): ?string
    {
        return $this->userMessages;
    }

    public function setUserMessages(?string $userMessages): static
    {
        $this->userMessages = $userMessages;

        return $this;
    }

    public function isIsHost(): ?bool
    {
        return $this->isHost;
    }

    public function setIsHost(?bool $isHost): static
    {
        $this->isHost = $isHost;

        return $this;
    }

    /**
     * @return Collection<int, House>
     */
    public function getHouse(): Collection
    {
        return $this->House;
    }

    public function addHouse(House $house): static
    {
        if (!$this->House->contains($house)) {
            $this->House->add($house);
            $house->setUser($this);
        }

        return $this;
    }

    public function removeHouse(House $house): static
    {
        if ($this->House->removeElement($house)) {
            // set the owning side to null (unless already changed)
            if ($house->getUser() === $this) {
                $house->setUser(null);
            }
        }

        return $this;
    }
}
