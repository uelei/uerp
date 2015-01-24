<?php

namespace Uerp\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product" )
 * @ORM\Entity
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="barcode", type="string", length=30)
     */
    private $barcode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="decimal")
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=100)
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="aux", type="string", length=200)
     */
    private $aux;




    /**
     * @ORM\ManyToOne(targetEntity="Uerp\SupplierBundle\Entity\Supplier")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id")
     */
    protected $supplier;






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
     * Set barcode
     *
     * @param string $barcode
     * @return Product
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;

        return $this;
    }

    /**
     * Get barcode
     *
     * @return string 
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * Set name
     *
     * @param string $name
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
     * Set cost
     *
     * @param string $cost
     * @return Product
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string 
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set price
     *
     * @param string $price
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
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set sku
     *
     * @param string $sku
     * @return Product
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string 
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set aux
     *
     * @param string $aux
     * @return Product
     */
    public function setAux($aux)
    {
        $this->aux = $aux;

        return $this;
    }

    /**
     * Get aux
     *
     * @return string 
     */
    public function getAux()
    {
        return $this->aux;
    }
}
