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
    private $id;

    #[ORM\Column(type: 'text', nullable: false)]
    private string $responseText;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $responseDate;

    #[ORM\ManyToOne(targetEntity: EAdmin::class, inversedBy: 'admin_responses')]
    #[ORM\JoinColumn(name: 'admin_id', referencedColumnName: 'id')]
    private EAdmin $admin;

    #[ORM\ManyToMany(targetEntity: EUserReview::class, mappedBy: 'adminResponses')]
    private Collection $userReviews;

    //constructor
    public function __construct(string $responseText, $responseDate) {
        $this->responseText = $responseText;
        $this->responseDate = $responseDate;
    }

    //methods getters and setters

    public function getEntity() {
        return self::class;
    }

    public function getIdResponse() {
        return $this->id;
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
    
    public function getAdmin(): EAdmin {
        return $this->admin;
    }

    public function setAdmin(EAdmin $admin) {
        $this->admin = $admin;
    }

    public function getUserReviews(): Collection {
        return $this->userReviews;
    }

    public function setUserReviews(Collection $userReviews) {
        $this->userReviews = $userReviews;
    }

    
}