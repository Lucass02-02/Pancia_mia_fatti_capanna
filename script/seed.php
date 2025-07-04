<?php // File: seed.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/bootstrap.php';

use AppORM\Entity\EProduct;
use AppORM\Entity\EAllergens;
use AppORM\Entity\ProductCategory;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Foundation\FEntityManager;

echo "<h1>Seeding del Database...</h1>";

$em = FEntityManager::getEntityManager();
$connection = $em->getConnection();
$dbPlatform = $connection->getDatabasePlatform();
$connection->executeStatement('SET FOREIGN_KEY_CHECKS=0;');
$connection->executeStatement($dbPlatform->getTruncateTableSql('products_allergens', true));
$connection->executeStatement($dbPlatform->getTruncateTableSql($em->getClassMetadata(EProduct::class)->getTableName(), true));
$connection->executeStatement($dbPlatform->getTruncateTableSql($em->getClassMetadata(EAllergens::class)->getTableName(), true));
echo "<p>Tabelle prodotti e allergeni svuotate.</p>";

// --- 1. Creiamo gli Allergeni ---
$allergensData = ['Glutine', 'Uova', 'Lattosio', 'Frutta a guscio'];
$allergenObjects = [];
echo "<h2>Aggiungo Allergeni...</h2>";
foreach ($allergensData as $name) {
    try {
        // --- CORREZIONE QUI ---
        // Creiamo l'oggetto passando il nome direttamente al costruttore, come richiesto.
        $allergen = new EAllergens($name);

        FPersistentManager::saveAllergen($allergen);
        $allergenObjects[$name] = $allergen;
        echo "Aggiunto: $name<br>";
    } catch (Exception $e) {
        echo "Errore durante l'aggiunta di $name: " . $e->getMessage() . "<br>";
    }
}

// --- 2. Creiamo i Prodotti e li colleghiamo agli allergeni ---
echo "<h2>Aggiungo Prodotti...</h2>";
$productsData = [
    ['name' => 'Spaghetti alla Carbonara', 'description' => 'Guanciale, uova, pecorino.', 'price' => 12.50, 'category' => ProductCategory::PRIMO, 'allergens' => ['Glutine', 'Uova', 'Lattosio']],
    ['name' => 'Pizza Margherita', 'description' => 'Pomodoro e mozzarella.', 'price' => 8.00, 'category' => ProductCategory::SECONDO, 'allergens' => ['Glutine', 'Lattosio']],
    ['name' => 'Tiramisù', 'description' => 'Savoiardi, caffè, mascarpone.', 'price' => 6.00, 'category' => ProductCategory::DOLCE, 'allergens' => ['Glutine', 'Uova', 'Lattosio']],
    ['name' => 'Tagliata di Manzo', 'description' => 'Controfiletto con rucola.', 'price' => 18.00, 'category' => ProductCategory::SECONDO, 'allergens' => []]
];

foreach ($productsData as $p) {
    echo "Aggiungo: " . $p['name'] . "... ";
    $product = new EProduct($p['name'], $p['description'], $p['price'], $p['category']);
    $product->setAvailability(true);
    foreach ($p['allergens'] as $allergenName) {
        if (isset($allergenObjects[$allergenName])) {
            $product->addAllergen($allergenObjects[$allergenName]);
        }
    }
    FPersistentManager::saveProduct($product);
    echo "<b style='color: green;'>Fatto!</b><br>";
}

$connection->executeStatement('SET FOREIGN_KEY_CHECKS=1;');
echo "<h2>Seeding completato!</h2>";
echo '<a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=home&a=menu">Vai al Menù</a>';
