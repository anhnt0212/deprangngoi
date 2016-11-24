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
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Category.
 *
 * @author MacFJA
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Category
{
    /**
     * The identifier of the category.
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
    protected $alias;

    /**
     * It only stores the name of the image associated with the product.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $image_url;

    /**
     * This unmapped property stores the binary contents of the image file
     * associated with the category.
     *
     * @Vich\UploadableField(mapping="category_images", fileNameProperty="image_url")
     *
     * @var File
     */
    protected $imageFile;


    /**
     * @var text $body
     *
     * @ORM\Column(name="body", type="text", nullable=false)
     */
    protected $body;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keyword", type="string", length=255,nullable=true)
     */
    protected $metaKeyword;
    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=255,nullable=true)
     */
    protected $metaDescription;
    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", length=11,nullable=true)
     */
    protected $position;

    /**
     * Indicate if the product is enabled (available in store).
     *
     * @var bool
     * @ORM\Column(type="boolean",name="enabled")
     */
    protected $enabled = false;


    /**
     * Product in the category.
     *
     * @var Product[]
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="categories")
     **/
    protected $products;

    /**
     * The category parent.
     *
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     **/
    protected $parent;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the id of the category.
     * Return null if the category is new and not saved.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the name of the category.
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the name of the category.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the parent category.
     *
     * @param Category $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get the parent category.
     *
     * @return Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Return all product associated to the category.
     *
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set all products in the category.
     *
     * @param Product[] $products
     */
    public function setProducts($products)
    {
        $this->products->clear();
        $this->products = new ArrayCollection($products);
    }

    /**
     * Add a product in the category.
     *
     * @param $product Product The product to associate
     */
    public function addProduct($product)
    {
        if ($this->products->contains($product)) {
            return;
        }

        $this->products->add($product);
        $product->addCategory($this);
    }

    /**
     * @param Product $product
     */
    public function removeProduct($product)
    {
        if (!$this->products->contains($product)) {
            return;
        }

        $this->products->removeElement($product);
        $product->removeCategory($this);
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Category
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
     * Set imageUrl
     *
     * @param string $imageUrl
     *
     * @return Category
     */
    public function setImageUrl($imageUrl)
    {
        $this->image_url = $imageUrl;

        return $this;
    }

    /**
     * @param File $image_url
     */
    public function setImageFile(File $image_url = null)
    {
        $this->imageFile = $image_url;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
    /**
     * Get imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->image_url;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Category
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
     * Set keyword
     *
     * @param string $keyword
     *
     * @return Category
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set metaDesciption
     *
     * @param string $metaDesciption
     *
     * @return Category
     */
    public function setMetaDesciption($metaDesciption)
    {
        $this->meta_desciption = $metaDesciption;

        return $this;
    }

    /**
     * Get metaDesciption
     *
     * @return string
     */
    public function getMetaDesciption()
    {
        return $this->meta_desciption;
    }

    /**
     * Set orderBy
     *
     * @param string $orderBy
     *
     * @return Category
     */
    public function setOrderBy($orderBy)
    {
        $this->order_by = $orderBy;

        return $this;
    }

    /**
     * Get orderBy
     *
     * @return string
     */
    public function getOrderBy()
    {
        return $this->order_by;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Category
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
     * Set position
     *
     * @param integer $position
     *
     * @return Category
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
     * Set metaKeyword
     *
     * @param string $metaKeyword
     *
     * @return Category
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
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return Category
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
}
