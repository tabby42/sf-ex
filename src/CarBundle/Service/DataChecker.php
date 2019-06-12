<?php


namespace CarBundle\Service;

use CarBundle\Entity\Car;
use Doctrine\ORM\EntityManager;

/**
 * Class DataChecker
 * @package CarBundle\Service
 */
class DataChecker
{
    /**
     * @var boolean
     */
    protected $requireImagesToPromoteCar;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * DataChecker constructor.
     * @param bool $requireImagesToPromoteCar
     * @param EntityManager $entityManager
     */
    public function __construct($entityManager, $requireImagesToPromoteCar)
    {
        $this->requireImagesToPromoteCar = $requireImagesToPromoteCar;
        $this->entityManager = $entityManager;
    }


    /**
     * @param Car $car
     * @return bool
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function checkCar(Car $car)
    {
        // return "Car " . $car->getModel() . " checked";
        $promote =  true;

        if ($this->requireImagesToPromoteCar) {
            $promote =  false;
        }

        $car->setPromote($promote);
        $this->entityManager->persist($car);
        $this->entityManager->flush();

        return $promote;
    }
}