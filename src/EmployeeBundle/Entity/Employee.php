<?php

namespace EmployeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee.
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="EmployeeBundle\Repository\EmployeeRepository")
 */
class Employee
{

    const ROLE_DRIVER = 'driver';
    const ROLE_ADMINISTRATOR = 'admin';
    const ROLE_MANAGER = 'manager';

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
     * @ORM\Column(name="first_name", type="string", length=100)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date")
     */
    private $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="ssn", type="string", length=255, unique=true)
     */
    private $ssn;

    /**
     * @var string
     *
     * @ORM\Column(name="address_city", type="string", length=255)
     */
    private $addressCity;

    /**
     * @var string
     *
     * @ORM\Column(name="address_state", type="string", length=255)
     */
    private $addressState;

    /**
     * @var string
     *
     * @ORM\Column(name="address_zip", type="string", length=100)
     */
    private $addressZip;

    /**
     * @var string
     *
     * @ORM\Column(name="address_street", type="string", length=255)
     */
    private $addressStreet;

    /**
     * @var int
     *
     * @ORM\Column(name="address_suite_no", type="integer")
     */
    private $addressSuiteNo;

    /**
     * @var string
     *
     * @ORM\Column(name="address_country", type="string", length=255)
     */
    private $addressCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", nullable=true)
     */
    private $role = self::ROLE_DRIVER;

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
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return Employee
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return Employee
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set dob.
     *
     * @param \DateTime $dob
     *
     * @return Employee
     */
    public function setDob($dob)
    {
        $this->dob = new \DateTime($dob);

        return $this;
    }

    /**
     * Get dob.
     *
     * @return \DateTime
     */
    public function getDob()
    {
        return !empty($this->dob) ? $this->dob->format('Y-m-d') : $this->dob;
    }

    /**
     * Set ssn.
     *
     * @param string $ssn
     *
     * @return Employee
     */
    public function setSsn($ssn)
    {
        $this->ssn = $ssn;

        return $this;
    }

    /**
     * Get ssn.
     *
     * @return string
     */
    public function getSsn()
    {
        return $this->ssn;
    }

    /**
     * Set addressCity.
     *
     * @param string $addressCity
     *
     * @return Employee
     */
    public function setAddressCity($addressCity)
    {
        $this->addressCity = $addressCity;

        return $this;
    }

    /**
     * Get addressCity.
     *
     * @return string
     */
    public function getAddressCity()
    {
        return $this->addressCity;
    }

    /**
     * Set addressState.
     *
     * @param string $addressState
     *
     * @return Employee
     */
    public function setAddressState($addressState)
    {
        $this->addressState = $addressState;

        return $this;
    }

    /**
     * Get addressState.
     *
     * @return string
     */
    public function getAddressState()
    {
        return $this->addressState;
    }

    /**
     * Set addressZip.
     *
     * @param string $addressZip
     *
     * @return Employee
     */
    public function setAddressZip($addressZip)
    {
        $this->addressZip = $addressZip;

        return $this;
    }

    /**
     * Get addressZip.
     *
     * @return string
     */
    public function getAddressZip()
    {
        return $this->addressZip;
    }

    /**
     * Set addressStreet.
     *
     * @param string $addressStreet
     *
     * @return Employee
     */
    public function setAddressStreet($addressStreet)
    {
        $this->addressStreet = $addressStreet;

        return $this;
    }

    /**
     * Get addressStreet.
     *
     * @return string
     */
    public function getAddressStreet()
    {
        return $this->addressStreet;
    }

    /**
     * Set addressSuiteNo.
     *
     * @param int $addressSuiteNo
     *
     * @return Employee
     */
    public function setAddressSuiteNo($addressSuiteNo)
    {
        $this->addressSuiteNo = $addressSuiteNo;

        return $this;
    }

    /**
     * Get addressSuiteNo.
     *
     * @return int
     */
    public function getAddressSuiteNo()
    {
        return $this->addressSuiteNo;
    }

    /**
     * Set addressCountry.
     *
     * @param string $addressCountry
     *
     * @return Employee
     */
    public function setAddressCountry($addressCountry)
    {
        $this->addressCountry = $addressCountry;

        return $this;
    }

    /**
     * Get addressCountry.
     *
     * @return string
     */
    public function getAddressCountry()
    {
        return $this->addressCountry;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Employee
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
}
