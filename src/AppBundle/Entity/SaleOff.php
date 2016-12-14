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

/**
 * Class SaleOff.
 *
 * @author Anh Nguyen
 *
 * @ORM\Table(name="sale_off")
 * @ORM\Entity
 */
class SaleOff
{
    /**
     *
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id = null;

    /**
     * Anh Nguyen
     *
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    protected $title;
    /**
     * Indicate if the product is enabled (available in store).
     *
     * @var bool
     * @ORM\Column(type="boolean",name="enabled")
     */
    protected $enabled = false;
    /**
     * Anh Nguyen
     *
     * @var string
     * @ORM\Column(type="string",name="link",nullable=true)
     */
    protected $link;
    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="meta_description",nullable=true)
     */
    protected $metaDescription;

    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="meta_keyword",nullable=true)
     */
    protected $metaKeyword;


    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="meta_title",nullable=true)
     */
    protected $metaTitle;
    /**
     * @var \Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_feature", referencedColumnName="id", nullable=true, onDelete="Set null")
     * })
     */
    protected $imageFeature;
    /**
     * Indicate if the product is enabled (available in store).
     *
     * @var integer
     * @ORM\Column(type="integer",name="position")
     */
    protected $position = 1;
    public function __toString()
    {
        return $this->title;
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
     * Set title
     *
     * @param string $title
     *
     * @return SaleOff
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return SaleOff
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

    /**
     * Set link
     *
     * @param string $link
     *
     * @return SaleOff
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return SaleOff
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set metaKeyword
     *
     * @param string $metaKeyword
     *
     * @return SaleOff
     */
    public function setMetaKeyword($metaKeyword)
    {
        $this->metaKeyword = $metaKeyword;

        return $this;
    }

    /**
     * Get metaKeyword
     *
     * @return string
     */
    public function getMetaKeyword()
    {
        return $this->metaKeyword;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return SaleOff
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return SaleOff
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set imageFeature
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $imageFeature
     *
     * @return SaleOff
     */
    public function setImageFeature(\Application\Sonata\MediaBundle\Entity\Media $imageFeature = null)
    {
        $this->imageFeature = $imageFeature;

        return $this;
    }

    /**
     * Get imageFeature
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getImageFeature()
    {
        return $this->imageFeature;
    }
}
