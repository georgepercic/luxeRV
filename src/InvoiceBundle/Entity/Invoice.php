<?php

namespace InvoiceBundle\Entity;

use BookingsBundle\Entity\Booking;
use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice.
 *
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="InvoiceBundle\Repository\InvoiceRepository")
 */
class Invoice
{
    const STATUS_NEW = 'new';
    const STATUS_PAID = 'paid';
    const STATUS_PARTIALLY_PAID = 'partially paid';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="BookingsBundle\Entity\Booking")
     * @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
     */
    private $booking;

    /**
     * @var float
     *
     * @ORM\Column(name="vehicle_rent", type="float")
     */
    private $vehicleRent;

    /**
     * @var float
     *
     * @ORM\Column(name="equipment_rent", type="float", nullable=true)
     */
    private $equipmentRent;

    /**
     * @var float
     *
     * @ORM\Column(name="insurance_cost", type="float", nullable=true)
     */
    private $insuranceCost;

    /**
     * @var float
     *
     * @ORM\Column(name="service_tax", type="float", nullable=true)
     */
    private $serviceTax;

    /**
     * @var float
     *
     * @ORM\Column(name="tax", type="float", nullable=true)
     */
    private $tax;

    /**
     * @var float
     *
     * @ORM\Column(name="total_amount_paybale", type="float")
     */
    private $totalAmountPaybale;

    /**
     * @var float
     *
     * @ORM\Column(name="discount_amount", type="float", nullable=true)
     */
    private $discountAmount;

    /**
     * @var float
     *
     * @ORM\Column(name="net_amount_payable", type="float")
     */
    private $netAmountPayable;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string")
     */
    private $status = self::STATUS_NEW;

    /**
     * @var float
     *
     * @ORM\Column(name="security_deposit", type="float")
     */
    private $security_deposit;

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
     * Set booking.
     *
     * @param Booking
     *
     * @return Invoice
     */
    public function setBooking($booking)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking.
     *
     * @return Booking
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * Set vehicleRent.
     *
     * @param float $vehicleRent
     *
     * @return Invoice
     */
    public function setVehicleRent($vehicleRent)
    {
        $this->vehicleRent = $vehicleRent;

        return $this;
    }

    /**
     * Get vehicleRent.
     *
     * @return float
     */
    public function getVehicleRent()
    {
        return $this->vehicleRent;
    }

    /**
     * Set equipmentRent.
     *
     * @param float $equipmentRent
     *
     * @return Invoice
     */
    public function setEquipmentRent($equipmentRent)
    {
        $this->equipmentRent = $equipmentRent;

        return $this;
    }

    /**
     * Get equipmentRent.
     *
     * @return float
     */
    public function getEquipmentRent()
    {
        return $this->equipmentRent;
    }

    /**
     * Set insuranceCost.
     *
     * @param float $insuranceCost
     *
     * @return Invoice
     */
    public function setInsuranceCost($insuranceCost)
    {
        $this->insuranceCost = $insuranceCost;

        return $this;
    }

    /**
     * Get insuranceCost.
     *
     * @return float
     */
    public function getInsuranceCost()
    {
        return $this->insuranceCost;
    }

    /**
     * Set serviceTax.
     *
     * @param float $serviceTax
     *
     * @return Invoice
     */
    public function setServiceTax($serviceTax)
    {
        $this->serviceTax = $serviceTax;

        return $this;
    }

    /**
     * Get serviceTax.
     *
     * @return float
     */
    public function getServiceTax()
    {
        return $this->serviceTax;
    }

    /**
     * Set tax.
     *
     * @param float $tax
     *
     * @return Invoice
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax.
     *
     * @return float
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set totalAmountPaybale.
     *
     * @param float $totalAmountPaybale
     *
     * @return Invoice
     */
    public function setTotalAmountPaybale($totalAmountPaybale)
    {
        $this->totalAmountPaybale = $totalAmountPaybale;

        return $this;
    }

    /**
     * Get totalAmountPaybale.
     *
     * @return float
     */
    public function getTotalAmountPaybale()
    {
        return $this->totalAmountPaybale;
    }

    /**
     * Set discountAmount.
     *
     * @param float $discountAmount
     *
     * @return Invoice
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;

        return $this;
    }

    /**
     * Get discountAmount.
     *
     * @return float
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * Set netAmountPayable.
     *
     * @param float $netAmountPayable
     *
     * @return Invoice
     */
    public function setNetAmountPayable($netAmountPayable)
    {
        $this->netAmountPayable = $netAmountPayable;

        return $this;
    }

    /**
     * Get netAmountPayable.
     *
     * @return float
     */
    public function getNetAmountPayable()
    {
        return $this->netAmountPayable;
    }

    /**
     * @param string $status
     *
     * @return Invoice
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
     * @param float $security_deposit
     *
     * @return Invoice
     */
    public function setSecurityDeposit($security_deposit)
    {
        $this->security_deposit = $security_deposit;

        return $this;
    }

    /**
     * @return float
     */
    public function getSecurityDeposit()
    {
        return $this->security_deposit;
    }
}
