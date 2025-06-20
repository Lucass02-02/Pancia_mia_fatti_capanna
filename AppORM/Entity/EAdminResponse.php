<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'admin_responses')]
class EAdminResponse {
    
    //attributes
    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $idResponse;

    #[ORM\Column(type: 'text', nullable: false)]
    private string $responseText;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $responseDate;

    //constructor
    public function __construct(string $responseText, $responseDate) {
        $this->responseText = $responseText;
        $this->responseDate = $responseDate;
    }

    //methods getters and setters
    public function getIdResponse() {
        return $this->idResponse;
    }

    public function getResponseText() {
        return $this->responseText;
    }

    public function setResponseText(string $responseText) {
        $this->responseText = $responseText;
    }

    public function getResponseDate() {
        return $this->responseDate;
    }

    public function setResponseDate($responseDate) {
        $this->responseDate = $responseDate;
    }
    
}