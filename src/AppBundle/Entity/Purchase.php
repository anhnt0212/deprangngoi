<?php

/*
 * This file is part of the Doctrine-TestSet project created by
 * https://github.com/MacFJA
 *
 * For the full copyright and license information, please view the LICENSE
 * at https://github.com/MacFJA/Doctrine-TestSet
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Model\Shipment;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Purchase.
 *
 * @author MacFJA
 *
 * @ORM\Table(name="purchase")
 * @ORM\Entity
 */
class Purchase
{
    /**
     * The identifier of the product.
     *
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255,name="purchase_no")
     */
    protected $purchaseNo;

    /**
     * The date of the delivery (it doesn't include the time).
     *
     * @var \DateTime
     * @ORM\Column(type="date")
     */

    protected $deliveryDate = null;

    /**
     * The purchase datetime in the customer timezone.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime",name="created_at")
     */
    protected $createdAt = null;
    /**
     * The purchase datetime in the customer timezone.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime",name="updated_at")
     */
    protected $updatedAt = null;
    /**
     * The customer preferred time of the day for the delivery.
     *
     * @var \DateTime|null
     * @ORM\Column(type="time", nullable=true)
     */
    protected $deliveryHour = null;

    /**
     * @var string
     * @ORM\Column(type="string", length=255,name="customer_name")
     */
    protected $customerName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255,name="customer_phone")
     */
    protected $customerPhone;
    /**
     * @var string
     * @ORM\Column(type="string", length=255,name="customer_email")
     */
    protected $customerEmail;

    /**
     * The customer billing address.
     *
     * @var text
     * @ORM\Column(type="text",name="customer_address")
     */
    protected $customerAddress;

    /**
     * The customer billing address.
     *
     * @var text
     * @ORM\Column(type="text",name="customer_description",nullable=true)
     */
    protected $customerDescription;
    /**
     * The customer billing address.
     *
     * @var float
     * @ORM\Column(type="float",name="total_price")
     */
    protected $totalPrice;
    /**
     * The price of the product.
     *
     * @var float
     * @ORM\Column(type="float",name="ship_price")
     */
    protected $shipPrice;
    /**
     * The price of the product.
     *
     * @var float
     * @ORM\Column(type="float",name="total_all")
     */
    protected $totalAll;

    /**
     * The customer billing address.
     *
     * @var text
     * @ORM\Column(type="text",name="ship_info")
     */
    protected $shipInfo;

    /**
     * Items that have been purchased.
     *
     * @var PurchaseItem[]
     * @ORM\OneToMany(targetEntity="PurchaseItem", mappedBy="purchase", cascade={"remove"})
     */
    protected $purchasedItems;

    /**
     * Constructor of the Purchase class.
     * (Initialize some fields).
     */
    public function __construct()
    {
        $this->purchasedItems = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->deliveryDate = new \DateTime('+2 days');
        $this->deliveryHour = new \DateTime('14:00');
    }

    public function __toString()
    {
        return $this->purchaseNo;
    }

    /**
     * @param \DateTime $deliveryDate
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
    }

    /**
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * @param PurchaseItem[] $purchasedItems
     */
    public function setPurchasedItems($purchasedItems)
    {
        $this->purchasedItems = $purchasedItems;
    }

    /**
     * @return PurchaseItem[]
     */
    public function getPurchasedItems()
    {
        return $this->purchasedItems;
    }

    /**
     * @param \DateTime $deliveryHour
     */
    public function setDeliveryHour($deliveryHour)
    {
        $this->deliveryHour = $deliveryHour;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeliveryHour()
    {
        return $this->deliveryHour;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getTotal()
    {
        $total = 0.0;

        foreach ($this->getPurchasedItems() as $item) {
            $total += $item->getTotalPrice();
        }

        return $total;
    }

    /**
     * Add purchasedItem
     *
     * @param \AppBundle\Entity\PurchaseItem $purchasedItem
     *
     * @return Purchase
     */
    public function addPurchasedItem(\AppBundle\Entity\PurchaseItem $purchasedItem)
    {
        $this->purchasedItems[] = $purchasedItem;

        return $this;
    }

    /**
     * Remove purchasedItem
     *
     * @param \AppBundle\Entity\PurchaseItem $purchasedItem
     */
    public function removePurchasedItem(\AppBundle\Entity\PurchaseItem $purchasedItem)
    {
        $this->purchasedItems->removeElement($purchasedItem);
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Purchase
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set customerName
     *
     * @param string $customerName
     *
     * @return Purchase
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * Get customerName
     *
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set customerPhone
     *
     * @param string $customerPhone
     *
     * @return Purchase
     */
    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;

        return $this;
    }

    /**
     * Get customerPhone
     *
     * @return string
     */
    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    /**
     * Set customerEmail
     *
     * @param string $customerEmail
     *
     * @return Purchase
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * Get customerEmail
     *
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * Set customerAddress
     *
     * @param string $customerAddress
     *
     * @return Purchase
     */
    public function setCustomerAddress($customerAddress)
    {
        $this->customerAddress = $customerAddress;

        return $this;
    }

    /**
     * Get customerAddress
     *
     * @return string
     */
    public function getCustomerAddress()
    {
        return $this->customerAddress;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set purchaseNo
     *
     * @param string $purchaseNo
     *
     * @return Purchase
     */
    public function setPurchaseNo($purchaseNo)
    {
        $this->purchaseNo = $purchaseNo;

        return $this;
    }

    /**
     * Get purchaseNo
     *
     * @return string
     */
    public function getPurchaseNo()
    {
        return $this->purchaseNo;
    }

    /**
     * Set totalPrice
     *
     * @param string $totalPrice
     *
     * @return Purchase
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return string
     */
    public function getTotalPrice()
    {
        return $this->getTotal();
    }

    /**
     * Set shipPrice
     *
     * @param string $shipPrice
     *
     * @return Purchase
     */
    public function setShipPrice($shipPrice)
    {
        $this->shipPrice = $shipPrice;

        return $this;
    }

    /**
     * Get shipPrice
     *
     * @return string
     */
    public function getShipPrice()
    {
        return $this->shipPrice;
    }

    /**
     * Set shipInfo
     *
     * @param string $shipInfo
     *
     * @return Purchase
     */
    public function setShipInfo($shipInfo)
    {
        $this->shipInfo = $shipInfo;

        return $this;
    }

    /**
     * Get shipInfo
     *
     * @return string
     */
    public function getShipInfo()
    {
        return $this->shipInfo;
    }

    /**
     * Set customerDescription
     *
     * @param string $customerDescription
     *
     * @return Purchase
     */
    public function setCustomerDescription($customerDescription)
    {
        $this->customerDescription = $customerDescription;

        return $this;
    }

    /**
     * Get customerDescription
     *
     * @return string
     */
    public function getCustomerDescription()
    {
        return $this->customerDescription;
    }

    /**
     * Set totalAll
     *
     * @param float $totalAll
     *
     * @return Purchase
     */
    public function setTotalAll($totalAll)
    {
        $this->totalAll = $totalAll;

        return $this;
    }

    /**
     * Get totalAll
     *
     * @return float
     */
    public function getTotalAll()
    {
        return ($this->getTotal()+$this->getShipPrice());
    }
}
