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
use PDO;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/friends",name="friends")
     */
    public function friends()
    {
        $user = $this->getUser();
        $myFriends = $user->getMyFriends();
        var_dump($myFriends);
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = 'SELECT * FROM user ';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $result = $statement->fetchAll();
        $data = [
            'users' => $result,
            'friends' => $myFriends,
        ];
        return $this->render('friends.html.twig', $data);
    }

    /**
     * @Route("/addFriends" ,methods={"POST"})
     */
    public function addFriends(Request $request)
    {
        if (isset($request) && is_string($id = $request->get('id'))) {
            $user = $this->getUser();
            $friend = $this->getDoctrine()->getRepository(User::class)->find($id);
            $user->addFriend($friend);
        }
        return $this->redirectToRoute('friends');
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
        }
        return $this->redirectToRoute('friends');
    }
}