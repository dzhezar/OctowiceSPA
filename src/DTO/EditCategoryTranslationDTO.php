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
     * EditCategoryTranslationDTO constructor.
     * @param $name
     * @param $description
     */
    public function __construct($name = null, $description = null)
    {
        $this->name = $name;
        $this->description = $description;
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




}