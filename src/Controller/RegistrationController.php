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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegistrationController extends BaseController
{
    public function __construct()
    {

    }

    /**
     * @param Request $request
     * @Route("/registerFriends" ,methods={"POST"})
     * @return Response
     */
    public function registerFriends(Request $request)
    {
        $user = new User();
        $data = json_decode($request->getContent(), true);
        $data = [
            'name' => $user->setName($data['name']),
            'age' => $user->setAge($data['age']),
            'familly' => $user->setFamily($data['familly']),
            'race' => $user->setRace($data['race']),
            'food' => $user->setFood($data['food']),
            'password' => $user->setPassword($data['password']),
            'enabled' => $user->setEnabled(true),
        ];
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $response = new Response(json_encode(["status" => "200"]));
        return $response;
    }
}