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
    // pour résoudre fixtures, sinon remettre juste nullable: false
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    private ?Medecin $medecinT = null;

    /**
     * @var Collection<int, AntecedentMedical>
     */
    #[ORM\OneToMany(targetEntity: AntecedentMedical::class, mappedBy: 'patient')]
    private Collection $antecedantsMedicaux;

    /**
     * @var Collection<int, RealisationExoPatient>
     */
    #[ORM\OneToMany(targetEntity: RealisationExoPatient::class, mappedBy: 'patient')]
    private Collection $listeRealisations;


    // liste d'exercices assignes au patient

    /**
     * @var Collection<int, Exercice>
     */
    #[ORM\ManyToMany(targetEntity: Exercice::class, inversedBy: 'patients')]
    private Collection $exercicesAssignes;

    public function __construct()
    {
        $this->antecedantsMedicaux = new ArrayCollection();
        $this->listeRealisations = new ArrayCollection();
        $this->exercicesAssignes = new ArrayCollection();
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

    /**
     * @return Collection<int, RealisationExoPatient>
     */
    public function getListeRealisations(): Collection
    {
        return $this->listeRealisations;
    }

    public function addListeRealisation(RealisationExoPatient $listeRealisation): static
    {
        if (!$this->listeRealisations->contains($listeRealisation)) {
            $this->listeRealisations->add($listeRealisation);
            $listeRealisation->setPatient($this);
        }

        return $this;
    }

    public function removeListeRealisation(RealisationExoPatient $listeRealisation): static
    {
        if ($this->listeRealisations->removeElement($listeRealisation)) {
            // set the owning side to null (unless already changed)
            if ($listeRealisation->getPatient() === $this) {
                $listeRealisation->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercicesAssignes(): Collection
    {
        return $this->exercicesAssignes;
    }

    public function addExercicesAssigne(Exercice $exercicesAssigne): static
    {
        if (!$this->exercicesAssignes->contains($exercicesAssigne)) {
            $this->exercicesAssignes->add($exercicesAssigne);
        }

        return $this;
    }

    public function removeExercicesAssigne(Exercice $exercicesAssigne): static
    {
        $this->exercicesAssignes->removeElement($exercicesAssigne);

        return $this;
    }
}
