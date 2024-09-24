<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
class Medecin extends User
{
    #[ORM\Column(length: 20)]
    private ?string $inami = null;

    public function getInami(): ?string
    {
        return $this->inami;
    }

    public function setInami(string $inami): static
    {
        $this->inami = $inami;

        return $this;
    }
}
