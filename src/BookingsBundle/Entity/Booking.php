<?php

namespace BookingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var int
     *
     * @ORM\Column(name="customer_id", type="integer")
     */
    private $customerId;

    /**
     * @var int
     *
     * @ORM\Column(name="vehicle_id", type="integer")
     */
    private $vehicleId;


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
        return !empty($this->pickUpDate) ? $this->pickUpDate->format('Y-m-d') : $this->pickUpDate;
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
        return !empty($this->dropOffDate) ? $this->dropOffDate->format('Y-m-d') : $this->dropOffDate;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     *
     * @return Booking
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set vehicleId
     *
     * @param integer $vehicleId
     *
     * @return Booking
     */
    public function setVehicleId($vehicleId)
    {
        $this->vehicleId = $vehicleId;

        return $this;
    }

    /**
     * Get vehicleId
     *
     * @return int
     */
    public function getVehicleId()
    {
        return $this->vehicleId;
    }
}

