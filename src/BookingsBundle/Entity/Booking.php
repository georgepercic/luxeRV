<?php

namespace BookingsBundle\Entity;

use CustomerBundle\Entity\Customer;
use Doctrine\ORM\Mapping as ORM;
use VehicleBundle\Entity\Vehicle;
use VehicleBundle\VehicleBundle;

/**
 * Booking.
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="BookingsBundle\Repository\BookingRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Booking
{
    const STATUS_RESERVED = 'reserved';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CLOSED = 'closed';

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
     * @ORM\Column(name="status", type="string")
     */
    private $status = self::STATUS_RESERVED;

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
     * @var string
     *
     * @ORM\Column(name="pick_up_location", type="string", nullable=true)
     */
    private $pickUpLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="drop_off_location", type="string", nullable=true)
     */
    private $dropOffLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="pickup_location_latitude", type="float", nullable=true)
     */
    private $pickupLocationLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="pickup_location_longitude", type="float", nullable=true)
     */
    private $pickupLocationLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="drop_off_location_latitude", type="float", nullable=true)
     */
    private $dropOffLocationLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="drop_off_location_longitude", type="float", nullable=true)
     */
    private $dropOffLocationLongitute;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pickUpDate.
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
     * Get pickUpDate.
     *
     * @return \DateTime
     */
    public function getPickUpDate()
    {
        return !empty($this->pickUpDate) ? $this->pickUpDate->format('Y-m-d H:i') : $this->pickUpDate;
    }

    /**
     * Set dropOffDate.
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
     * Get dropOffDate.
     *
     * @return \DateTime
     */
    public function getDropOffDate()
    {
        return !empty($this->dropOffDate) ? $this->dropOffDate->format('Y-m-d H:i') : $this->dropOffDate;
    }

    /**
     * Set customerId.
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
     * Get customerId.
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param string $pickUpLocation
     *
     * @return Booking
     */
    public function setPickUpLocation($pickUpLocation)
    {
        $this->pickUpLocation = $pickUpLocation;

        return $this;
    }

    /**
     * @return string
     */
    public function getPickUpLocation()
    {
        return $this->pickUpLocation;
    }

    /**
     * @param string $dropOffLocation
     *
     * @return Booking
     */
    public function setDropOffLocation($dropOffLocation)
    {
        $this->dropOffLocation = $dropOffLocation;

        return $this;
    }

    /**
     * @return string
     */
    public function getDropOffLocation()
    {
        return $this->dropOffLocation;
    }

    /**
     * @param string $status
     *
     * @return Booking
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set pickupLocationLatitude.
     *
     * @param float $pickupLocationLatitude
     *
     * @return Booking
     */
    public function setPickupLocationLatitude($pickupLocationLatitude)
    {
        $this->pickupLocationLatitude = $pickupLocationLatitude;

        return $this;
    }

    /**
     * Get pickupLocationLatitude.
     *
     * @return float
     */
    public function getPickupLocationLatitude()
    {
        return $this->pickupLocationLatitude;
    }

    /**
     * Set pickupLocationLongitude.
     *
     * @param float $pickupLocationLongitude
     *
     * @return Booking
     */
    public function setPickupLocationLongitude($pickupLocationLongitude)
    {
        $this->pickupLocationLongitude = $pickupLocationLongitude;

        return $this;
    }

    /**
     * Get pickupLocationLongitude.
     *
     * @return float
     */
    public function getPickupLocationLongitude()
    {
        return $this->pickupLocationLongitude;
    }

    /**
     * Set dropOffLocationLatitude.
     *
     * @param float $dropOffLocationLatitude
     *
     * @return Booking
     */
    public function setDropOffLocationLatitude($dropOffLocationLatitude)
    {
        $this->dropOffLocationLatitude = $dropOffLocationLatitude;

        return $this;
    }

    /**
     * Get dropOffLocationLatitude.
     *
     * @return float
     */
    public function getDropOffLocationLatitude()
    {
        return $this->dropOffLocationLatitude;
    }

    /**
     * Set dropOffLocationLongitute.
     *
     * @param float $dropOffLocationLongitute
     *
     * @return Booking
     */
    public function setDropOffLocationLongitute($dropOffLocationLongitute)
    {
        $this->dropOffLocationLongitute = $dropOffLocationLongitute;

        return $this;
    }

    /**
     * Get dropOffLocationLongitute.
     *
     * @return float
     */
    public function getDropOffLocationLongitute()
    {
        return $this->dropOffLocationLongitute;
    }
}
