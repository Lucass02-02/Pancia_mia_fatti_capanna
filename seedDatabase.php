<?php
require_once "bootstrap.php";

use AppORM\Entity\DayOfWeek;
use AppORM\Entity\EClient;
use AppORM\Entity\EProduct;
use AppORM\Entity\ERestaurantHall;
use AppORM\Entity\ETable;
use AppORM\Entity\ETurn;
use AppORM\Entity\EProductCategory;
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
        TurnName::LUNCH,
        DayOfWeek::MONDAY,                  // enum
        new DateTime("12:00"),
        new DateTime("15:00")
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);

    $turn = new ETurn(
        TurnName::DINNER,
        DayOfWeek::MONDAY,                  
        new DateTime("19:00"),
        new DateTime("22:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
    
    $turn = new ETurn(
        TurnName::LUNCH,
        DayOfWeek::TUESDAY,                  
        new DateTime("12:00"),
        new DateTime("15:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
  
    $turn = new ETurn(
        TurnName::DINNER,
        DayOfWeek::TUESDAY,                  
        new DateTime("19:00"),
        new DateTime("22:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
  
    $turn = new ETurn(
        TurnName::DINNER,
        DayOfWeek::WEDNESDAY,                  
        new DateTime("19:00"),
        new DateTime("22:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
    
    $turn = new ETurn(
        TurnName::DINNER,
        DayOfWeek::WEDNESDAY,                  
        new DateTime("19:00"),
        new DateTime("22:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
  
    $turn = new ETurn(
        TurnName::LUNCH,
        DayOfWeek::THURSDAY,                  
        new DateTime("12:00"),
        new DateTime("15:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
  
    $turn = new ETurn(
        TurnName::DINNER,
        DayOfWeek::THURSDAY,                  
        new DateTime("19:00"),
        new DateTime("22:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
  
    $turn = new ETurn(
        TurnName::LUNCH,
        DayOfWeek::FRIDAY,                  
        new DateTime("12:00"),
        new DateTime("15:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
  
    $turn = new ETurn(
        TurnName::DINNER,
        DayOfWeek::FRIDAY,                  
        new DateTime("19:00"),
        new DateTime("22:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
  
    $turn = new ETurn(
        TurnName::LUNCH,
        DayOfWeek::SATURDAY,                  
        new DateTime("12:00"),
        new DateTime("15:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
  
    $turn = new ETurn(
        TurnName::DINNER,
        DayOfWeek::SATURDAY,                  
        new DateTime("19:00"),
        new DateTime("22:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
  
    $turn = new ETurn(
        TurnName::LUNCH,
        DayOfWeek::SUNDAY,                  
        new DateTime("12:00"),
        new DateTime("15:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
  
    $turn = new ETurn(
        TurnName::DINNER,
        DayOfWeek::SUNDAY,                  
        new DateTime("19:00"),
        new DateTime("22:00")                 
    );
    $turn->setRestaurantHall($hall); // assegna la sala al turno
    FEntityManager::getInstance()->saveObject($turn);
  

// 4. Crea un tavolo
$table = new ETable(
    4                                 
);               // se hai un numero identificativo
$table->setRestaurantHall($hall);     // assegna la sala
FEntityManager::getInstance()->saveObject($table);

$productCategory = new EProductCategory(
    'Primo'
);

FEntityManager::getInstance()->saveObject($productCategory);

$product = new EProduct(
    'Pizza Margherita',
    'Una classica pizza con pomodoro e mozzarella',
    8.50 ,
    $productCategory                           
);
FEntityManager::getInstance()->saveObject($product);

$product2 = new EProduct(
    'Filetto di Manzo',
    'Succulento filetto di manzo',
    20.00,
    $productCategory
);
FEntityManager::getInstance()->saveObject($product2);



echo "✅ Dati iniziali inseriti correttamente nel database.\n";
