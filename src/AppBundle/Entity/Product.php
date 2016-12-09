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
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class Product.
 *
 * @author MacFJA
 * @ORM\Table(name="product")
 * @ORM\Entity
 */
class Product
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
     * The creation date of the product.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * The creation date of the product.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime", name="updated_at")
     */
    private $updatedAt;
    /**
     * Indicate if the product is enabled (available in store).
     *
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $enabled = false;

    /**
     * It only stores the name of the image associated with the product.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $image;

    /**
     * @var \Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_feature", referencedColumnName="id", nullable=true, onDelete="Set null")
     * })
     */
    private $imageFeature;

    /**
     * The price of the product.
     *
     * @var float
     * @ORM\Column(type="float",name="price")
     */
    private $price = 0.0;
    /**
     * The price of the product.
     *
     * @var float
     * @ORM\Column(type="float",name="price_old")
     */
    private $priceOld = 0.0;

    /**
     * @ORM\Column(type="integer", name="product_type", nullable = true)
     */
    private $productType = 0;
    /**
     * The name of the product.
     *
     * @var string
     * @ORM\Column(type="string",name="name",length=255)
     */
    private $name;
    /**
     * The category alias.
     *
     * @var string
     * @ORM\Column(type="string")
     */
    protected $alias;

    /**
     * @var string
     * @ORM\Column(type="string", length=255,name="description")
     */
    private $description;

    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="type_name")
     */
    private $typeName;

    /**
     * @var text $body
     *
     * @ORM\Column(name="body", type="text", nullable=false)
     */
    protected $body;

    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="meta_description")
     */
    private $metaDescription;

    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="meta_keyword")
     */
    private $metaKeyword;

    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="product_code")
     */
    private $productCode;

    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="specification")
     */
    private $specification;
    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="weights")
     */
    private $weights;
    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="made_in")
     */
    private $madeIn;

    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="string", length=255,name="trademark")
     */
    private $trademark;

    /**
     * List of categories where the products is
     * (Owning side).
     *
     * @var Category[]
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="products")
     * @ORM\JoinTable(name="product_category")
     */
    private $categories;

    /**
     * @var PurchaseItem[]
     * @ORM\OneToMany(targetEntity="PurchaseItem", mappedBy="product", cascade={"remove"})
     */
    private $purchasedItems;
    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery")
     * @ORM\JoinColumn(name="gallery", referencedColumnName="id")
     */
    private $gallery;

    /**
     * Indicate if the product is enabled (available in store).
     *
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $old = false;

    /**
     * Indicate if the product is enabled (available in store).
     *
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $inSale = 0;

    /**
     * Indicate if the product is enabled (available in store).
     *
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $inHot = 0;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->updatedAt = new \DateTime('now');
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->purchasedItems = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function __toString()
    {
        return $this->name;
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Product
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
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
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
     * Set priceOld
     *
     * @param float $priceOld
     *
     * @return Product
     */
    public function setPriceOld($priceOld)
    {
        $this->priceOld = $priceOld;

        return $this;
    }

    /**
     * Get priceOld
     *
     * @return float
     */
    public function getPriceOld()
    {
        return $this->priceOld;
    }

    /**
     * Set productType
     *
     * @param integer $productType
     *
     * @return Product
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;

        return $this;
    }

    /**
     * Get productType
     *
     * @return integer
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set alias
     *
     * @param string $alias
     *
     * @return Product
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set typeName
     *
     * @param string $typeName
     *
     * @return Product
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;

        return $this;
    }

    /**
     * Get typeName
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Product
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return Product
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
     * @return Product
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
     * Set productCode
     *
     * @param string $productCode
     *
     * @return Product
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;

        return $this;
    }

    /**
     * Get productCode
     *
     * @return string
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * Set specification
     *
     * @param string $specification
     *
     * @return Product
     */
    public function setSpecification($specification)
    {
        $this->specification = $specification;

        return $this;
    }

    /**
     * Get specification
     *
     * @return string
     */
    public function getSpecification()
    {
        return $this->specification;
    }

    /**
     * Set weights
     *
     * @param string $weights
     *
     * @return Product
     */
    public function setWeights($weights)
    {
        $this->weights = $weights;

        return $this;
    }

    /**
     * Get weights
     *
     * @return string
     */
    public function getWeights()
    {
        return $this->weights;
    }

    /**
     * Set madeIn
     *
     * @param string $madeIn
     *
     * @return Product
     */
    public function setMadeIn($madeIn)
    {
        $this->madeIn = $madeIn;

        return $this;
    }

    /**
     * Get madeIn
     *
     * @return string
     */
    public function getMadeIn()
    {
        return $this->madeIn;
    }

    /**
     * Set imageFeature
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $imageFeature
     *
     * @return Product
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

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Product
     */
    public function addCategory(\AppBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Category $category
     */
    public function removeCategory(\AppBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add purchasedItem
     *
     * @param \AppBundle\Entity\PurchaseItem $purchasedItem
     *
     * @return Product
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
     * Get purchasedItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPurchasedItems()
    {
        return $this->purchasedItems;
    }

    /**
     * Set gallery
     *
     * @param \Application\Sonata\MediaBundle\Entity\Gallery $gallery
     *
     * @return Product
     */
    public function setGallery(\Application\Sonata\MediaBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Application\Sonata\MediaBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set trademark
     *
     * @param string $trademark
     *
     * @return Product
     */
    public function setTrademark($trademark)
    {
        $this->trademark = $trademark;

        return $this;
    }

    /**
     * Get trademark
     *
     * @return string
     */
    public function getTrademark()
    {
        return $this->trademark;
    }

    /**
     * Set old
     *
     * @param boolean $old
     *
     * @return Product
     */
    public function setOld($old)
    {
        $this->old = $old;

        return $this;
    }

    /**
     * Get old
     *
     * @return boolean
     */
    public function getOld()
    {
        return $this->old;
    }

    /**
     * Set inSale
     *
     * @param boolean $inSale
     *
     * @return Product
     */
    public function setInSale($inSale)
    {
        $this->inSale = $inSale;

        return $this;
    }

    /**
     * Get inSale
     *
     * @return boolean
     */
    public function getInSale()
    {
        return $this->inSale;
    }

    /**
     * Set inHot
     *
     * @param boolean $inHot
     *
     * @return Product
     */
    public function setInHot($inHot)
    {
        $this->inHot = $inHot;

        return $this;
    }

    /**
     * Get inHot
     *
     * @return boolean
     */
    public function getInHot()
    {
        return $this->inHot;
    }
}
