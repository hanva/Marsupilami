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
use Symfony\Component\HttpFoundation\Request;


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

    /**
     * @Route("/editProfile" ,methods={"POST"}))
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $data = json_decode($request->getContent(), true);
        $data = [
            'name' => $user->setName($data['username']),
            'age' => $user->setAge($data['age']),
            'familly' => $user->setFamily($data['familly']),
            'race' => $user->setRace($data['race']),
            'food' => $user->setFood($data['food']),
        ];
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $response = new Response(json_encode(["status" => "200"]));
        return $response;
    }
}