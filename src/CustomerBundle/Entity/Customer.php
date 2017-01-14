<?php

namespace CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer.
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="CustomerBundle\Repository\CustomerRepository")
 */
class Customer
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="additional_phone", type="string", length=20, nullable=true)
     */
    private $additionalPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="whatsapp", type="string", length=100, nullable=true)
     */
    private $whatsapp;

    /**
     * @var string
     *
     * @ORM\Column(name="skype", type="string", length=100, nullable=true)
     */
    private $skype;

    /**
     * @var string
     *
     * @ORM\Column(name="billing", type="text", nullable=true)
     */
    private $billing;

    /**
     * @var string
     *
     * @ORM\Column(name="delivery_address", type="string", length=255, nullable=true)
     */
    private $deliveryAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="pick_up_address", type="string", length=255, nullable=true)
     */
    private $pickUpAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="driver_license", type="string", length=100, nullable=true)
     */
    private $driverLicense;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="driving_licence_expiration_date", type="datetime", nullable=true)
     */
    private $drivingLicenceExpirationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="passport", type="string", length=100, nullable=true)
     */
    private $passport;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_address", type="string", length=100, nullable=true)
     */
    private $ipAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="insurance", type="text")
     */
    private $insurance;

    /**
     * @ORM\OneToMany(targetEntity="BookingsBundle\Entity\Booking", mappedBy="customer")
     */
    private $bookings;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->bookings = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name.
     *
     * @param string $name
     *
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return Customer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set additionalPhone.
     *
     * @param string $additionalPhone
     *
     * @return Customer
     */
    public function setAdditionalPhone($additionalPhone)
    {
        $this->additionalPhone = $additionalPhone;

        return $this;
    }

    /**
     * Get additionalPhone.
     *
     * @return string
     */
    public function getAdditionalPhone()
    {
        return $this->additionalPhone;
    }

    /**
     * Set whatsapp.
     *
     * @param string $whatsapp
     *
     * @return Customer
     */
    public function setWhatsapp($whatsapp)
    {
        $this->whatsapp = $whatsapp;

        return $this;
    }

    /**
     * Get whatsapp.
     *
     * @return string
     */
    public function getWhatsapp()
    {
        return $this->whatsapp;
    }

    /**
     * Set skype.
     *
     * @param string $skype
     *
     * @return Customer
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;

        return $this;
    }

    /**
     * Get skype.
     *
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set billing.
     *
     * @param string $billing
     *
     * @return Customer
     */
    public function setBilling($billing)
    {
        $this->billing = $billing;

        return $this;
    }

    /**
     * Get billing.
     *
     * @return string
     */
    public function getBilling()
    {
        return $this->billing;
    }

    /**
     * Set deliveryAddress.
     *
     * @param string $deliveryAddress
     *
     * @return Customer
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    /**
     * Get deliveryAddress.
     *
     * @return string
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * Set pickUpAddress.
     *
     * @param string $pickUpAddress
     *
     * @return Customer
     */
    public function setPickUpAddress($pickUpAddress)
    {
        $this->pickUpAddress = $pickUpAddress;

        return $this;
    }

    /**
     * Get pickUpAddress.
     *
     * @return string
     */
    public function getPickUpAddress()
    {
        return $this->pickUpAddress;
    }

    /**
     * Set driverLicense.
     *
     * @param string $driverLicense
     *
     * @return Customer
     */
    public function setDriverLicense($driverLicense)
    {
        $this->driverLicense = $driverLicense;

        return $this;
    }

    /**
     * Get driverLicense.
     *
     * @return string
     */
    public function getDriverLicense()
    {
        return $this->driverLicense;
    }

    /**
     * Set drivingLicenceExpirationDate.
     *
     * @param \DateTime $drivingLicenceExpirationDate
     *
     * @return Customer
     */
    public function setDrivingLicenceExpirationDate($drivingLicenceExpirationDate)
    {
        $this->drivingLicenceExpirationDate = $drivingLicenceExpirationDate;

        return $this;
    }

    /**
     * Get drivingLicenceExpirationDate.
     *
     * @return \DateTime
     */
    public function getDrivingLicenceExpirationDate()
    {
        return $this->drivingLicenceExpirationDate;
    }

    /**
     * Set passport.
     *
     * @param string $passport
     *
     * @return Customer
     */
    public function setPassport($passport)
    {
        $this->passport = $passport;

        return $this;
    }

    /**
     * Get passport.
     *
     * @return string
     */
    public function getPassport()
    {
        return $this->passport;
    }

    /**
     * Set ipAddress.
     *
     * @param string $ipAddress
     *
     * @return Customer
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress.
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set insurance.
     *
     * @param string $insurance
     *
     * @return Customer
     */
    public function setInsurance($insurance)
    {
        $this->insurance = $insurance;

        return $this;
    }

    /**
     * Get insurance.
     *
     * @return string
     */
    public function getInsurance()
    {
        return $this->insurance;
    }

    /**
     * Add booking.
     *
     * @param \BookingsBundle\Entity\Booking $booking
     *
     * @return Customer
     */
    public function addBooking(\BookingsBundle\Entity\Booking $booking)
    {
        $this->bookings[] = $booking;

        return $this;
    }

    /**
     * Remove booking.
     *
     * @param \BookingsBundle\Entity\Booking $booking
     */
    public function removeBooking(\BookingsBundle\Entity\Booking $booking)
    {
        $this->bookings->removeElement($booking);
    }

    /**
     * Get bookings.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookings()
    {
        return $this->bookings;
    }
}
