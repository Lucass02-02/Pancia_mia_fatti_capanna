<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;
use Doctrine\Common\Collections\Collection;


#[ORM\Entity]
#[ORM\Table(name: 'admins')]
class EAdmin extends EUser {

    #[ORM\OneToMany(targetEntity: EAdminResponse::class, mappedBy: 'admin', cascade: ['persist'])]
    private Collection $responses;

    private static $entity = EAdmin::class;

    //constructor
    public function __construct($name, $surname, $email, $password) {
        parent::__construct($name, $surname, $email, $password);
    }

    //methods getters and setters
    public static function getEntity() {
        return self::$entity;
    }

    public function getResponses(): Collection {
        return $this->responses;
    }

    public function setResponses(Collection $responses) {
        $this->responses = $responses;
    }
}