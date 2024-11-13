<?php

namespace App\Entity;

use App\Repository\RealisationExoPatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealisationExoPatientRepository::class)]
class RealisationExoPatient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $feedback = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resultat = null;

    #[ORM\ManyToOne(inversedBy: 'listeRealisations')]
    private ?Patient $patient = null;

    /**
     * @var Collection<int, Exercice>
     */
    #[ORM\OneToMany(targetEntity: Exercice::class, mappedBy: 'realisationExoPatient')]
    private Collection $listeExercices;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question5 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resultat2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resultat3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resultat4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resultat5 = null;

    public function __construct()
    {
        $this->listeExercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getFeedback(): ?string
    {
        return $this->feedback;
    }

    public function setFeedback(?string $feedback): static
    {
        $this->feedback = $feedback;

        return $this;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(?string $resultat): static
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): static
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getListeExercices(): Collection
    {
        return $this->listeExercices;
    }

    public function addListeExercice(Exercice $listeExercice): static
    {
        if (!$this->listeExercices->contains($listeExercice)) {
            $this->listeExercices->add($listeExercice);
            $listeExercice->setRealisationExoPatient($this);
        }

        return $this;
    }

    public function removeListeExercice(Exercice $listeExercice): static
    {
        if ($this->listeExercices->removeElement($listeExercice)) {
            // set the owning side to null (unless already changed)
            if ($listeExercice->getRealisationExoPatient() === $this) {
                $listeExercice->setRealisationExoPatient(null);
            }
        }

        return $this;
    }

    // Getters et setters pour chaque question
    public function getQuestion(): ?string { return $this->question; }
    public function setQuestion(?string $question): self { $this->question = $question; return $this; }

    public function getQuestion2(): ?string { return $this->question2; }
    public function setQuestion2(?string $question2): self { $this->question2 = $question2; return $this; }

    public function getQuestion3(): ?string { return $this->question3; }
    public function setQuestion3(?string $question3): self { $this->question3 = $question3; return $this; }

    public function getQuestion4(): ?string { return $this->question4; }
    public function setQuestion4(?string $question4): self { $this->question4 = $question4; return $this; }

    public function getQuestion5(): ?string { return $this->question5; }
    public function setQuestion5(?string $question5): self { $this->question5 = $question5; return $this; }

    public function getResultat2(): ?string
    {
        return $this->resultat2;
    }

    public function setResultat2(?string $resultat2): static
    {
        $this->resultat2 = $resultat2;

        return $this;
    }

    public function getResultat3(): ?string
    {
        return $this->resultat3;
    }

    public function setResultat3(?string $resultat3): static
    {
        $this->resultat3 = $resultat3;

        return $this;
    }

    public function getResultat4(): ?string
    {
        return $this->resultat4;
    }

    public function setResultat4(?string $resultat4): static
    {
        $this->resultat4 = $resultat4;

        return $this;
    }

    public function getResultat5(): ?string
    {
        return $this->resultat5;
    }

    public function setResultat5(?string $resultat5): static
    {
        $this->resultat5 = $resultat5;

        return $this;
    }
}
