<?php

namespace CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="CarBundle\Repository\CarRepository")
 */
class Car
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Model
     *
     * @ORM\ManyToOne(targetEntity="CarBundle\Entity\Model", inversedBy="cars")
     */
    private $model;

    /**
     * @var Make
     *
     * @ORM\ManyToOne(targetEntity="CarBundle\Entity\Make", inversedBy="cars")
     */
    private $make;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", scale=2, nullable=true)
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    private $year;

    /**
     * @var boolean
     *
     * @ORM\Column(name="navigation", type="boolean", nullable=true)
     */
    private $navigation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="promote", type="boolean", nullable=true)
     */
    private $promote;

    /**
     * @return bool
     */
    public function isNavigation()
    {
        return $this->navigation;
    }

    /**
     * @param bool $navigation
     */
    public function setNavigation($navigation)
    {
        $this->navigation = $navigation;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set make.
     *
     * @param string $make
     *
     * @return Car
     */
    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Get make.
     *
     * @return string
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * Get navigation.
     *
     * @return bool|null
     */
    public function getNavigation()
    {
        return $this->navigation;
    }

    /**
     * Set model.
     *
     * @param \CarBundle\Entity\Model|null $model
     *
     * @return Car
     */
    public function setModel(\CarBundle\Entity\Model $model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model.
     *
     * @return \CarBundle\Entity\Model|null
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return bool
     */
    public function isPromote()
    {
        return $this->promote;
    }

    /**
     * @param bool $promote
     */
    public function setPromote($promote)
    {
        $this->promote = $promote;
    }
}
