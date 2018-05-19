<?php
/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 19/05/2018
 * Time: 14:02
 */

namespace App\Utils;


class FriendsManager
{
    public function getFriends($user)
    {
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
        return $data;
    }
}