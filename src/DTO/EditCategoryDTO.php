<?php


namespace App\DTO;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


class EditCategoryDTO
{
    private $price;
    private $seo_title;
    private $seo_description;
    /**
     * @Assert\Image()
     */
    private $icon;
    /**
     * @Assert\Image()
     */
    private $image;
    private $services;

    /**
     * EditCategoryDTO constructor.
     * @param int|null $price
     * @param $seo_title
     * @param $seo_description
     */
    public function __construct(?int $price = null, $seo_title = null, $seo_description = null)
    {
        $this->price = $price;
        $this->seo_title = $seo_title;
        $this->seo_description = $seo_description;
    }


    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getSeoTitle()
    {
        return $this->seo_title;
    }

    /**
     * @param mixed $seo_title
     */
    public function setSeoTitle(?string $seo_title): void
    {
        $this->seo_title = $seo_title;
    }

    /**
     * @return mixed
     */
    public function getSeoDescription()
    {
        return $this->seo_description;
    }

    /**
     * @param mixed $seo_description
     */
    public function setSeoDescription(?string $seo_description): void
    {
        $this->seo_description = $seo_description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage(?UploadedFile $image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param mixed $services
     */
    public function setServices($services): void
    {
        $this->services = $services;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }








}