<?php
/**
 * Created by PhpStorm.
 * User: uelei
 * Date: 21/01/15
 * Time: 12:26 PM
 */

namespace Uerp\CategoriesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */

class Categories {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    protected $descriptioncategories;


    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $varcategories;

    /**
     * Inverse Side
     * @ORM\OneToMany(targetEntity="Uerp\SubcategoriesBundle\Entity\Subcategories",mappedBy="categories")
     */
    protected $subcategories;

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
     * Set descriptioncategories
     *
     * @param string $descriptioncategories
     * @return Categories
     */
    public function setDescriptioncategories($descriptioncategories)
    {
        $this->descriptioncategories = $descriptioncategories;

        return $this;
    }

   /**
     * Get descriptioncategories
     *
     * @return string 
     */
    public function getName()
    {
        return $this->descriptioncategories;
    }


    /**
     * Get descriptioncategories
     *
     * @return string 
     */
    public function getDescriptioncategories()
    {
        return $this->descriptioncategories;
    }

    /**
     * Set varcategories
     *
     * @param string $varcategories
     * @return Categories
     */
    public function setVarcategories($varcategories)
    {
        $this->varcategories = $varcategories;

        return $this;
    }

    /**
     * Get varcategories
     *
     * @return string 
     */
    public function getVarcategories()
    {
        return $this->varcategories;
    }



    public function __toString()
    {
        return $this->descriptioncategories;
    }




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subcategories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subcategories
     *
     * @param \Uerp\SubcategoriesBundle\Entity\Subcategories $subcategories
     * @return Categories
     */
    public function addSubcategory(\Uerp\SubcategoriesBundle\Entity\Subcategories $subcategories)
    {
        $this->subcategories[] = $subcategories;

        return $this;
    }

    /**
     * Remove subcategories
     *
     * @param \Uerp\SubcategoriesBundle\Entity\Subcategories $subcategories
     */
    public function removeSubcategory(\Uerp\SubcategoriesBundle\Entity\Subcategories $subcategories)
    {
        $this->subcategories->removeElement($subcategories);
    }

    /**
     * Get subcategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }
}
