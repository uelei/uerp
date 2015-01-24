<?php
/**
 * Created by PhpStorm.
 * User: uelei
 * Date: 21/01/15
 * Time: 12:44 PM
 */

namespace Uerp\TransactiontypeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="transactiontype")
 */
class Transactiontype {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=30)
     */
    protected $transactiondesc;


    public function __toString()
    {
        return $this->transactiondesc;
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
     * Set transactiondesc
     *
     * @param string $transactiondesc
     * @return Transactiontype
     */
    public function setTransactiondesc($transactiondesc)
    {
        $this->transactiondesc = $transactiondesc;

        return $this;
    }

    /**
     * Get transactiondesc
     *
     * @return string 
     */
    public function getTransactiondesc()
    {
        return $this->transactiondesc;
    }
}
