<?php


namespace App\DTO;

use App\Service\ItemEditor\EditItemInterface;
use Symfony\Component\Validator\Constraints as Assert;


class EditServiceDTO implements EditItemInterface
{
    private $price;
    /**
     * @Assert\Image()
     */
    private $image;
    /**
     * @var null
     */
    private $is_on_service_page;

    /**
     * EditServiceDTO constructor.
     * @param $price
     * @param null $is_on_service_page
     */
    public function __construct($price = null, $is_on_service_page = null)
    {
        $this->price = $price;
        $this->is_on_service_page = $is_on_service_page;
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

    /**
     * @return null
     */
    public function getIsOnServicePage()
    {
        return $this->is_on_service_page;
    }

    /**
     * @param null $is_on_service_page
     */
    public function setIsOnServicePage($is_on_service_page): void
    {
        $this->is_on_service_page = $is_on_service_page;
    }





}