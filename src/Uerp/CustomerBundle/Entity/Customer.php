<?php
/**
 * Created by PhpStorm.
 * User: uelei
 * Date: 21/01/15
 * Time: 1:20 PM
 */

namespace Uerp\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Customer
 * @package Uerp\CustomerBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="customer")
 */
class Customer {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=200)
     */
    protected $name;

    /**
     * @ORM\Column(type="string",length=11, nullable=true)
     */
    protected $phone_number;
    
    /**
     * @ORM\Column(type="string",length=11)
     */
    protected $mobile_number;
    
    /**
     * @ORM\Column(type="string",length=50)
     */
    protected $email;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birth_date;
    

    /**
     * @ORM\Column(type="string",length=200)
     */
    protected $street;


    /**
     * @ORM\Column(type="string",length=10)
     */
    protected $street_number;
    
    /**
     * @ORM\Column(type="string",length=40, nullable=true)
     */
    protected $complement;
    
    /**
     * @ORM\Column(type="string",length=10)
     */
    protected $district;
    
    /**
     * @ORM\Column(type="string",length=10)
     */
    protected $postal_code;


    /**
     * @ORM\Column(type="string",length=200)
     */
    protected $city;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $notes;




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
     * @return Customer
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
     * Set street
     *
     * @param string $street
     * @return Customer
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }



    /**
     * Set city
     *
     * @param string $city
     * @return Customer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }



    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Customer
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phone_number = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Set mobileNumber
     *
     * @param string $mobileNumber
     *
     * @return Customer
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobile_number = $mobileNumber;

        return $this;
    }

    /**
     * Get mobileNumber
     *
     * @return string
     */
    public function getMobileNumber()
    {
        return $this->mobile_number;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return Customer
     */
    public function setBirthDate($birthDate)
    {
        $this->birth_date = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * Set streetNumber
     *
     * @param string $streetNumber
     *
     * @return Customer
     */
    public function setStreetNumber($streetNumber)
    {
        $this->street_number = $streetNumber;

        return $this;
    }

    /**
     * Get streetNumber
     *
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->street_number;
    }

    /**
     * Set complement
     *
     * @param string $complement
     *
     * @return Customer
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return Customer
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return Customer
     */
    public function setPostalCode($postalCode)
    {
        $this->postal_code = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Customer
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
}
