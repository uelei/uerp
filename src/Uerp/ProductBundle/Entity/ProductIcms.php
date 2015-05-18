<?php

namespace Uerp\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductIcms
 * @ORM\Table(name="product_icms" )
 * @ORM\Entity
 */
class ProductIcms
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
     * @var integer
     *
     * @ORM\Column(name="cson", type="integer")
     * @Assert\NotBlank
     */
    private $cson;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=45)
     * @Assert\NotBlank
     */
    private $description;


    public function __toString()
    {
        return $this->cson;
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
     * Set cson
     *
     * @param integer $cson
     *
     * @return ProductIcms
     */
    public function setCson($cson)
    {
        $this->cson = $cson;

        return $this;
    }

    /**
     * Get cson
     *
     * @return integer
     */
    public function getCson()
    {
        return $this->cson;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ProductIcms
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
}
