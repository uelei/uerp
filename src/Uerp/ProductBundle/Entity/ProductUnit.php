<?php

namespace Uerp\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductUnit
 * @ORM\Table(name="product_unit" )
 * @ORM\Entity
 */
class ProductUnit
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=3)
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @var boolean
     * @ORM\Column(name="allow_fraction", type="boolean",nullable=true )
     *
     */
    private $allowFraction;


    public function __toString()
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
     * Set description
     *
     * @param string $description
     *
     * @return ProductUnit
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
     * Set allowFraction
     *
     * @param boolean $allowFraction
     *
     * @return ProductUnit
     */
    public function setAllowFraction($allowFraction)
    {
        $this->allowFraction = $allowFraction;

        return $this;
    }

    /**
     * Get allowFraction
     *
     * @return boolean
     */
    public function getAllowFraction()
    {
        return $this->allowFraction;
    }
}
