<?php


namespace App\DTO;


use Symfony\Component\Validator\Constraints as Assert;

class CreateServiceDTO
{
    private $name;
    private $description;
    /**
     * @Assert\Image()
     */
    private $image;
    private $price;
    private $is_on_service_page;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
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
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getIsOnServicePage()
    {
        return $this->is_on_service_page;
    }

    /**
     * @param mixed $is_on_service_page
     */
    public function setIsOnServicePage($is_on_service_page): void
    {
        $this->is_on_service_page = $is_on_service_page;
    }






}