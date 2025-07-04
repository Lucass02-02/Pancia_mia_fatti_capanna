<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

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

    // Metodi Getter e Setter
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(DateTime $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(?string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;
        return $this;
    }

    public function getRegistrationDate(): DateTime
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(DateTime $registrationDate): self
    {
        $this->registrationDate = $registrationDate;
        return $this;
    }
}