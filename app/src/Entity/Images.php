<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'image')]
    private ?annonce $annonce = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnonce(): ?annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?annonce $annonce): static
    {
        $this->annonce = $annonce;

        return $this;
    }
}
