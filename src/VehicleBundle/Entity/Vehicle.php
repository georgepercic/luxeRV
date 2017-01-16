<?php

namespace VehicleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle.
 *
 * @ORM\Table(name="vehicle")
 * @ORM\Entity(repositoryClass="VehicleBundle\Repository\VehicleRepository")
 */
class Vehicle
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
     * @var string
     *
     * @ORM\Column(name="vin", type="string", length=255)
     */
    private $vin;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var int
     *
     * @ORM\Column(name="production_year", type="integer")
     */
    private $productionYear;

    /**
     * @var int
     *
     * @ORM\Column(name="mileage", type="integer")
     */
    private $mileage;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=100)
     */
    private $color;

    /**
     * @var int
     *
     * @ORM\Column(name="week_day_price", type="integer")
     */
    private $weekDayPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="week_end_price", type="integer")
     */
    private $weekEndPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="unit_number", type="string", nullable=true)
     */
    private $unitNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="licence_number", type="string", nullable=true)
     */
    private $licencePlateNumber;

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
     * Set vin.
     *
     * @param string $vin
     *
     * @return Vehicle
     */
    public function setVin($vin)
    {
        $this->vin = $vin;

        return $this;
    }

    /**
     * Get vin.
     *
     * @return string
     */
    public function getVin()
    {
        return $this->vin;
    }

    /**
     * Set brand.
     *
     * @param string $brand
     *
     * @return Vehicle
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand.
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set model.
     *
     * @param string $model
     *
     * @return Vehicle
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set productionYear.
     *
     * @param int $productionYear
     *
     * @return Vehicle
     */
    public function setProductionYear($productionYear)
    {
        $this->productionYear = $productionYear;

        return $this;
    }

    /**
     * Get productionYear.
     *
     * @return int
     */
    public function getProductionYear()
    {
        return $this->productionYear;
    }

    /**
     * Set mileage.
     *
     * @param int $mileage
     *
     * @return Vehicle
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get mileage.
     *
     * @return int
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set color.
     *
     * @param string $color
     *
     * @return Vehicle
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color.
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    public function getVinBrandModel()
    {
        return $this->vin.' '.$this->brand.' '.$this->model;
    }

    /**
     * @param int $weekDayPrice
     *
     * @return Vehicle
     */
    public function setWeekDayPrice($weekDayPrice)
    {
        $this->weekDayPrice = $weekDayPrice;

        return $this;
    }

    /**
     * @return int
     */
    public function getWeekDayPrice()
    {
        return $this->weekDayPrice;
    }

    /**
     * @param int $weekEndPrice
     *
     * @return Vehicle
     */
    public function setWeekEndPrice($weekEndPrice)
    {
        $this->weekEndPrice = $weekEndPrice;

        return $this;
    }

    /**
     * @return int
     */
    public function getWeekEndPrice()
    {
        return $this->weekEndPrice;
    }

    /**
     * @param string $photo
     *
     * @return Vehicle
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set unitNumber.
     *
     * @param string $unitNumber
     *
     * @return Vehicle
     */
    public function setUnitNumber($unitNumber)
    {
        $this->unitNumber = $unitNumber;

        return $this;
    }

    /**
     * Get unitNumber.
     *
     * @return string
     */
    public function getUnitNumber()
    {
        return $this->unitNumber;
    }

    /**
     * Set licencePlateNumber.
     *
     * @param string $licencePlateNumber
     *
     * @return Vehicle
     */
    public function setLicencePlateNumber($licencePlateNumber)
    {
        $this->licencePlateNumber = $licencePlateNumber;

        return $this;
    }

    /**
     * Get licencePlateNumber.
     *
     * @return string
     */
    public function getLicencePlateNumber()
    {
        return $this->licencePlateNumber;
    }
}
