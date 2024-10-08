<?php

namespace App\Entity;

use App\Enum\ThemeExo;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $theme = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $question = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reponse = null;
    #[ORM\Column(type:"string", enumType:ThemeExo::class)]
    private ThemeExo $themeExo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): static
    {
        $this->theme = $theme;

        return $this;
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
}
