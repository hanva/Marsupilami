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
     * @ManyToMany(targetEntity="User")
     * @JoinTable(name="friends",
     *     joinColumns={@JoinColumn(name="user_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="user_b_id", referencedColumnName="id")}
     * )
     * @var ArrayCollection
     */
    private $friends;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->friends = new ArrayCollection();
    }

    /**
     * @return array
     */
    public function getFriends()
    {
        return $this->friends->toArray();
    }

    /**
     * @param  User $user
     * @return void
     */
    public function addFriend(User $user)
    {
        if (!$this->friends->contains($user)) {
            $this->friends->add($user);
            $user->addFriend($this);
        }
    }

    /**
     * @param  User $user
     * @return void
     */
    public function removeFriend(User $user)
    {
        if ($this->friends->contains($user)) {
            $this->friends->removeElement($user);
            $user->removeFriend($this);
        }
    }
}
