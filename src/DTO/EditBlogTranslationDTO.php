<?php


namespace App\DTO;



use App\Service\ItemEditor\EditItemTranslationInterface;

class EditBlogTranslationDTO implements EditItemTranslationInterface
{
    private $name;
    private $description;

    /**
     * EditBlogTranslationDTO constructor.
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