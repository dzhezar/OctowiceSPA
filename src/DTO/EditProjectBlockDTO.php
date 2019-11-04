<?php


namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;


class EditProjectBlockDTO
{
    private $color;
    private $color_text;
    /**
     * @Assert\Image()
     */
    private $image;

    /**
     * EditProjectBlockDTO constructor.
     * @param string $color
     * @param string $color_text
     */
    public function __construct($color = '#FFFFF', $color_text = '#000000')
    {
        $this->color = $color;
        $this->color_text = $color_text;
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

    /**
     * @return string
     */
    public function getColorText(): string
    {
        return $this->color_text;
    }

    /**
     * @param string $color_text
     */
    public function setColorText(string $color_text): void
    {
        $this->color_text = $color_text;
    }

    



}