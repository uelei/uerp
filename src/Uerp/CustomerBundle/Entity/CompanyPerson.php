<?php

namespace Uerp\CustomerBundle\Entity;

/**
 * CompanyPerson
 */
class CompanyPerson
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $fancyName;

    /**
     * @var string
     */
    private $cnpj;

    /**
     * @var string
     */
    private $stateRegistry;

    /**
     * @var string
     */
    private $cityRegistry;

    /**
     * @var string
     */
    private $contact;

    /**
     * @var string
     */
    private $contactPhone;

    /**
     * @var string
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

