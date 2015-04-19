<?php

namespace Uerp\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UerpUserBundle extends Bundle
{
    public function getParent(){

        return "FOSUserBundle";


    }
}
