<?php
/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 16/05/2018
 * Time: 23:22
 */

namespace App\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Activation;
use Symfony\Component\HttpFoundation\Response;


class ProfileController extends BaseController
{

    public function __construct()
    {

    }

    /**
     * @Route("/profile" )
     */
    public function showAction()
    {
//        $data = parent::showAction();
//        var_dump($data);
        $user = $this->getUser();
        $data = [
            'name' => $user->getName(),
            'age' => $user->getAge(),
            'familly' => $user->getFamily(),
            'race' => $user->getRace(),
            'food' => $user->getFood(),
        ];
        $response = new Response(json_encode($data));
        return $response;
    }

}