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
     * @ORM\Column(name="cost", type="decimal", precision=8, scale=2)
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=8, scale=2)
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
     * @ORM\Column(name="ncm", type="string", length=8)
     */
    private $ncm;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=255)
     */
    private $notes;


    /**
     * @ORM\ManyToOne(targetEntity="Uerp\SupplierBundle\Entity\Supplier")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id")
     */
    protected $supplier;


    /**
     * @ORM\ManyToOne(targetEntity="Uerp\ProductBundle\Entity\ProductUnit")
     * @ORM\JoinColumn(name="productunit_id", referencedColumnName="id")
     */
    protected $unit;
<<<<<<< HEAD
=======
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Uerp\ProductBundle\Entity\ProductIcms")
     * @ORM\JoinColumn(name="producticms_id", referencedColumnName="id")
     */
    protected $icms;
>>>>>>> 4a607ab47e3436de09d00ce9ac1b88dfbd6f2c07


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
     * Set ncm
     *
     * @param string $ncm
     *
     * @return Product
     */
    public function setNcm($ncm)
    {
        $this->ncm = $ncm;

        return $this;
    }

    /**
     * Get ncm
     *
     * @return string
     */
    public function getNcm()
    {
        return $this->ncm;
    }

    /**
     * Set supplier
     *
     * @param \Uerp\SupplierBundle\Entity\Supplier $supplier
     *
     * @return Product
     */
    public function setSupplier(\Uerp\SupplierBundle\Entity\Supplier $supplier = null)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return \Uerp\SupplierBundle\Entity\Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Product
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set unit
     *
     * @param \Uerp\ProductBundle\Entity\ProductUnit $unit
     *
     * @return Product
     */
    public function setUnit(\Uerp\ProductBundle\Entity\ProductUnit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \Uerp\ProductBundle\Entity\ProductUnit
     */
    public function getUnit()
    {
        return $this->unit;
    }
<<<<<<< HEAD
=======



	/**
 	* Set icms
 	*
 	* @param \Uerp\ProductBundle\Entity\ProductIcms $icms
 	*
 	* @return Product
 	*/
	public function setIcms(\Uerp\ProductBundle\Entity\ProductIcms $icms = null)
	{
		$this->icms = $icms;

		return $this;
	}

	/**
	 * Get icms
 	*
	* @return \Uerp\ProductBundle\Entity\ProductIcms
 	*/
	public function getIcms()
	{
		return $this->icms;
	}
>>>>>>> 4a607ab47e3436de09d00ce9ac1b88dfbd6f2c07
}

