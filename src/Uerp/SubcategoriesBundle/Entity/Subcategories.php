<?php

namespace Uerp\SubcategoriesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subcategories
 *
 * @ORM\Table(name="subcategories")
 * @ORM\Entity
 */
class Subcategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * owning Side
     * @ORM\ManyToOne(targetEntity="Uerp\CategoriesBundle\Entity\Categories",inversedBy="subcategories")
     * 
     * @ORM\JoinColumn(name="CategoriesId", referencedColumnName="id")
     */
    private $categories;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50)
     */
    private $description;


   public function __toString()
    {
        return $this->description;
    }

public function getName()
    {
        return $this->description;
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
     * Set categoriesId
     *
     * @param integer $categoriesId
     * @return Subcategories
     */
    public function setCategoriesId($categoriesId)
    {
        $this->categoriesId = $categoriesId;

        return $this;
    }

    /**
     * Get categoriesId
     *
     * @return integer 
     */
    public function getCategoriesId()
    {
        return $this->categoriesId;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Subcategories
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
     * Set categories
     *
     * @param \Uerp\CategoriesBundle\Entity\Categories $categories
     * @return Subcategories
     */
    public function setCategories(\Uerp\CategoriesBundle\Entity\Categories $categories = null)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return \Uerp\CategoriesBundle\Entity\Categories 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
