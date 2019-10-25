<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectBlockRepository")
 */
class ProjectBlock
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="projectBlocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProjectBlockTranslation", mappedBy="projectBlock" , cascade={"remove"})
     */
    private $projectBlockTranslations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $queue;

    public function __construct()
    {
        $this->projectBlockTranslations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|ProjectBlockTranslation[]
     */
    public function getProjectBlockTranslations(): Collection
    {
        return $this->projectBlockTranslations;
    }

    public function addProjectBlockTranslation(ProjectBlockTranslation $projectBlockTranslation): self
    {
        if (!$this->projectBlockTranslations->contains($projectBlockTranslation)) {
            $this->projectBlockTranslations[] = $projectBlockTranslation;
            $projectBlockTranslation->setProjectBlock($this);
        }

        return $this;
    }

    public function removeProjectBlockTranslation(ProjectBlockTranslation $projectBlockTranslation): self
    {
        if ($this->projectBlockTranslations->contains($projectBlockTranslation)) {
            $this->projectBlockTranslations->removeElement($projectBlockTranslation);
            // set the owning side to null (unless already changed)
            if ($projectBlockTranslation->getProjectBlock() === $this) {
                $projectBlockTranslation->setProjectBlock(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getQueue(): ?int
    {
        return $this->queue;
    }

    public function setQueue(int $queue): self
    {
        $this->queue = $queue;

        return $this;
    }
}
