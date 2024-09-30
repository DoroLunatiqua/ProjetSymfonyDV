<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient extends User
{
    #[ORM\ManyToOne(targetEntity: Medecin::class, inversedBy: 'patients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medecin $medecinT = null;

    public function getMedecinT(): ?Medecin
    {
        return $this->medecinT;
    }

    public function setMedecinT(?Medecin $medecin): static
    {
        $this->medecinT = $medecin;

        return $this;
    }
}
