<?php

namespace BookingsBundle\Entity;

use CustomerBundle\Entity\Customer;
use Doctrine\ORM\Mapping as ORM;
use VehicleBundle\Entity\Vehicle;
use VehicleBundle\VehicleBundle;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="BookingsBundle\Repository\BookingRepository")
 */
class Booking
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
     * @var \DateTime
     *
     * @ORM\Column(name="pick_up_date", type="datetime")
     */
    private $pickUpDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="drop_off_date", type="datetime")
     */
    private $dropOffDate;

    /**
     * @ORM\ManyToOne(targetEntity="CustomerBundle\Entity\Customer", inversedBy="bookings")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="VehicleBundle\Entity\Vehicle")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $vehicle;

    /**
     * @return Vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @param $vehicle
     *
     * @return Booking
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pickUpDate
     *
     * @param \DateTime $pickUpDate
     *
     * @return Booking
     */
    public function setPickUpDate($pickUpDate)
    {
        $this->pickUpDate = new \DateTime($pickUpDate);

        return $this;
    }

    /**
     * Get pickUpDate
     *
     * @return \DateTime
     */
    public function getPickUpDate()
    {
        return !empty($this->pickUpDate) ? $this->pickUpDate->format('Y-m-d H:i') : $this->pickUpDate;
    }

    /**
     * Set dropOffDate
     *
     * @param \DateTime $dropOffDate
     *
     * @return Booking
     */
    public function setDropOffDate($dropOffDate)
    {
        $this->dropOffDate = new \DateTime($dropOffDate);

        return $this;
    }

    /**
     * Get dropOffDate
     *
     * @return \DateTime
     */
    public function getDropOffDate()
    {
        return !empty($this->dropOffDate) ? $this->dropOffDate->format('Y-m-d H:i') : $this->dropOffDate;
    }

    /**
     * Set customerId
     *
     * @param $customer
     *
     * @return Booking
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}

