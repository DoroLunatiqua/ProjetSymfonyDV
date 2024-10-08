<?php

namespace App\Entity;

use App\Enum\ThemeExo;
use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

  

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reponse = null;
    #[ORM\Column(type:"string", enumType:ThemeExo::class)]
    private ThemeExo $themeExo;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'listeExercices')]
    private ?RealisationExoPatient $realisationExoPatient = null;

    // liste de patients qui sont censés de réaliser cet exercice
    
    /**
     * @var Collection<int, Patient>
     */
    #[ORM\ManyToMany(targetEntity: Patient::class, mappedBy: 'exercicesAssignes')]
    private Collection $patients;

    public function __construct()
    {
        $this->patients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(?string $reponse): static
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get the value of themeExo
     */
    public function getThemeExo(): ThemeExo
    {
        return $this->themeExo;
    }

    /**
     * Set the value of themeExo
     */
    public function setThemeExo(ThemeExo $themeExo): self
    {
        $this->themeExo = $themeExo;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRealisationExoPatient(): ?RealisationExoPatient
    {
        return $this->realisationExoPatient;
    }

    public function setRealisationExoPatient(?RealisationExoPatient $realisationExoPatient): static
    {
        $this->realisationExoPatient = $realisationExoPatient;

        return $this;
    }

    /**
     * @return Collection<int, Patient>
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    public function addPatient(Patient $patient): static
    {
        if (!$this->patients->contains($patient)) {
            $this->patients->add($patient);
            $patient->addExercicesAssigne($this);
        }

        return $this;
    }

    public function removePatient(Patient $patient): static
    {
        if ($this->patients->removeElement($patient)) {
            $patient->removeExercicesAssigne($this);
        }

        return $this;
    }
}
