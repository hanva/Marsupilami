<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="string" )
     */
    private $family;

    /**
     * @ORM\Column(type="string" )
     */
    private $race;

    /**
     * @ORM\Column(type="string" )
     */
    private $food;

    public function getId()
    {
        return $this->id;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getFamily()
    {
        return $this->family;
    }

    public function setFamily($family)
    {
        $this->family = $family;
    }

    public function getRace()
    {
        return $this->race;
    }

    public function setRace($race)
    {
        $this->race = $race;
    }

    public function getFood()
    {
        return $this->food;
    }

    public function setFood($food)
    {
        $this->food = $food;
    }

    public function setName($name)
    {
        parent::setEmail($name);
        parent::setUsername($name);
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * Many Users have Many Users.
     * @ManyToMany(targetEntity="User", mappedBy="myFriends")
     */
    private $friendsWithMe;

    /**
     * Many Users have many Users.
     * @ManyToMany(targetEntity="User", inversedBy="friendsWithMe")
     * @JoinTable(name="friends",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="friend_user_id", referencedColumnName="id")}
     *      )
     */
    private $myFriends;

    public function __construct()
    {
        $this->friendsWithMe = new ArrayCollection();

        $this->myFriends = new ArrayCollection();
    }

    public function getFriendsWithMe()
    {
        return $this->friendsWithMe;
    }

    /**
     * Get myFriends
     *
     * @return array
     */
    public function getMyFriends()
    {
        return $this->myFriends->toArray();
    }

    /**
     * @param   $user
     * @return void
     */
    public function addFriend(User $user)
    {
        if (!$this->myFriends->contains($user)) {
            $this->myFriends->add($user);
            $user->addFriend($this);
        }
    }

    /**
     * @param  User $user
     * @return void
     */
    public function removeFriend(User $user)
    {
        if ($this->myFriends->contains($user)) {
            $this->myFriends->removeElement($user);
            $user->removeFriend($this);
        }
    }

}