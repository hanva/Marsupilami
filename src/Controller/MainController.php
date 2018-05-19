<?php
/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 07/05/2018
 * Time: 15:28
 */

namespace App\Controller;


use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
        $myFriends = $user->getMyFriends();
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = 'SELECT * FROM user ';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $result = $statement->fetchAll();
        $friendsArray = [];
        $count = 0;
        while ($count < sizeof($myFriends)) {
            $name = $myFriends[$count]->getName();
            $id = $myFriends[$count]->getId();
            $friend = [
                'name' => $name,
                '$id' => $id
            ];
            array_push($friendsArray, $friend);
            $count++;
        }
        $data = [
            'users' => $result,
            'friends' => $friendsArray,
        ];
        $response = new Response(json_encode($data));
        return $response;
        //        return $this->render('friends.html.twig', $data);
    }

    /**
     * @Route("/addFriends" ,methods={"POST"})
     */
    public function addFriends(Request $request)
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $username = $request->username;
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
            $user = $this->getUser();
            $myFriends = $user->getMyFriends();
            $data = [];
            $count = 0;
            while ($count < sizeof($myFriends)) {
                $name = $myFriends[$count]->getName();
                $id = $myFriends[$count]->getId();
                $friend = [
                    'name' => $name,
                    '$id' => $id
                ];
                array_push($data, $friend);
                $count++;
            }
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
        if (isset($request) && is_string($id = $request->get('id'))) {
            $user = $this->getUser();
            $friend = $this->getDoctrine()->getRepository(User::class)->find($id);
            $user->removeFriend($friend);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        return $this->redirectToRoute('friends');
    }

}