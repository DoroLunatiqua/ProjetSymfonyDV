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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question5 = null;

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

    public function getQuestion2(): ?string
    {
        return $this->question2;
    }

    public function setQuestion2(?string $question2): static
    {
        $this->question2 = $question2;

        return $this;
    }

    public function getQuestion3(): ?string
    {
        return $this->question3;
    }

    public function setQuestion3(?string $question3): static
    {
        $this->question3 = $question3;

        return $this;
    }

    public function getQuestion4(): ?string
    {
        return $this->question4;
    }

    public function setQuestion4(?string $question4): static
    {
        $this->question4 = $question4;

        return $this;
    }

    public function getQuestion5(): ?string
    {
        return $this->question5;
    }

    public function setQuestion5(?string $question5): static
    {
        $this->question5 = $question5;

        return $this;
    }
}
