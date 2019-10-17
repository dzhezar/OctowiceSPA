<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocaleRepository")
 */
class Locale
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $short_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategoryTranslation", mappedBy="locale")
     */
    private $categoryTranslations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BlogTranslation", mappedBy="locale")
     */
    private $blogTranslations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProjectTranslation", mappedBy="locale")
     */
    private $projectTranslations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ServiceTranslation", mappedBy="locale")
     */
    private $serviceTranslations;

    public function __construct()
    {
        $this->categoryTranslations = new ArrayCollection();
        $this->blogTranslations = new ArrayCollection();
        $this->projectTranslations = new ArrayCollection();
        $this->serviceTranslations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): self
    {
        $this->short_name = $short_name;

        return $this;
    }

    /**
     * @return Collection|CategoryTranslation[]
     */
    public function getCategoryTranslations(): Collection
    {
        return $this->categoryTranslations;
    }

    public function addCategoryTranslation(CategoryTranslation $categoryTranslation): self
    {
        if (!$this->categoryTranslations->contains($categoryTranslation)) {
            $this->categoryTranslations[] = $categoryTranslation;
            $categoryTranslation->setLocale($this);
        }

        return $this;
    }

    public function removeCategoryTranslation(CategoryTranslation $categoryTranslation): self
    {
        if ($this->categoryTranslations->contains($categoryTranslation)) {
            $this->categoryTranslations->removeElement($categoryTranslation);
            // set the owning side to null (unless already changed)
            if ($categoryTranslation->getLocale() === $this) {
                $categoryTranslation->setLocale(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BlogTranslation[]
     */
    public function getBlogTranslations(): Collection
    {
        return $this->blogTranslations;
    }

    public function addBlogTranslation(BlogTranslation $blogTranslation): self
    {
        if (!$this->blogTranslations->contains($blogTranslation)) {
            $this->blogTranslations[] = $blogTranslation;
            $blogTranslation->setLocale($this);
        }

        return $this;
    }

    public function removeBlogTranslation(BlogTranslation $blogTranslation): self
    {
        if ($this->blogTranslations->contains($blogTranslation)) {
            $this->blogTranslations->removeElement($blogTranslation);
            // set the owning side to null (unless already changed)
            if ($blogTranslation->getLocale() === $this) {
                $blogTranslation->setLocale(null);
            }
        }

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
            $projectTranslation->setLocale($this);
        }

        return $this;
    }

    public function removeProjectTranslation(ProjectTranslation $projectTranslation): self
    {
        if ($this->projectTranslations->contains($projectTranslation)) {
            $this->projectTranslations->removeElement($projectTranslation);
            // set the owning side to null (unless already changed)
            if ($projectTranslation->getLocale() === $this) {
                $projectTranslation->setLocale(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ServiceTranslation[]
     */
    public function getServiceTranslations(): Collection
    {
        return $this->serviceTranslations;
    }

    public function addServiceTranslation(ServiceTranslation $serviceTranslation): self
    {
        if (!$this->serviceTranslations->contains($serviceTranslation)) {
            $this->serviceTranslations[] = $serviceTranslation;
            $serviceTranslation->setLocale($this);
        }

        return $this;
    }

    public function removeServiceTranslation(ServiceTranslation $serviceTranslation): self
    {
        if ($this->serviceTranslations->contains($serviceTranslation)) {
            $this->serviceTranslations->removeElement($serviceTranslation);
            // set the owning side to null (unless already changed)
            if ($serviceTranslation->getLocale() === $this) {
                $serviceTranslation->setLocale(null);
            }
        }

        return $this;
    }
}
