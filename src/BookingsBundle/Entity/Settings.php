<?php

namespace BookingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity(repositoryClass="BookingsBundle\Repository\SettingsRepository")
 */
class Settings
{
    const DEFAULT_DAILY_MILES = 100;
    const DEFAULT_MIN_RATE_DAYS = 3;
    const DEFAULT_TAX_RATE = 9;
    const DEFAULT_DEPOSIT_RATE = 50;

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
     * @ORM\Column(name="daily_miles", type="integer")
     */
    private $dailyMiles = self::DEFAULT_DAILY_MILES;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="default_pick_up_date", type="datetime", nullable=true)
     */
    private $defaultPickUpDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="default_drop_off_date", type="datetime", nullable=true)
     */
    private $defaultDropOffDate;

    /**
     * @var int
     *
     * @ORM\Column(name="default_min_rent_days", type="integer")
     */
    private $defaultMinRentDays = self::DEFAULT_MIN_RATE_DAYS;

    /**
     * @var int
     *
     * @ORM\Column(name="tax_rate", type="integer")
     */
    private $taxRate = self::DEFAULT_TAX_RATE;

    /**
     * @var int
     *
     * @ORM\Column(name="deposit_amount_rate", type="integer")
     */
    private $depositAmountRate = self::DEFAULT_DEPOSIT_RATE;


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
     * Set dailyMiles
     *
     * @param integer $dailyMiles
     *
     * @return Settings
     */
    public function setDailyMiles($dailyMiles)
    {
        $this->dailyMiles = $dailyMiles;

        return $this;
    }

    /**
     * Get dailyMiles
     *
     * @return int
     */
    public function getDailyMiles()
    {
        return $this->dailyMiles;
    }

    /**
     * Set defaultPickUpDate
     *
     * @param \DateTime $defaultPickUpDate
     *
     * @return Settings
     */
    public function setDefaultPickUpDate($defaultPickUpDate)
    {
        $this->defaultPickUpDate = $defaultPickUpDate;

        return $this;
    }

    /**
     * Get defaultPickUpDate
     *
     * @return \DateTime
     */
    public function getDefaultPickUpDate()
    {
        return $this->defaultPickUpDate;
    }

    /**
     * Set defaultDropOffDate
     *
     * @param \DateTime $defaultDropOffDate
     *
     * @return Settings
     */
    public function setDefaultDropOffDate($defaultDropOffDate)
    {
        $this->defaultDropOffDate = $defaultDropOffDate;

        return $this;
    }

    /**
     * Get defaultDropOffDate
     *
     * @return \DateTime
     */
    public function getDefaultDropOffDate()
    {
        return $this->defaultDropOffDate;
    }

    /**
     * Set defaultMinRentDays
     *
     * @param integer $defaultMinRentDays
     *
     * @return Settings
     */
    public function setDefaultMinRentDays($defaultMinRentDays)
    {
        $this->defaultMinRentDays = $defaultMinRentDays;

        return $this;
    }

    /**
     * Get defaultMinRentDays
     *
     * @return int
     */
    public function getDefaultMinRentDays()
    {
        return $this->defaultMinRentDays;
    }

    /**
     * Set taxRate
     *
     * @param integer $taxRate
     *
     * @return Settings
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * Get taxRate
     *
     * @return int
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * Set depositAmountRate
     *
     * @param integer $depositAmountRate
     *
     * @return Settings
     */
    public function setDepositAmountRate($depositAmountRate)
    {
        $this->depositAmountRate = $depositAmountRate;

        return $this;
    }

    /**
     * Get depositAmountRate
     *
     * @return int
     */
    public function getDepositAmountRate()
    {
        return $this->depositAmountRate;
    }
}

