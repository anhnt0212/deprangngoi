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
 * Class Adv.
 *
 * @author Anh Nguyen
 *
 * @ORM\Table(name="adv")
 * @ORM\Entity
 */
class Adv
{
    /**
     * The identifier of the catelogy.
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
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * The category alias.
     *
     * @var string
     * @ORM\Column(type="string",name="image")
     */
    protected $imageOld;
    /**
     * Indicate if the product is enabled (available in store).
     *
     * @var bool
     * @ORM\Column(type="boolean",name="enabled")
     */
    protected $enabled = false;
    /*
     *
     * @var integer
     * @ORM\Column(name="position", type="integer", length=11,nullable=true)
     */
    protected $position = 1;

    /**
     * Anh Nguyen
     *
     * @var string
     * @ORM\Column(type="string",name="link")
     */
    protected $link;
    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="meta_description")
     */
    protected $metaDescription;

    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="meta_keyword")
     */
    protected $metaKeyword;


    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="meta_title")
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
     * @return Adv
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
     * Set imageOld
     *
     * @param string $imageOld
     *
     * @return Adv
     */
    public function setImageOld($imageOld)
    {
        $this->imageOld = $imageOld;

        return $this;
    }

    /**
     * Get imageOld
     *
     * @return string
     */
    public function getImageOld()
    {
        return $this->imageOld;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Adv
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
     * @return Adv
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
     * @return Adv
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
     * @return Adv
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
     * @return Adv
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
     * Set imageFeature
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $imageFeature
     *
     * @return Adv
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