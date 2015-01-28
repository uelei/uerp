<?php

namespace Uerp\SupplierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Supplier
 *
 * @ORM\Table(name="supplier")
 * @ORM\Entity(repositoryClass="Uerp\SupplierBundle\Entity\SupplierRepository")
 */
class Supplier
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
     *
     * @ORM\Column(type="string",length=150)
     *
     */
    private $suppliername;


    /**
     * @ORM\Column(type="string",length=10)
     *
     */
    private $aux;




    public function __toString()
    {
        return $this->suppliername;
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
     * Set suppliername
     *
     * @param string $suppliername
     * @return Supplier
     */
    public function setSuppliername($suppliername)
    {
        $this->suppliername = $suppliername;

        return $this;
    }

    /**
     * Get suppliername
     *
     * @return string 
     */
    public function getSuppliername()
    {
        return $this->suppliername;
    }

    /**
     * Set aux
     *
     * @param string $aux
     * @return Supplier
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
