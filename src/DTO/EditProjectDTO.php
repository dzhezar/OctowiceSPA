<?php


namespace App\DTO;


use App\Entity\Category;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class EditProjectDTO
{
    private $seo_title;
    private $seo_description;
    private $link;
    private $image;
    private $photos;
    private $category;

    /**
     * EditProjectDTO constructor.
     * @param $seo_title
     * @param $seo_description
     * @param $link
     * @param Category $category
     */
    public function __construct($seo_title, $seo_description, $link, $category)
    {
        $this->seo_title = $seo_title;
        $this->seo_description = $seo_description;
        $this->link = $link;
        $this->category = $category;
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
    public function setSeoTitle($seo_title): void
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
    public function setSeoDescription($seo_description): void
    {
        $this->seo_description = $seo_description;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link): void
    {
        $this->link = $link;
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
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return null|UploadedFile[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param mixed $photos
     */
    public function setPhotos($photos): void
    {
        $this->photos = $photos;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }




}