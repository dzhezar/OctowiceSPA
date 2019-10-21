<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
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
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="services")
     */
    private $category;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ServiceTranslation", mappedBy="service", cascade={"remove"})
     */
    private $serviceTranslations;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_on_service_page;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->serviceTranslations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
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
            $serviceTranslation->setService($this);
        }

        return $this;
    }

    public function removeServiceTranslation(ServiceTranslation $serviceTranslation): self
    {
        if ($this->serviceTranslations->contains($serviceTranslation)) {
            $this->serviceTranslations->removeElement($serviceTranslation);
            // set the owning side to null (unless already changed)
            if ($serviceTranslation->getService() === $this) {
                $serviceTranslation->setService(null);
            }
        }

        return $this;
    }

    public function getIsOnServicePage(): ?bool
    {
        return $this->is_on_service_page;
    }

    public function setIsOnServicePage(bool $is_on_service_page): self
    {
        $this->is_on_service_page = $is_on_service_page;

        return $this;
    }
}
