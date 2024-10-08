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
}
