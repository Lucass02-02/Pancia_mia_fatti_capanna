<?php
require_once "bootstrap.php";

use AppORM\Entity\EClient;
use AppORM\Entity\ERestaurantHall;
use AppORM\Entity\ETable;
use AppORM\Entity\ETurn;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Entity\TableState;
use AppORM\Entity\TurnName;

// 1. Crea un cliente
$client = new EClient(
    "Mario",
    "Rossi",
    new DateTime("1990-05-15"),
    "mario@example.com",
    "securePassword123",      // Puoi usare una hash se necessario
    "1234567890",
    [],                       // savedMethods
    "mariorossi"              // nickname
);
FEntityManager::getInstance()->saveObject($client);

// 2. Crea una sala
$hall = new ERestaurantHall(20); // totalPlaces
 // se esiste un setter per il nome
FEntityManager::getInstance()->saveObject($hall);

// 3. Crea un turno (es: pranzo)
$turn = new ETurn(
    TurnName::LUNCH,                  // enum
    new DateTime("12:00"),
    new DateTime("15:00")
);
FEntityManager::getInstance()->saveObject($turn);

// 4. Crea un tavolo
$table = new ETable(
    4,                                 // seatsNumber
    TableState::AVAILABLE              // enum stato
);               // se hai un numero identificativo
$table->setRestaurantHall($hall);     // assegna la sala
FEntityManager::getInstance()->saveObject($table);

echo "✅ Dati iniziali inseriti correttamente nel database.\n";
