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
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Article.
 *
 * @author Anh Nguyen
 *
 * /**
 * @ORM\Entity
 * @ORM\Table(name="article")
 * @Vich\Uploadable
 */
class Article
{
    /**
     * The identifier of the product.
     *
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id = null;

    /**
     * The creation date of the product.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * The creation date of the product.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;

    /**
     * The category alias.
     *
     * @var string
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    protected $alias;


    /**
     * List of tags associated to the product.
     *
     * @var string[]
     * @ORM\Column(type="simple_array")
     */
    protected $tags = array();
    /**
     * Indicate if the product is enabled (available in store).
     *
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $enabled = false;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keyword", type="string", length=255,nullable=true)
     */
    protected $metaKeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255,nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=255,nullable=true)
     */
    protected $metaDescription;


    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    protected $content;


    /**
     * It only stores the name of the image associated with the product.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $image;

    /**
     * This unmapped property stores the binary contents of the image file
     * associated with the product.
     *
     * @Vich\UploadableField(mapping="article_images", fileNameProperty="image")
     *
     * @var File
     */
    protected $imageFile;
    /**
     * The name of the product.
     *
     * @var string
     * @ORM\Column(name="title", type="string", nullable=true)
     */
    protected $title;

    /**
     * List of categories where the products is
     * (Owning side).
     *
     * @var Catelogy[]
     * @ORM\ManyToMany(targetEntity="Catelogy", inversedBy="article")
     * @ORM\JoinTable(name="article_catelogy")
     */
    protected $categories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Article
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
     * @return Article
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
     * Set alias
     *
     * @param string $alias
     *
     * @return Article
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
     * Set tags
     *
     * @param array $tags
     *
     * @return Article
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Article
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
     * Set metaKeyword
     *
     * @param string $metaKeyword
     *
     * @return Article
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
     * Set description
     *
     * @param string $description
     *
     * @return Article
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
     * @param File $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return Article
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
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Article
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
     * Add category
     *
     * @param \AppBundle\Entity\Catelogy $category
     *
     * @return Article
     */
    public function addCategory(\AppBundle\Entity\Catelogy $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Catelogy $category
     */
    public function removeCategory(\AppBundle\Entity\Catelogy $category)
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
     * Set title
     *
     * @param string $title
     *
     * @return Article
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
    public function __toString() {
        return $this->title;
    }
}
