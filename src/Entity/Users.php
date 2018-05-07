<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text" ,length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="integer",length=100)
     */
    private $age;

    /**
     * @ORM\Column(type="text" ,length=100)
     */
    private $family;

    /**
     * @ORM\Column(type="text" ,length=100)
     */
    private $race;

    /**
     * @ORM\Column(type="text" ,length=100)
     */
    private $food;

    public function getId()
    {
        return $this->id;
    }
}
