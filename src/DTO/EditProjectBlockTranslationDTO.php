<?php


namespace App\DTO;


use App\Service\ItemEditor\EditItemTranslationInterface;

class EditProjectBlockTranslationDTO implements EditItemTranslationInterface
{
    private $name;
    private $description;

    /**
     * EditProjectBlockTranslationDTO constructor.
     * @param $name
     * @param $description
     */
    public function __construct($name, $description)
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