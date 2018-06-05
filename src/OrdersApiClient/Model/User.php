<?php

namespace PagaMasTarde\OrdersApiClient\Model;

use PagaMasTarde\OrdersApiClient\Exception\UserException;

/**
 * Class User
 * @package PagaMasTarde\OrdersApiClient\Model
 */
class User extends AbstractModel
{
    /**
     * @var Address $address User address stored in merchant
     */
    protected $address;

    /**
     * @var Address $billingAddress Billing address for the order
     */
    protected $billingAddress;

    /**
     * @var string $dateOfBirth 'YYYY-MM-DD'
     */
    protected $dateOfBirth;

    /**
     * @var string $dni ID of the user
     */
    protected $dni;

    /**
     * @var string $email User email.
     */
    protected $email;

    /**
     * @var string $fixPhone Fix Phone of the user
     */
    protected $fixPhone;

    /**
     * @var string $fullName Full name of the user including 2 surnames.
     */
    protected $fullName;

    /**
     * @var string $mobilePhone Mobile phone of the user
     */
    protected $mobilePhone;

    /**
     * @var array $orderHistory Array of previous orders [['amount' => 100 , 'date' => '2020-10-10'], ...]
     */
    protected $orderHistory;

    /**
     * @var Address $shippingAddress Shipping address of the order.
     */
    protected $shippingAddress;

    /**
     * Configuration constructor.
     */
    public function __construct()
    {
        $this->address = new Address();
        $this->billingAddress = new Address();
        $this->shippingAddress = new Address();
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     *
     * @return User
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param Address $billingAddress
     *
     * @return User
     */
    public function setBillingAddress(Address $billingAddress)
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param string $dateOfBirth
     *
     * @return User
     *
     * @throws UserException
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $dateOfBirthParsed = new \DateTime(date('Y-m-d', $dateOfBirth));
        if ($dateOfBirthParsed >= strtotime('-18 years')) {
            $this->dateOfBirth = $dateOfBirth;
            return $this;
        }

        throw new UserException('Date of birth error. (User cant have less than 18 years');
    }

    /**
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param string $dni
     *
     * @return User
     *
     * @throws UserException
     */
    public function setDni($dni)
    {
        if (self::dniCheck($dni)) {
            $this->dni = $dni;
            return $this;
        }

        throw new UserException('Invalid DNI');
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     *
     * @throws UserException
     */
    public function setEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return $this;
        }

        throw new UserException('Invalid User Email');
    }

    /**
     * @return string
     */
    public function getFixPhone()
    {
        return $this->fixPhone;
    }

    /**
     * @param string $fixPhone
     *
     * @return User
     */
    public function setFixPhone($fixPhone)
    {
        $this->fixPhone = $fixPhone;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     *
     * @return User
     *
     * @throws UserException
     */
    public function setFullName($fullName)
    {
        if (!empty($fullName)) {
            $this->fullName = $fullName;
            return $this;
        }

        throw new UserException('Full name cannot be empty');
    }

    /**
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * @param string $mobilePhone
     *
     * @return User
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    /**
     * @return array
     */
    public function getOrderHistory()
    {
        return $this->orderHistory;
    }

    /**
     * @param array $orderHistory
     *
     * @return User
     */
    public function setOrderHistory($orderHistory)
    {
        $this->orderHistory = $orderHistory;

        return $this;
    }

    /**
     * @return Address
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * @param Address $shippingAddress
     *
     * @return User
     */
    public function setShippingAddress(Address $shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    /**
     * @param $dni
     *
     * @return bool
     */
    public static function dniCheck($dni)
    {
        $letter = substr($dni, -1);
        $numbers = substr($dni, 0, -1);
        if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers%23, 1) == $letter &&
            strlen($letter) == 1 &&
            strlen($numbers) == 8
        ) {
            return true;
        }

        return false;
    }
}
