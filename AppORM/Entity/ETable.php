<?php

class ETable {

    
    //attributes
    private $tableNum;

    private $state;


    //constructor
    public function __construct($tableNum, $state) {
        $this->tableNum = $tableNum;
        $this->state = $state;
    }

    //methods getters and setters
    public function getTableNum() {
        return $this->tableNum;
    }

    public function setTableNum($tableNum) {
        $this->tableNum = $tableNum;
    }
    
    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    
}