<?php

namespace Uerp\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndividualPerson
 * 
 * @ORM\Table(name="individual_person" )
 * @ORM\Entity
 */
 
class IndividualPerson
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

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

