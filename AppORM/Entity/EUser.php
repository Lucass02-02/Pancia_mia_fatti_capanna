<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM; // CORRETTO: Singolo backslash
use DateTime; // CORRETTO: Singolo backslash (e rimosso il commento inutile)

#[ORM\MappedSuperclass] // CORRETTO: Singolo backslash
abstract class EUser
{
    // Attributi
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

    // --- NUOVA PROPRIETÀ: registrationDate (questa era la causa dell'errore originale) ---
    #[ORM\Column(type: 'datetime', nullable: false)]
    protected \DateTime $registrationDate; // CORRETTO: Singolo backslash
    // ---------------------------------------------------------------------------------

    // Costruttore
    public function __construct($name, $surname, $birthDate, $email, $password, $phonenumber)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->birthDate = $birthDate;
        $this->email = $email;
        $this->password = $password;
        $this->phonenumber = $phonenumber;
        
        // Imposta la data di registrazione automaticamente alla creazione
        $this->registrationDate = new \DateTime(); // CORRETTO: Singolo backslash
    }

    // Metodi getters e setters (esistenti)
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

    // --- NUOVI GETTER E SETTER per registrationDate ---
    public function getRegistrationDate(): \DateTime // CORRETTO: Singolo backslash
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTime $registrationDate): self // CORRETTO: Singolo backslash
    {
        $this->registrationDate = $registrationDate;
        return $this;
    }
    // ----------------------------------------------------
}