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
 * Class Catelogy.
 *
 * @author Anh Nguyen
 *
 * @ORM\Table(name="catelogy")
 * @ORM\Entity
 */
class Catelogy
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
     * Indicate if the product is enabled (available in store).
     *
     * @var bool
     * @ORM\Column(type="boolean",name="enabled")
     */
    protected $enabled = false;


    /**
     * Article in the catelogy.
     *
     * @var Article[]
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="categories")
     **/
    protected $article;

    /**
     * The category parent.
     *
     * @var Catelogy
     * @ORM\ManyToOne(targetEntity="Catelogy")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     **/
    protected $parent;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->article = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Catelogy
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
     * @return Catelogy
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Catelogy
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
     * Add article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Catelogy
     */
    public function addArticle(\AppBundle\Entity\Article $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Article $article
     */
    public function removeArticle(\AppBundle\Entity\Article $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\Catelogy $parent
     *
     * @return Catelogy
     */
    public function setParent(\AppBundle\Entity\Catelogy $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Catelogy
     */
    public function getParent()
    {
        return $this->parent;
    }
}
