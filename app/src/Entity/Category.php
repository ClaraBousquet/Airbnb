<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: house::class)]
    private Collection $house;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: annonce::class)]
    private Collection $annonce;

    #[ORM\Column(length: 255)]
    private ?string $imagePath = null;

    public function __construct()
    {
        $this->house = new ArrayCollection();
        $this->annonce = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, house>
     */
    public function getHouse(): Collection
    {
        return $this->house;
    }

    public function addHouse(house $house): static
    {
        if (!$this->house->contains($house)) {
            $this->house->add($house);
            $house->setCategory($this);
        }

        return $this;
    }

    public function removeHouse(house $house): static
    {
        if ($this->house->removeElement($house)) {
            // set the owning side to null (unless already changed)
            if ($house->getCategory() === $this) {
                $house->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, annonce>
     */
    public function getAnnonce(): Collection
    {
        return $this->annonce;
    }

    public function addAnnonce(annonce $annonce): static
    {
        if (!$this->annonce->contains($annonce)) {
            $this->annonce->add($annonce);
            $annonce->setCategory($this);
        }

        return $this;
    }

    public function removeAnnonce(annonce $annonce): static
    {
        if ($this->annonce->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getCategory() === $this) {
                $annonce->setCategory(null);
            }
        }

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }
}
