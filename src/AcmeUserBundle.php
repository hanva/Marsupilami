<?php
/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 08/05/2018
 * Time: 00:40
 */

namespace App;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}