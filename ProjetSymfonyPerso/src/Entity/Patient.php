<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient extends User
{
    #[ORM\ManyToOne(targetEntity: Medecin::class, inversedBy: 'patients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medecin $medecinT = null;

    /**
     * @var Collection<int, AntecedentMedical>
     */
    #[ORM\OneToMany(targetEntity: AntecedentMedical::class, mappedBy: 'patient')]
    private Collection $antecedantsMedicaux;

    public function __construct()
    {
        $this->antecedantsMedicaux = new ArrayCollection();
    }

    public function getMedecinT(): ?Medecin
    {
        return $this->medecinT;
    }

    public function setMedecinT(?Medecin $medecin): static
    {
        $this->medecinT = $medecin;

        return $this;
    }

    /**
     * @return Collection<int, AntecedentMedical>
     */
    public function getAntecedantsMedicaux(): Collection
    {
        return $this->antecedantsMedicaux;
    }

    public function addAntecedantsMedicaux(AntecedentMedical $antecedantsMedicaux): static
    {
        if (!$this->antecedantsMedicaux->contains($antecedantsMedicaux)) {
            $this->antecedantsMedicaux->add($antecedantsMedicaux);
            $antecedantsMedicaux->setPatient($this);
        }

        return $this;
    }

    public function removeAntecedantsMedicaux(AntecedentMedical $antecedantsMedicaux): static
    {
        if ($this->antecedantsMedicaux->removeElement($antecedantsMedicaux)) {
            // set the owning side to null (unless already changed)
            if ($antecedantsMedicaux->getPatient() === $this) {
                $antecedantsMedicaux->setPatient(null);
            }
        }

        return $this;
    }
}
