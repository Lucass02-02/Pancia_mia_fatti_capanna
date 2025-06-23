<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'user_reviews')]
class EUserReview {

    //attributes
    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'text', nullable: false)]
    private $description;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $vote;

    #[ORM\Column(type: 'date', nullable: false)]
    private $date;

    #[ORM\Column(type: 'time', nullable: false)]
    private $hour;

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'user_reviews')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private EUser $user;

    #[ORM\ManyToMany(targetEntity: EAdminResponse::class, inversedBy: 'user_reviews')]
    #[ORM\JoinTable(name: 'user_review_responses')]
    private Collection $adminResponses;
    //constructor

    public function __construct( $description, $vote, $date, $hour) {
        $this->description = $description;
        $this->vote = $vote;
        $this->date = $date;
        $this->hour = $hour;
    }

    //methods getters and setters

    public function getEntity() {
        return self::class;
    }

    public function getIdReview() {
        return $this->id;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getVote() {
        return $this->vote;
    }

    public function setVote($vote) {
        $this->vote = $vote;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getHour() {
        return $this->hour;
    }

    public function setHour($hour) {
        $this->hour = $hour;
    }

}