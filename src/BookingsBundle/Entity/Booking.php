<?php

namespace BookingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
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
    const STATUS_DISPUTE = 'dispute';

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
    private $dropOffLocationLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="services_requested", type="string", nullable=true)
     */
    private $servicesRequested;

    /**
     * @var string
     *
     * @ORM\Column(name="special_requirements", type="string", nullable=true)
     */
    private $specialRequirements;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_ip_address", type="string", nullable=true)
     */
    private $customerIpAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="unit_number", type="string", nullable=true)
     */
    private $unitNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="booking_status", type="string", nullable=true)
     */
    private $bookingStatus;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status.
     *
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
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
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
        $this->pickUpDate = $pickUpDate;

        return $this;
    }

    /**
     * Get pickUpDate.
     *
     * @return \DateTime
     */
    public function getPickUpDate()
    {
        return $this->pickUpDate;
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
        $this->dropOffDate = $dropOffDate;

        return $this;
    }

    /**
     * Get dropOffDate.
     *
     * @return \DateTime
     */
    public function getDropOffDate()
    {
        return $this->dropOffDate;
    }

    /**
     * Set pickUpLocation.
     *
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
     * Get pickUpLocation.
     *
     * @return string
     */
    public function getPickUpLocation()
    {
        return $this->pickUpLocation;
    }

    /**
     * Set dropOffLocation.
     *
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
     * Get dropOffLocation.
     *
     * @return string
     */
    public function getDropOffLocation()
    {
        return $this->dropOffLocation;
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
     * Set dropOffLocationLongitude.
     *
     * @param float $dropOffLocationLongitude
     *
     * @return Booking
     */
    public function setDropOffLocationLongitude($dropOffLocationLongitude)
    {
        $this->dropOffLocationLongitude = $dropOffLocationLongitude;

        return $this;
    }

    /**
     * Get dropOffLocationLongitude.
     *
     * @return float
     */
    public function getDropOffLocationLongitude()
    {
        return $this->dropOffLocationLongitude;
    }

    /**
     * Set servicesRequested.
     *
     * @param string $servicesRequested
     *
     * @return Booking
     */
    public function setServicesRequested($servicesRequested)
    {
        $this->servicesRequested = $servicesRequested;

        return $this;
    }

    /**
     * Get servicesRequested.
     *
     * @return string
     */
    public function getServicesRequested()
    {
        return $this->servicesRequested;
    }

    /**
     * Set specialRequirements.
     *
     * @param string $specialRequirements
     *
     * @return Booking
     */
    public function setSpecialRequirements($specialRequirements)
    {
        $this->specialRequirements = $specialRequirements;

        return $this;
    }

    /**
     * Get specialRequirements.
     *
     * @return string
     */
    public function getSpecialRequirements()
    {
        return $this->specialRequirements;
    }

    /**
     * Set customerIpAddress.
     *
     * @param string $customerIpAddress
     *
     * @return Booking
     */
    public function setCustomerIpAddress($customerIpAddress)
    {
        $this->customerIpAddress = $customerIpAddress;

        return $this;
    }

    /**
     * Get customerIpAddress.
     *
     * @return string
     */
    public function getCustomerIpAddress()
    {
        return $this->customerIpAddress;
    }

    /**
     * Set customer.
     *
     * @param \CustomerBundle\Entity\Customer $customer
     *
     * @return Booking
     */
    public function setCustomer(\CustomerBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer.
     *
     * @return \CustomerBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set vehicle.
     *
     * @param \VehicleBundle\Entity\Vehicle $vehicle
     *
     * @return Booking
     */
    public function setVehicle(\VehicleBundle\Entity\Vehicle $vehicle = null)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get vehicle.
     *
     * @return \VehicleBundle\Entity\Vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * Set unitNumber.
     *
     * @param string $unitNumber
     *
     * @return Booking
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
     * Set bookingStatus.
     *
     * @param string $bookingStatus
     *
     * @return Booking
     */
    public function setBookingStatus($bookingStatus)
    {
        $this->bookingStatus = $bookingStatus;

        return $this;
    }

    /**
     * Get bookingStatus.
     *
     * @return string
     */
    public function getBookingStatus()
    {
        return $this->bookingStatus;
    }
}
