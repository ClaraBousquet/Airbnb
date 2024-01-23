<?php

namespace App\Entity;

use App\Repository\HouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HouseRepository::class)]
class House
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'house', targetEntity: Annonce::class)]
    private Collection $annonces;

    #[ORM\ManyToOne(inversedBy: 'house')]
    private ?Category $category = null;


    #[ORM\ManyToMany(targetEntity: Equipements::class, inversedBy: 'houses')]
private Collection $equipements;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagePath = null;

    #[ORM\Column]
    private ?string $numberRooms = null;

    #[ORM\Column(nullable: true)]
    private ?string $numberGuest = null;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): static
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setHouse($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): static
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getHouse() === $this) {
                $annonce->setHouse(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }




    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getNumberRooms(): ?string
    {
        return $this->numberRooms;
    }

    public function setNumberRooms(string $numberRooms): static
    {
        $this->numberRooms = $numberRooms;

        return $this;
    }

    public function getNumberGuest(): ?string
    {
        return $this->numberGuest;
    }

    public function setNumberGuest(?string $numberGuest): static
    {
        $this->numberGuest = $numberGuest;

        return $this;
    }



    /**
     * @return Collection<int, Equipements>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipements(Equipements $equipements): static
    {
        if (!$this->equipements->contains($equipements)) {
            $this->equipements->add($equipements);
            $equipements->addHouse($this);
        }

        return $this;
    }
}
