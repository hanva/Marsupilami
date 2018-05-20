<?php
/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 07/05/2018
 * Time: 15:28
 */

namespace App\Controller;

use App\Utils\FriendsManager;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    /**
     * @Route("/" )
     */
    public function homepage()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/getUsers")
     */
    public function getUsers()
    {
        $RAW_QUERY = 'SELECT * FROM user ';
        $em = $this->getDoctrine()->getManager();
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $result = $statement->fetchAll();
        $response = new Response(json_encode($result));
        return $response;
    }

    /**
     * @Route("/friends",name="friends")
     */
    public function friends()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = 'SELECT * FROM user ';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $result = $statement->fetchAll();
        $friendManger = new FriendsManager();
        $data["friends"] = $friendManger->getFriends($user);
        $data["users"] = $result;
        $response = new Response(json_encode($data));
        return $response;
    }

    /**
     * @Route("/addFriends" ,methods={"POST"})
     */
    public function addFriends(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $username = implode(",", $data);
        if (isset($request) && is_string($username)) {
            $user = $this->getUser();
            $friend = $this->getDoctrine()->getRepository(User::class)->findByName($username);
            if (empty($friend))
                return $this->redirectToRoute('friends');
            else {
                $user->addFriend($friend[0]);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            }
            $friendManger = new FriendsManager();
            $data = $friendManger->getFriends($user);
            $response = new Response(json_encode($data));
            return $response;
        }
    }

    /**
     * @Route("/removeFriends" ,methods={"POST"}))
     */
    public
    function removeFriends(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $username = implode(",", $data);
        if (isset($request) && is_string($username)) {
            $user = $this->getUser();
            $friend = $this->getDoctrine()->getRepository(User::class)->findByName($username);
            $user->removeFriend($friend[0]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        $user = $this->getUser();
        $friendManger = new FriendsManager();
        $data = $friendManger->getFriends($user);
        $response = new Response(json_encode($data));
        return $response;
    }

}