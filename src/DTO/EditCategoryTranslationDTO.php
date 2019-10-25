<?php


namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class EditCategoryTranslationDTO
{
    /**
     * @Assert\NotBlank
     */
    private $name;
    /**
     * @Assert\NotBlank
     */
    private $description;
    /**
     * @var null
     */
    private $short_description;


    /**
     * EditCategoryTranslationDTO constructor.
     * @param $name
     * @param $description
     * @param null $short_description
     */
    public function __construct($name = null, $description = null, $short_description = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->short_description = $short_description;
    }

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
     * @return null
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }

    /**
     * @param null $short_description
     */
    public function setShortDescription($short_description): void
    {
        $this->short_description = $short_description;
    }





}