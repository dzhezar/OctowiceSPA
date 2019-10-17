<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SeoTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SeoDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeoTitle(): ?string
    {
        return $this->SeoTitle;
    }

    public function setSeoTitle(?string $SeoTitle): self
    {
        $this->SeoTitle = $SeoTitle;

        return $this;
    }

    public function getSeoDescription(): ?string
    {
        return $this->SeoDescription;
    }

    public function setSeoDescription(?string $SeoDescription): self
    {
        $this->SeoDescription = $SeoDescription;

        return $this;
    }
}
