<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProjectTranslation", mappedBy="project" , cascade={"remove"})
     */
    private $projectTranslations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProjectBlock", mappedBy="project")
     */
    private $projectBlocks;


    public function __construct()
    {
        $this->projectTranslations = new ArrayCollection();
        $this->projectBlocks = new ArrayCollection();
    }

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|ProjectTranslation[]
     */
    public function getProjectTranslations(): Collection
    {
        return $this->projectTranslations;
    }

    public function addProjectTranslation(ProjectTranslation $projectTranslation): self
    {
        if (!$this->projectTranslations->contains($projectTranslation)) {
            $this->projectTranslations[] = $projectTranslation;
            $projectTranslation->setProject($this);
        }

        return $this;
    }

    public function removeProjectTranslation(ProjectTranslation $projectTranslation): self
    {
        if ($this->projectTranslations->contains($projectTranslation)) {
            $this->projectTranslations->removeElement($projectTranslation);
            // set the owning side to null (unless already changed)
            if ($projectTranslation->getProject() === $this) {
                $projectTranslation->setProject(null);
            }
        }

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|ProjectBlock[]
     */
    public function getProjectBlocks(): Collection
    {
        return $this->projectBlocks;
    }

    public function addProjectBlock(ProjectBlock $projectBlock): self
    {
        if (!$this->projectBlocks->contains($projectBlock)) {
            $this->projectBlocks[] = $projectBlock;
            $projectBlock->setProject($this);
        }

        return $this;
    }

    public function removeProjectBlock(ProjectBlock $projectBlock): self
    {
        if ($this->projectBlocks->contains($projectBlock)) {
            $this->projectBlocks->removeElement($projectBlock);
            // set the owning side to null (unless already changed)
            if ($projectBlock->getProject() === $this) {
                $projectBlock->setProject(null);
            }
        }

        return $this;
    }
}
