<?php


namespace App\DTO;


class EditProjectBlockDTO
{
    private $color;
    private $image;

    /**
     * EditProjectBlockDTO constructor.
     * @param $color
     */
    public function __construct($color)
    {
        $this->color = $color;
    }


    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
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