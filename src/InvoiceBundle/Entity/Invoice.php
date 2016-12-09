<?php

namespace InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="InvoiceBundle\Repository\InvoiceRepository")
 */
class Invoice
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
     * @var int
     *
     * @ORM\Column(name="booking_id", type="integer")
     */
    private $bookingId;

    /**
     * @var float
     *
     * @ORM\Column(name="vehicle_rent", type="float")
     */
    private $vehicleRent;

    /**
     * @var float
     *
     * @ORM\Column(name="equipment_rent", type="float")
     */
    private $equipmentRent;

    /**
     * @var float
     *
     * @ORM\Column(name="insurance_cost", type="float")
     */
    private $insuranceCost;

    /**
     * @var float
     *
     * @ORM\Column(name="service_tax", type="float")
     */
    private $serviceTax;

    /**
     * @var float
     *
     * @ORM\Column(name="vat", type="float")
     */
    private $vat;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set bookingId
     *
     * @param integer $bookingId
     *
     * @return Invoice
     */
    public function setBookingId($bookingId)
    {
        $this->bookingId = $bookingId;

        return $this;
    }

    /**
     * Get bookingId
     *
     * @return int
     */
    public function getBookingId()
    {
        return $this->bookingId;
    }

    /**
     * Set vehicleRent
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
     * Get vehicleRent
     *
     * @return float
     */
    public function getVehicleRent()
    {
        return $this->vehicleRent;
    }

    /**
     * Set equipmentRent
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
     * Get equipmentRent
     *
     * @return float
     */
    public function getEquipmentRent()
    {
        return $this->equipmentRent;
    }

    /**
     * Set insuranceCost
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
     * Get insuranceCost
     *
     * @return float
     */
    public function getInsuranceCost()
    {
        return $this->insuranceCost;
    }

    /**
     * Set serviceTax
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
     * Get serviceTax
     *
     * @return float
     */
    public function getServiceTax()
    {
        return $this->serviceTax;
    }

    /**
     * Set vat
     *
     * @param float $vat
     *
     * @return Invoice
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return float
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set totalAmountPaybale
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
     * Get totalAmountPaybale
     *
     * @return float
     */
    public function getTotalAmountPaybale()
    {
        return $this->totalAmountPaybale;
    }

    /**
     * Set discountAmount
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
     * Get discountAmount
     *
     * @return float
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * Set netAmountPayable
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
     * Get netAmountPayable
     *
     * @return float
     */
    public function getNetAmountPayable()
    {
        return $this->netAmountPayable;
    }
}

