<?php

namespace Uerp\CustomerBundle\Entity;

/**
 * IndividualPerson
 */
class IndividualPerson
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $cpf;

    /**
     * @var string
     */
    private $rgNumber;

    /**
     * @var \DateTime
     */
    private $rgExpeditionDate;

    /**
     * @var string
     */
    private $rgExpeditionLocal;

    /**
     * @var string
     */
    private $occupation;

    /**
     * @var string
     */
    private $workplace;

    /**
     * @var string
     */
    private $salary;

    /**
     * @var string
     */
    private $spouseName;

    /**
     * @var string
     */
    private $fatherName;

    /**
     * @var string
     */
    private $motherName;

    /**
     * @var string
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

