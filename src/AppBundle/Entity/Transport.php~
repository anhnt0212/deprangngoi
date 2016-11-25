<?php

/*
 * This file is part of the Doctrine-TestSet project created by
 * https://github.com/Anh Nguyen
 *
 * For the full copyright and license information, please view the LICENSE
 * at https://github.com/Anh Nguyen/Doctrine-TestSet
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class Transport.
 *
 * @author Anh Nguyen
 *
 * @ORM\Table(name="transport_fees")
 * @ORM\Entity
 */
class Transport
{
    /**
     * The identifier of the transport_fees.
     *
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id = null;

    /**
     * The category name.
     *
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * The category alias.
     *
     * @var string
     * @ORM\Column(type="string")
     */
    protected $destination;
    /*
     *
     * @var integer
     * @ORM\Column(name="city_code", type="integer", length=11,nullable=true)
     */
    protected $cityCode = 1;
    /*
     *
     * @var string
     * @ORM\Column("name="city_name", type="string", length=255,nullable=true)
     */
    protected $cityName = "HCM";

    /**
     * The price of the product.
     *
     * @var float
     * @ORM\Column(type="float",name="price")
     */
    protected $price = 0.0;
    /**
     * Indicate if the product is enabled (available in store).
     *
     * @var bool
     * @ORM\Column(type="boolean",name="enabled")
     */
    protected $enabled = false;

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
     * Set name
     *
     * @param string $name
     *
     * @return Transport
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set destination
     *
     * @param string $destination
     *
     * @return Transport
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Transport
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Transport
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
