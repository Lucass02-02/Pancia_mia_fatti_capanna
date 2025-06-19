<?php

class EStatistics {

    //attributes

    private array $mostSelledDishes;

    private array $usualClients;

    private $stocks;

    private float $monthlyRevenue;

    //constructor

    public function __construct(array $mostSelledDishes = [], array $usualClients = [], $stocks = null, float $monthlyRevenue = 0.0) {
        $this->mostSelledDishes = $mostSelledDishes;
        $this->usualClients = $usualClients;
        $this->stocks = $stocks;
        $this->monthlyRevenue = $monthlyRevenue;
    }

    //methods getters and setters

    public function getMostSelledDishes() {
        return $this->mostSelledDishes;
    }

    public function setmostSelledDishes(array $mostSelledDishes) {
        $this->mostSelledDishes = $mostSelledDishes;
    }

    public function getUsualClients() {
        return $this->usualClients;
    }

    public function setUsualClients(array $usualClients) {
        $this->usualClients = $usualClients;
    }

    public function getStocks() {
        return $this->stocks;
    }

    public function setStocks($stocks) {
        $this->stocks = $stocks;
    }

    public function getMoncthlyRevenue() {
        return $this->monthlyRevenue;
    }

    public function setMonthlyRevenue(float $monthlyRevenue) {
        $this->monthlyRevenue = $monthlyRevenue;
    }

    

}