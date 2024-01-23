<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?House $house = null;

    #[ORM\ManyToOne(inversedBy: 'annonce')]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Equipements::class, mappedBy: 'annonce')]
    private Collection $equipements;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $images = null;

    #[ORM\OneToMany(mappedBy: 'annonce', targetEntity: Images::class)]
    private Collection $image;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHouse(): ?house
    {
        return $this->house;
    }

    public function setHouse(?house $house): static
    {
        $this->house = $house;

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

    /**
     * @return Collection<int, Equipements>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipements $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->addAnnonce($this);
        }

        return $this;
    }

    public function removeEquipement(Equipements $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            $equipement->removeAnnonce($this);
        }

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Images $image): static
    {
        if (!$this->image->contains($image)) {
            $this->image->add($image);
            $image->setAnnonce($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->image->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAnnonce() === $this) {
                $image->setAnnonce(null);
            }
        }

        return $this;
    }

}
