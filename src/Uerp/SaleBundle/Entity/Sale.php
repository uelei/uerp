<?php

namespace Uerp\SaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sale
 *
 * @ORM\Table(name="sale")
 * @ORM\Entity
 */
class Sale
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
     * @ORM\Column(type="date")
     */
    protected $date;



    /**
     * @ORM\ManyToOne(targetEntity="Uerp\SellerBundle\Entity\Seller")
     * @ORM\JoinColumn(name="seller_id", referencedColumnName="id")
     */
    protected $seller;



    /**
     * @ORM\ManyToOne(targetEntity="Uerp\StatusBundle\Entity\Status")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;


    /**
     * @ORM\ManyToOne(targetEntity="Uerp\CustomerBundle\Entity\Customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    protected $customer;


    /**
     * @ORM\Column(type="decimal", scale=2, options={"default":0})
     */
    protected $totalcost;


    /**
     * @ORM\Column(type="decimal", scale=2, options={"default":0})
     */
    protected $totalsale;


    /**
     * @ORM\Column(type="decimal", scale=2, options={"default":0})
     */
    protected $discount;

     /**
     * @ORM\Column(type="decimal", scale=2, options={"default":0})
     */
    protected $tax;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $saleobs;

    /**
     *@ORM\Column(type="decimal", scale=2, options={"default":0}) 
     * 
     */
     protected $nitems;



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
     * Set date
     *
     * @param \DateTime $date
     * @return Sale
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set totalcost
     *
     * @param string $totalcost
     * @return Sale
     */
    public function setTotalcost($totalcost)
    {
        $this->totalcost = $totalcost;

        return $this;
    }

    /**
     * Get totalcost
     *
     * @return string 
     */
    public function getTotalcost()
    {
        return $this->totalcost;
    }

    /**
     * Set totalsale
     *
     * @param string $totalsale
     * @return Sale
     */
    public function setTotalsale($totalsale)
    {
        $this->totalsale = $totalsale;

        return $this;
    }

    /**
     * Get totalsale
     *
     * @return string 
     */
    public function getTotalsale()
    {
        return $this->totalsale;
    }

    /**
     * Set discount
     *
     * @param string $discount
     * @return Sale
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return string 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set saleobs
     *
     * @param string $saleobs
     * @return Sale
     */
    public function setSaleobs($saleobs)
    {
        $this->saleobs = $saleobs;

        return $this;
    }

    /**
     * Get saleobs
     *
     * @return string 
     */
    public function getSaleobs()
    {
        return $this->saleobs;
    }

    /**
     * Set seller
     *
     * @param \Uerp\SellerBundle\Entity\Seller $seller
     * @return Sale
     */
    public function setSeller(\Uerp\SellerBundle\Entity\Seller $seller = null)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get seller
     *
     * @return \Uerp\SellerBundle\Entity\Seller 
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * Set status
     *
     * @param \Uerp\StatusBundle\Entity\Status $status
     * @return Sale
     */
    public function setStatus(\Uerp\StatusBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Uerp\StatusBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set customer
     *
     * @param \Uerp\CustomerBundle\Entity\Customer $customer
     * @return Sale
     */
    public function setCustomer(\Uerp\CustomerBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Uerp\CustomerBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set nitems
     *
     * @param integer $nitems
     * @return Sale
     */
    public function setNitems($nitems)
    {
        $this->nitems = $nitems;

        return $this;
    }

    /**
     * Get nitems
     *
     * @return integer 
     */
    public function getNitems()
    {
        return $this->nitems;
    }

    /**
     * Set tax
     *
     * @param string $tax
     * @return Sale
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax
     *
     * @return string 
     */
    public function getTax()
    {
        return $this->tax;
    }
}
