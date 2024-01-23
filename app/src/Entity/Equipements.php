<?php

namespace App\Entity;

use App\Repository\EquipementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementsRepository::class)]
class Equipements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\ManyToMany(targetEntity: Annonce::class, inversedBy: 'equipements')]
    private Collection $annonce;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

     #[ORM\ManyToMany(targetEntity: House::class, mappedBy: 'equipements')]
    private Collection $houses;

    public function __construct()
    {
        $this->annonce = new ArrayCollection();
        $this->houses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
        }

        return $this;
    }

    public function removeAnnonce(annonce $annonce): static
    {
        $this->annonce->removeElement($annonce);

        return $this;
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
     * @return Collection<int, House>
     */
    public function getHouses(): Collection
    {
        return $this->houses;
    }

     public function addHouse(House $house): static
    {
        if (!$this->houses->contains($house)) {
            $this->houses->add($house);
            $house->getEquipements()->add($this);
        }

        return $this;
    }

    public function removeHouse(House $house): static
    {
        if ($this->houses->removeElement($house)) {
            $house->getEquipements()->removeElement($this);
        }

        return $this;
    }

 
}
