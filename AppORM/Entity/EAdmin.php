<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;


#[ORM\Entity]
#[ORM\Table(name: 'admins')]
class EAdmin extends EUser {

    #[ORM\OneToMany(targetEntity: EAdminResponse::class, mappedBy: 'admins')]
    private Collection $responses;

    //constructor
    public function __construct($name, $surname, $email, $password) {
        parent::__construct($name, $surname, $email, $password);
    }

}