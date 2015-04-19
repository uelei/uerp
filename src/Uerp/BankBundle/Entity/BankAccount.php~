<?php
// src/BankBundle/Entity/BankAccount.php

namespace Uerp\BankBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="accounts")
 */
class BankAccount {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
protected $id;

    /**
     * @ORM\Column(type="string",length=50)
     */
protected $accountname;

    /**
     * @ORM\Column(type="decimal",scale=2)
     */
protected $balance;


    
    public function __toString()
    {
        return $this->accountname;
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
     * Set accountname
     *
     * @param string $accountname
     * @return BankAccount
     */
    public function setAccountname($accountname)
    {
        $this->accountname = $accountname;

        return $this;
    }

    /**
     * Get accountname
     *
     * @return string 
     */
    public function getAccountname()
    {
        return $this->accountname;
    }

    /**
     * Set balance
     *
     * @param string $balance
     * @return BankAccount
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string 
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Add bills
     *
     * @param \Uerp\BillsBundle\Entity\Bills $bills
     * @return BankAccount
     */
    public function addBill(\Uerp\BillsBundle\Entity\Bills $bills)
    {
        $this->bills[] = $bills;

        return $this;
    }

    /**
     * Remove bills
     *
     * @param \Uerp\BillsBundle\Entity\Bills $bills
     */
    public function removeBill(\Uerp\BillsBundle\Entity\Bills $bills)
    {
        $this->bills->removeElement($bills);
    }

    /**
     * Get bills
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBills()
    {
        return $this->bills;
    }
}
