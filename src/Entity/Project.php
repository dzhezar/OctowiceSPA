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
     * @ORM\OneToMany(targetEntity="App\Entity\ProjectImage", mappedBy="project" , cascade={"remove"})
     */
    private $projectImages;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->projectTranslations = new ArrayCollection();
        $this->projectImages = new ArrayCollection();
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

    /**
     * @return Collection|ProjectImage[]
     */
    public function getProjectImages(): Collection
    {
        return $this->projectImages;
    }

    public function addProjectImage(ProjectImage $projectImage): self
    {
        if (!$this->projectImages->contains($projectImage)) {
            $this->projectImages[] = $projectImage;
            $projectImage->setProject($this);
        }

        return $this;
    }

    public function removeProjectImage(ProjectImage $projectImage): self
    {
        if ($this->projectImages->contains($projectImage)) {
            $this->projectImages->removeElement($projectImage);
            // set the owning side to null (unless already changed)
            if ($projectImage->getProject() === $this) {
                $projectImage->setProject(null);
            }
        }

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
}
