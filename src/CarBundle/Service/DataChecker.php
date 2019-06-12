<?php


namespace CarBundle\Service;

use CarBundle\Entity\Car;

class DataChecker
{
    /**
     * @var boolean
     */
    protected $requireImagesToPromoteCar;

    protected $entityManager;

    /**
     * DataChecker constructor.
     * @param bool $requireImagesToPromoteCar
     */
    public function __construct($requireImagesToPromoteCar)
    {
        $this->requireImagesToPromoteCar = $requireImagesToPromoteCar;
    }


    /**
     * @param Car $car
     * @return bool
     */
    public function checkCar(Car $car)
    {
        // return "Car " . $car->getModel() . " checked";

        if ($this->requireImagesToPromoteCar) {
            return false;
        }

        return true;
    }
}