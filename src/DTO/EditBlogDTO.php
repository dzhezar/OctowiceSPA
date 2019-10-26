<?php


namespace App\DTO;


class EditBlogDTO
{
    private $seo_title;
    private $seo_description;
    private $image;

    /**
     * EditBlogDTO constructor.
     * @param $seo_title
     * @param $seo_description
     */
    public function __construct($seo_title = null, $seo_description = null)
    {
        $this->seo_title = $seo_title;
        $this->seo_description = $seo_description;
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


}