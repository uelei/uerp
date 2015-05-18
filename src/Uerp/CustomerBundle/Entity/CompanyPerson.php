<?php

namespace Uerp\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyPerson
 * 
 * @ORM\Table(name="company_person" )
 * @ORM\Entity
 */
 
class CompanyPerson
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
     * @ORM\Column(name="fancy_name", type="string", length=50, nullable=true)
     */
    private $fancyName;

    /**
     * @var string
     * 
     * @ORM\Column(name="cnpj", type="string", length=18)
     */
    private $cnpj;

    /**
     * @var string
     * 
     * @ORM\Column(name="state_registry", type="string", length=20 )
     */
    private $stateRegistry;

    /**
     * @var string
     * 
     * @ORM\Column(name="city_registry", type="string", length=20, nullable=true)
     */
    private $cityRegistry;

    /**
     * @var string
     * 
     * @ORM\Column(name="contact", type="string", length=50, nullable=true)
     */
    private $contact;

    /**
     * @var string
     * 
     * @ORM\Column(name="contact_phone", type="string", length=30, nullable=true)
     */
    private $contactPhone;

    /**
     * @var string
     * 
     * @ORM\Column(name="contact_email", type="string", length=50, nullable=true)
     */
    private $contactEmail;


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
     * Set fancyName
     *
     * @param string $fancyName
     *
     * @return CompanyPerson
     */
    public function setFancyName($fancyName)
    {
        $this->fancyName = $fancyName;

        return $this;
    }

    /**
     * Get fancyName
     *
     * @return string
     */
    public function getFancyName()
    {
        return $this->fancyName;
    }

    /**
     * Set cnpj
     *
     * @param string $cnpj
     *
     * @return CompanyPerson
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get cnpj
     *
     * @return string
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set stateRegistry
     *
     * @param string $stateRegistry
     *
     * @return CompanyPerson
     */
    public function setStateRegistry($stateRegistry)
    {
        $this->stateRegistry = $stateRegistry;

        return $this;
    }

    /**
     * Get stateRegistry
     *
     * @return string
     */
    public function getStateRegistry()
    {
        return $this->stateRegistry;
    }

    /**
     * Set cityRegistry
     *
     * @param string $cityRegistry
     *
     * @return CompanyPerson
     */
    public function setCityRegistry($cityRegistry)
    {
        $this->cityRegistry = $cityRegistry;

        return $this;
    }

    /**
     * Get cityRegistry
     *
     * @return string
     */
    public function getCityRegistry()
    {
        return $this->cityRegistry;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return CompanyPerson
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     *
     * @return CompanyPerson
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return CompanyPerson
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }
}

