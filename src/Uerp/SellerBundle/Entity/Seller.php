<?php
/**
 * Created by PhpStorm.
 * User: uelei
 * Date: 21/01/15
 * Time: 1:08 PM
 */

namespace Uerp\SellerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Seller
 * @package Uerp\SellerBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="seller")
 */

class Seller {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string",length=30)
     *
     */
    protected $name;

    /**
     * @ORM\Column(type="string",length=10)
     */
    protected $letter;



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
     * Set name
     *
     * @param string $name
     * @return Seller
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
     * Set letter
     *
     * @param string $letter
     * @return Seller
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;

        return $this;
    }

    /**
     * Get letter
     *
     * @return string 
     */
    public function getLetter()
    {
        return $this->letter;
    }
}
