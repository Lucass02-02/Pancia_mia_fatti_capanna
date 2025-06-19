<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
class User{


    //attributes
    protected $name;

    protected $surname;

    protected $birthDate;

    protected $email;

    protected $password;

    protected $nickname;

    protected $phonenumber;

    //constructor
    public function __construct($name, $surname, $birthDate, $email, $password, $nickname, $phonenumber)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->password = $password;
        $this->nickname = $nickname;
        $this->phonenumber = $phonenumber;
    }


    //methods getters and setters
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

    public function getNickname()
    {
        return $this->nickname;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
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
