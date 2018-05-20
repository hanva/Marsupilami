<?php
/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 16/05/2018
 * Time: 11:58
 */

namespace App\Controller;


use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegistrationController extends BaseController
{
    public function __construct()
    {

    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function registerAction(Request $request)
    {
        $data = parent::registerAction();
        var_dump($data);
        die;
    }
}