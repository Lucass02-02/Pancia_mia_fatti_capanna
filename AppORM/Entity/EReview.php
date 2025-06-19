<?php

class EReview {

    //attributes

    private $id;

    private $description;

    private $vote;

    private $date;

    private $hour;

    //constructor

    public function __construct($id, $description, $vote, $date, $hour) {
        $this->id = $id;
        $this->description = $description;
        $this->vote = $vote;
        $this->date = $date;
        $this->hour = $hour;
    }

    //methods getters and setters

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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