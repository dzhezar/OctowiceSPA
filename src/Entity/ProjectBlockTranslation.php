<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectBlockTranslationRepository")
 */
class ProjectBlockTranslation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProjectBlock", inversedBy="projectBlockTranslations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projectBlock;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Locale", inversedBy="projectBlockTranslations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $locale;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectBlock(): ?ProjectBlock
    {
        return $this->projectBlock;
    }

    public function setProjectBlock(?ProjectBlock $projectBlock): self
    {
        $this->projectBlock = $projectBlock;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLocale(): ?Locale
    {
        return $this->locale;
    }

    public function setLocale(?Locale $locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}
