<?php


namespace App\DTO;


class EditServiceDTO
{
    private $price;
    private $image;

    /**
     * EditServiceDTO constructor.
     * @param $price
     * @param $image
     */
    public function __construct($price = null)
    {
        $this->price = $price;
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