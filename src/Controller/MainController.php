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
        $myFriends = $user->getFriends();
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
     * @Route("/addFriends")
     */
    public function addFriends()
    {
        if (isset($_POST['add'])) {
            $id = $_POST['id'];
            $user = $this->getUser();
            $friend = $this->getDoctrine()->getRepository(User::class)->find($id);
            $friend->addFriend($user);

        }
        return $this->redirectToRoute('friends');
    }

    /**
     * @Route("/removeFriends")
     */
    public function removeFriends()
    {
        if (isset($_POST['add'])) {
            $id = $_POST['id'];
            $user = $this->getUser();
            $friend = $this->getDoctrine()->getRepository(User::class)->find($id);
            $user->removeFriend($friend);
        }
        return $this->redirectToRoute('friends');
    }
}