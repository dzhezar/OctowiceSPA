<?php


namespace App\DTO;

use App\Service\ItemEditor\CreateItemInterface;
use Symfony\Component\Validator\Constraints as Assert;


class CreateProjectBlockDTO implements CreateItemInterface
{
    private $name;
    private $description;
    private $color;
    private $color_text;
    /**
     * @Assert\Image()
     */
    private $image;

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
     * @return mixed
     */
    public function getColorText()
    {
        return $this->color_text;
    }

    /**
     * @param mixed $color_text
     */
    public function setColorText($color_text): void
    {
        $this->color_text = $color_text;
    }





}