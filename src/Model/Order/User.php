<?php

namespace PagaMasTarde\OrdersApiClient\Model\Order;

use PagaMasTarde\OrdersApiClient\Model\AbstractModel;
use PagaMasTarde\OrdersApiClient\Model\Order\User\Address;
use PagaMasTarde\OrdersApiClient\Model\Order\User\OrderHistory;

/**
 * Class User
 * @package PagaMasTarde\OrdersApiClient\Model\Order
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
     * @var OrderHistory[] $orderHistory Array of previous orders
     */
    protected $orderHistory;

    /**
     * @var Address $shippingAddress Shipping address of the order.
     */
    protected $shippingAddress;

    /**
     * Not adding getters nor setters
     *
     * @deprecated
     */
    protected $truncated = false;

    /**
     * Configuration constructor.
     */
    public function __construct()
    {
        $this->address = new Address();
        $this->billingAddress = new Address();
        $this->shippingAddress = new Address();
        $this->orderHistory = array();
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
     * @param $dateOfBirth
     *
     * @return $this
     */
    public function setDateOfBirth($dateOfBirth)
    {
        if (null !== $dateOfBirth) {
            $dateOfBirthParsed = new \DateTime($dateOfBirth);
            $this->dateOfBirth = $dateOfBirthParsed->format('Y-m-d');
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param $dni
     *
     * @return $this
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
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
     * @param $fullName
     *
     * @return $this
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
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
     * @param OrderHistory $orderHistory
     *
     * @return $this
     */
    public function addOrderHistory(OrderHistory $orderHistory)
    {
        $this->orderHistory[] = $orderHistory;

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
     * Overwrite import to fill ordersHistory correctly
     *
     * @param $object
     *
     */
    public function import($object)
    {
        parent::import($object);
        $properties = get_object_vars($object);
        foreach ($properties as $key => $value) {
            if (is_array($value) && $key == 'order_history') {
                $this->orderHistory = array();
                foreach ($value as $orderHistory) {
                    $orderHistoryObject = new OrderHistory();
                    $orderHistoryObject->import($orderHistory);
                    $this->addOrderHistory($orderHistoryObject);
                }
            }
        }
    }
}
