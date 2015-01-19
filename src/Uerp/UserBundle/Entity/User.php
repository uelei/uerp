<?php
/**
 * Created by PhpStorm.
 * User: uelei
 * Date: 19/01/15
 * Time: 11:44 AM
 */
// src/Uerp/UserBundle/Entity/User.php

namespace Uerp\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }



}