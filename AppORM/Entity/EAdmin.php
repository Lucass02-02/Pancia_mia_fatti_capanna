<?php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection; // Importa ArrayCollection per l'inizializzazione

#[ORM\Entity]
#[ORM\Table(name: 'admins')]
class EAdmin extends EUser
{
    #[ORM\OneToMany(targetEntity: EAdminResponse::class, mappedBy: 'admin', cascade: ['persist'])]
    private Collection $responses;

    private static $entity = EAdmin::class;

    public function __construct($name, $surname, $birthDate, $email, $password, $phoneNumber)
    {
        parent::__construct($name, $surname, $birthDate, $email, $password, $phoneNumber);
        $this->responses = new ArrayCollection(); // Inizializza la collezione
    }

    public static function getEntity()
    {
        return self::$entity;
    }

    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function setResponses(Collection $responses)
    {
        $this->responses = $responses;
    }

    public function addResponse(EAdminResponse $response): void
    {
        if (!$this->responses->contains($response)) {
            $this->responses->add($response);
            $response->setAdmin($this); 
        }
    }
}