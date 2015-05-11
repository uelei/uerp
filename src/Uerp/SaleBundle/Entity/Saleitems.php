<?php

namespace Uerp\SaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Saleitems
 *
 * @ORM\Table(name="saleitems")
 * @ORM\Entity
 */
class Saleitems
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
     * @ORM\Column(type="integer")
     */
    protected $saleid;


    /**
     * @ORM\ManyToOne(targetEntity="Uerp\ProductBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;


    /**
     * @ORM\Column(type="integer")
     */
    protected $qtd;



    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $prodcost;



    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $prodprice;



    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $subtotalcost;


    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $subtotalsale;


    /**
     * @ORM\Column(type="string",length=250)
     */
    protected $itenaux;



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
     * Set prod_id
     *
     * @param integer $prodId
     * @return Saleitems
     */
    public function setProdId($prodId)
    {
        $this->prod_id = $prodId;

        return $this;
    }

    /**
     * Get prod_id
     *
     * @return integer
     */
    public function getProdId()
    {
        return $this->prod_id;
    }

    /**
     * Set qtd
     *
     * @param integer $qtd
     * @return Saleitems
     */
    public function setQtd($qtd)
    {
        $this->qtd = $qtd;

        return $this;
    }

    /**
     * Get qtd
     *
     * @return integer
     */
    public function getQtd()
    {
        return $this->qtd;
    }

    /**
     * Set prodcost
     *
     * @param string $prodcost
     * @return Saleitems
     */
    public function setProdcost($prodcost)
    {
        $this->prodcost = $prodcost;

        return $this;
    }

    /**
     * Get prodcost
     *
     * @return string
     */
    public function getProdcost()
    {
        return $this->prodcost;
    }

    /**
     * Set prodprice
     *
     * @param string $prodprice
     * @return Saleitems
     */
    public function setProdprice($prodprice)
    {
        $this->prodprice = $prodprice;

        return $this;
    }

    /**
     * Get prodprice
     *
     * @return string
     */
    public function getProdprice()
    {
        return $this->prodprice;
    }

    /**
     * Set subtotalcost
     *
     * @param string $subtotalcost
     * @return Saleitems
     */
    public function setSubtotalcost($subtotalcost)
    {
        $this->subtotalcost = $subtotalcost;

        return $this;
    }

    /**
     * Get subtotalcost
     *
     * @return string
     */
    public function getSubtotalcost()
    {
        return $this->subtotalcost;
    }

    /**
     * Set subtotalsale
     *
     * @param string $subtotalsale
     * @return Saleitems
     */
    public function setSubtotalsale($subtotalsale)
    {
        $this->subtotalsale = $subtotalsale;

        return $this;
    }

    /**
     * Get subtotalsale
     *
     * @return string
     */
    public function getSubtotalsale()
    {
        return $this->subtotalsale;
    }

    /**
     * Set itenaux
     *
     * @param string $itenaux
     * @return Saleitems
     */
    public function setItenaux($itenaux)
    {
        $this->itenaux = $itenaux;

        return $this;
    }

    /**
     * Get itenaux
     *
     * @return string
     */
    public function getItenaux()
    {
        return $this->itenaux;
    }

    /**
     * Set saleid
     *
     * @param integer $saleid
     * @return Saleitems
     */
    public function setSaleid($saleid)
    {
        $this->saleid = $saleid;

        return $this;
    }

    /**
     * Get saleid
     *
     * @return integer
     */
    public function getSaleid()
    {
        return $this->saleid;
    }

    /**
     * Set productid
     *
     * @param integer $productid
     * @return Saleitems
     */
    public function setProductid($productid)
    {
        $this->productid = $productid;

        return $this;
    }

    /**
     * Get productid
     *
     * @return integer
     */
    public function getProductid()
    {
        return $this->product->getId();
    }

    /**
     * Set product
     *
     * @param \Uerp\ProductBundle\Entity\Product $product
     * @return Saleitems
     */
    public function setProduct(\Uerp\ProductBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Uerp\ProductBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
