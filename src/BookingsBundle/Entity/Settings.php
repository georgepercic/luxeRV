<?php

namespace BookingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Settings.
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
     * @var int
     *
     * @ORM\Column(name="default_pick_up_time", type="time", nullable=true)
     */
    private $defaultPickUpTime;

    /**
     * @var int
     *
     * @ORM\Column(name="default_drop_off_time", type="time", nullable=true)
     */
    private $defaultDropOffTime;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dailyMiles.
     *
     * @param int $dailyMiles
     *
     * @return Settings
     */
    public function setDailyMiles($dailyMiles)
    {
        $this->dailyMiles = $dailyMiles;

        return $this;
    }

    /**
     * Get dailyMiles.
     *
     * @return int
     */
    public function getDailyMiles()
    {
        return $this->dailyMiles;
    }

    /**
     * Set defaultPickUpTime.
     *
     * @param \DateTime $defaultPickUpTime
     *
     * @return Settings
     */
    public function setDefaultPickUpTime($defaultPickUpTime)
    {
        $this->defaultPickUpTime = $defaultPickUpTime;

        return $this;
    }

    /**
     * Get defaultPickUpTime.
     *
     * @return \DateTime
     */
    public function getDefaultPickUpTime()
    {
        return $this->defaultPickUpTime;
    }

    /**
     * Set defaultDropOffTime.
     *
     * @param \DateTime $defaultDropOffTime
     *
     * @return Settings
     */
    public function setDefaultDropOffTime($defaultDropOffTime)
    {
        $this->defaultDropOffTime = $defaultDropOffTime;

        return $this;
    }

    /**
     * Get defaultDropOffTime.
     *
     * @return \DateTime
     */
    public function getDefaultDropOffTime()
    {
        return $this->defaultDropOffTime;
    }

    /**
     * Set defaultMinRentDays.
     *
     * @param int $defaultMinRentDays
     *
     * @return Settings
     */
    public function setDefaultMinRentDays($defaultMinRentDays)
    {
        $this->defaultMinRentDays = $defaultMinRentDays;

        return $this;
    }

    /**
     * Get defaultMinRentDays.
     *
     * @return int
     */
    public function getDefaultMinRentDays()
    {
        return $this->defaultMinRentDays;
    }

    /**
     * Set taxRate.
     *
     * @param int $taxRate
     *
     * @return Settings
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * Get taxRate.
     *
     * @return int
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * Set depositAmountRate.
     *
     * @param int $depositAmountRate
     *
     * @return Settings
     */
    public function setDepositAmountRate($depositAmountRate)
    {
        $this->depositAmountRate = $depositAmountRate;

        return $this;
    }

    /**
     * Get depositAmountRate.
     *
     * @return int
     */
    public function getDepositAmountRate()
    {
        return $this->depositAmountRate;
    }
}
