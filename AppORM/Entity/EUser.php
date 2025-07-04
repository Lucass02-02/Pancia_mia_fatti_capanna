<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'role', type: 'string')]
#[ORM\DiscriminatorMap([
    'client' => EClient::class,
    'waiter' => EWaiter::class,
    'admin' => EAdmin::class,
])]
abstract class EUser{

    //attributes

    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    protected $id;

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    protected $name;

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    protected $surname;

    #[ORM\Column(type: 'date', nullable: false)]
    protected $birthDate;

    #[ORM\Column(type: 'string', length: 100, nullable: false)]
    protected $email;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    protected $password;


    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    protected $phonenumber;

    //constructor
    public function __construct($name, $surname, $birthDate, $email, $password,  $phonenumber)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->password = $password;
        $this->phonenumber = $phonenumber;
    }


    //methods getters and setters
    public function getId()
    {
        return $this->id;
    }


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;
    }
    
}
