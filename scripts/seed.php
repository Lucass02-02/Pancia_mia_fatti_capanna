<?php
// scripts/seed.php

require_once __DIR__ . '/../bootstrap.php';

use AppORM\Entity\EProduct;
use AppORM\Entity\EAllergens;
use AppORM\Entity\EProductCategory;
use AppORM\Services\Foundation\FPersistentManager;

echo "Avvio dello script di seeding...\n";

$entityManager = FPersistentManager::getEntityManager();

// --- Dati di Esempio ---
$categorie_data = ['Primi Piatti', 'Pizze', 'Secondi di Carne', 'Secondi di Pesce', 'Dessert'];
$allergeni_data = ['Glutine', 'Crostacei', 'Uova', 'Pesce', 'Arachidi', 'Soia', 'Latte', 'Frutta a guscio'];
$prodotti_data = [
    ['name' => 'Spaghetti alla Carbonara', 'description' => 'Un classico con guanciale, pecorino e uova.', 'price' => 12.50, 'category' => 'Primi Piatti', 'allergens' => ['Glutine', 'Uova', 'Latte']],
    ['name' => 'Margherita Verace', 'description' => 'Pomodoro, mozzarella di bufala, basilico e olio EVO.', 'price' => 8.00, 'category' => 'Pizze', 'allergens' => ['Glutine', 'Latte']],
    ['name' => 'Tagliata di Manzo', 'description' => 'Controfiletto con rucola e Grana.', 'price' => 18.00, 'category' => 'Secondi di Carne', 'allergens' => ['Latte']],
    ['name' => 'Frittura di Paranza', 'description' => 'Misto di pesci piccoli e crostacei freschissimi.', 'price' => 16.00, 'category' => 'Secondi di Pesce', 'allergens' => ['Glutine', 'Pesce', 'Crostacei']],
    ['name' => 'Tiramisù della Casa', 'description' => 'Savoiardi, caffè, crema al mascarpone e cacao.', 'price' => 6.50, 'category' => 'Dessert', 'allergens' => ['Glutine', 'Uova', 'Latte']]
];

// FASE 1: Svuotamento delle tabelle (fuori dalla transazione)
echo "Svuotamento tabelle esistenti...\n";
$conn = $entityManager->getConnection();
try {
    $conn->executeStatement('SET FOREIGN_KEY_CHECKS=0;');
    $conn->executeStatement('TRUNCATE TABLE products_allergens;');
    $conn->executeStatement('TRUNCATE TABLE products;');
    $conn->executeStatement('TRUNCATE TABLE allergens;');
    $conn->executeStatement('TRUNCATE TABLE product_category;');
    $conn->executeStatement('SET FOREIGN_KEY_CHECKS=1;');
    echo "Tabelle svuotate con successo.\n";
} catch (\Exception $e) {
    echo "Errore durante lo svuotamento delle tabelle: " . $e->getMessage() . "\n";
    exit(1); // Esce se non riesce a svuotare le tabelle
}


// FASE 2: Inserimento dei nuovi dati (dentro una transazione)
try {
    $entityManager->getConnection()->beginTransaction();
    
    // Creazione delle Categorie
    $categoryObjects = [];
    echo "Creazione delle categorie...\n";
    foreach ($categorie_data as $categoryName) {
        $category = new EProductCategory($categoryName);
        FPersistentManager::saveProductCategory($category);
        $categoryObjects[$categoryName] = $category;
    }
    echo "Categorie create.\n";

    // Creazione degli Allergeni
    $allergenObjects = [];
    echo "Creazione degli allergeni...\n";
    foreach ($allergeni_data as $allergenName) {
        $allergen = new EAllergens($allergenName);
        FPersistentManager::saveAllergen($allergen);
        $allergenObjects[$allergenName] = $allergen;
    }
    echo "Allergeni creati.\n";

    // Creazione dei Prodotti
    echo "Creazione dei prodotti...\n";
    foreach ($prodotti_data as $prodotto_info) {
        $productCategoryObject = $categoryObjects[$prodotto_info['category']];
        $product = new EProduct(
            $prodotto_info['name'], 
            $prodotto_info['description'],
            $prodotto_info['price'], 
            $productCategoryObject
        );

        if (isset($prodotto_info['allergens'])) {
            foreach ($prodotto_info['allergens'] as $allergenName) {
                if (isset($allergenObjects[$allergenName])) {
                    $product->addAllergen($allergenObjects[$allergenName]);
                }
            }
        }
        FPersistentManager::saveProduct($product);
    }
    echo "Prodotti creati.\n";
    
    // Conferma la transazione
    $entityManager->getConnection()->commit();

    echo "\n--------------------------------------------------\n";
    echo "✅ Script completato! Il database è stato popolato.\n";
    echo "--------------------------------------------------\n";

} catch (\Exception $e) {
    if ($entityManager->getConnection()->isTransactionActive()) {
        $entityManager->getConnection()->rollBack();
    }
    echo "\n❌ Si è verificato un errore durante l'inserimento, la transazione è stata annullata:\n";
    echo "Messaggio: " . $e->getMessage() . "\n";
}