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

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: House::class)]
    private Collection $house;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Annonce::class)]
    private Collection $annonce;

    #[ORM\ManyToMany(targetEntity: Annonce::class, inversedBy: 'categories')]
    private Collection $relation;

    public function __construct()
    {
        $this->house = new ArrayCollection();
        $this->annonce = new ArrayCollection();
        $this->relation = new ArrayCollection();
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

    /**
     * @return Collection<int, Annonce>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Annonce $relation): static
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
        }

        return $this;
    }

    public function removeRelation(Annonce $relation): static
    {
        $this->relation->removeElement($relation);

        return $this;
    }

}
