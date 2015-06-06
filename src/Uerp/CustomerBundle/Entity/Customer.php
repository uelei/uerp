<?php

namespace Uerp\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Customer
 * @package Uerp\CustomerBundle\Entity
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"individual"="IndividualPerson","company"="CompanyPerson"})
 * @ORM\Table(name="customer")
 */
abstract class Customer
{

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
    
    /**
     * @ORM\OneToOne(targetEntity="CompanyPerson")
     * @ORM\JoinColumn(name="companyperson_id", referencedColumnName="id")
     */
    private $company;
    
    /**
     * @ORM\OneToOne(targetEntity="IndividualPerson")
     * @ORM\JoinColumn(name="individualperson_id", referencedColumnName="id")
     */
    private $individual;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return mixed
     */
    public function getMobileNumber()
    {
        return $this->mobile_number;
    }

    /**
     * @param mixed $mobile_number
     */
    public function setMobileNumber($mobile_number)
    {
        $this->mobile_number = $mobile_number;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * @param mixed $birth_date
     */
    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getStreetNumber()
    {
        return $this->street_number;
    }

    /**
     * @param mixed $street_number
     */
    public function setStreetNumber($street_number)
    {
        $this->street_number = $street_number;
    }

    /**
     * @return mixed
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * @param mixed $complement
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $district
     */
    public function setDistrict($district)
    {
        $this->district = $district;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * @param mixed $postal_code
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }


    /**
     * @return mixed
     */
    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->name();
    }



}



/**
 * IndividualPerson
 *
 * @ORM\Entity
 */
class IndividualPerson extends Customer
{


    /**
     * @var string
     * @ORM\Column(name="cpf", type="string", length=14)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="rg_number", type="string", length=14, nullable=true)
     */
    private $rgNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rg_expedition_date", type="date", nullable=true)
     */
    private $rgExpeditionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="rg_expedition_local", type="string", length=30, nullable=true)
     */
    private $rgExpeditionLocal;

    /**
     * @var string
     *
     * @ORM\Column(name="occupation", type="string", length=50, nullable=true)
     */
    private $occupation;

    /**
     * @var string
     *
     * @ORM\Column(name="workplace", type="string", length=50, nullable=true)
     */
    private $workplace;

    /**
     * @var string
     *
     * @ORM\Column(name="salary", type="decimal", nullable=true)
     */
    private $salary;

    /**
     * @var string
     *
     * @ORM\Column(name="spouse_name", type="string", length=50, nullable=true)
     */
    private $spouseName;

    /**
     * @var string
     *
     * @ORM\Column(name="father_name", type="string", length=50, nullable=true)
     */
    private $fatherName;

    /**
     * @var string
     *
     * @ORM\Column(name="mother_name", type="string", length=50, nullable=true)
     */
    private $motherName;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1)
     */
    private $gender;



    /**
     * Set cpf
     *
     * @param string $cpf
     *
     * @return IndividualPerson
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set rgNumber
     *
     * @param string $rgNumber
     *
     * @return IndividualPerson
     */
    public function setRgNumber($rgNumber)
    {
        $this->rgNumber = $rgNumber;

        return $this;
    }

    /**
     * Get rgNumber
     *
     * @return string
     */
    public function getRgNumber()
    {
        return $this->rgNumber;
    }

    /**
     * Set rgExpeditionDate
     *
     * @param \DateTime $rgExpeditionDate
     *
     * @return IndividualPerson
     */
    public function setRgExpeditionDate($rgExpeditionDate)
    {
        $this->rgExpeditionDate = $rgExpeditionDate;

        return $this;
    }

    /**
     * Get rgExpeditionDate
     *
     * @return \DateTime
     */
    public function getRgExpeditionDate()
    {
        return $this->rgExpeditionDate;
    }

    /**
     * Set rgExpeditionLocal
     *
     * @param string $rgExpeditionLocal
     *
     * @return IndividualPerson
     */
    public function setRgExpeditionLocal($rgExpeditionLocal)
    {
        $this->rgExpeditionLocal = $rgExpeditionLocal;

        return $this;
    }

    /**
     * Get rgExpeditionLocal
     *
     * @return string
     */
    public function getRgExpeditionLocal()
    {
        return $this->rgExpeditionLocal;
    }

    /**
     * Set occupation
     *
     * @param string $occupation
     *
     * @return IndividualPerson
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }

    /**
     * Get occupation
     *
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Set workplace
     *
     * @param string $workplace
     *
     * @return IndividualPerson
     */
    public function setWorkplace($workplace)
    {
        $this->workplace = $workplace;

        return $this;
    }

    /**
     * Get workplace
     *
     * @return string
     */
    public function getWorkplace()
    {
        return $this->workplace;
    }

    /**
     * Set salary
     *
     * @param string $salary
     *
     * @return IndividualPerson
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return string
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set spouseName
     *
     * @param string $spouseName
     *
     * @return IndividualPerson
     */
    public function setSpouseName($spouseName)
    {
        $this->spouseName = $spouseName;

        return $this;
    }

    /**
     * Get spouseName
     *
     * @return string
     */
    public function getSpouseName()
    {
        return $this->spouseName;
    }

    /**
     * Set fatherName
     *
     * @param string $fatherName
     *
     * @return IndividualPerson
     */
    public function setFatherName($fatherName)
    {
        $this->fatherName = $fatherName;

        return $this;
    }

    /**
     * Get fatherName
     *
     * @return string
     */
    public function getFatherName()
    {
        return $this->fatherName;
    }

    /**
     * Set motherName
     *
     * @param string $motherName
     *
     * @return IndividualPerson
     */
    public function setMotherName($motherName)
    {
        $this->motherName = $motherName;

        return $this;
    }

    /**
     * Get motherName
     *
     * @return string
     */
    public function getMotherName()
    {
        return $this->motherName;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return IndividualPerson
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }
}


/**
 *
 * @ORM\Entity
 */
class CompanyPerson extends Customer
{

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
    
    /**
     * Set company
     *
     * @param \Uerp\CustomerBundle\Entity\CompanyPerson $company
     *
     * @return CompanyPerson
     */
    public function setCompany(\Uerp\CustomerBundle\Entity\CompanyPerson $company = null)
    {
    	$this->company = $company;
    
    	return $this;
    }
    
    /**
     * Get company
     *
     * @return \Uerp\CustomerBundle\Entity\CompanyPerson
     */
    public function getCompany()
    {
    	return $this->company;
    }
    
    /**
     * Set individual
     *
     * @param \Uerp\CustomerBundle\Entity\IndividualPerson $individual
     *
     * @return IndividualPerson
     */
    public function setIndividual(\Uerp\CustomerBundle\Entity\IndividualPerson $individual = null)
    {
    	$this->individual = $individual;
    
    	return $this;
    }
    
    /**
     * Get individual
     *
     * @return \Uerp\CustomerBundle\Entity\IndividualPerson
     */
    public function getIndividual()
    {
    	return $this->individual;
    }
    
}
