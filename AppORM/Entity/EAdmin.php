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

    //methods getters and setters
    public function getEntity() {
        return self::class;
    }

    public function getResponses(): Collection {
        return $this->responses;
    }

    public function setResponses(Collection $responses) {
        $this->responses = $responses;
    }
}