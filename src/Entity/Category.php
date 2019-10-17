<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
    private $icon;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategoryTranslation", mappedBy="category")
     */
    private $categoryTranslations;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SeoTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SeoDescription;

    public function __construct()
    {
        $this->categoryTranslations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

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
            $categoryTranslation->setCategory($this);
        }

        return $this;
    }

    public function removeCategoryTranslation(CategoryTranslation $categoryTranslation): self
    {
        if ($this->categoryTranslations->contains($categoryTranslation)) {
            $this->categoryTranslations->removeElement($categoryTranslation);
            // set the owning side to null (unless already changed)
            if ($categoryTranslation->getCategory() === $this) {
                $categoryTranslation->setCategory(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
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
