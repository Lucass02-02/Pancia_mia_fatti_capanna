<?php // File: seed.php (da eseguire una sola volta)

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/bootstrap.php';

use AppORM\Entity\EProduct;
use AppORM\Entity\ProductCategory; // Importiamo l'enum delle categorie
use AppORM\Services\Foundation\FPersistentManager;

echo "<h1>Seeding del Database...</h1>";

// Aggiungiamo la categoria a ogni prodotto
$products = [
    [
        'name' => 'Spaghetti alla Carbonara',
        'description' => 'Un classico della cucina romana con guanciale, uova, pecorino e pepe.',
        'price' => 12.50,
        'category' => ProductCategory::PRIMO, // Categoria aggiunta
        'imageUrl' => 'https://www.giallozafferano.it/images/228-22822/Spaghetti-alla-Carbonara_650x433_wm.jpg'
    ],
    [
        'name' => 'Pizza Margherita',
        'description' => 'La regina delle pizze con pomodoro, mozzarella fior di latte e basilico fresco.',
        'price' => 8.00,
        'category' => ProductCategory::SECONDO, // Tecnicamente un piatto unico, ma lo mettiamo qui
        'imageUrl' => 'https://www.giallozafferano.it/images/219-21928/Pizza-Margherita_650x433_wm.jpg'
    ],
    [
        'name' => 'Tiramisù',
        'description' => 'Dolce al cucchiaio con savoiardi, caffè, mascarpone e cacao.',
        'price' => 6.00,
        'category' => ProductCategory::DOLCE, // Categoria aggiunta
        'imageUrl' => 'https://www.giallozafferano.it/images/2-246/Tiramisu_650x433_wm.jpg'
    ],
    [
        'name' => 'Tagliata di Manzo',
        'description' => 'Controfiletto di manzo servito con rucola, pomodorini e scaglie di grana.',
        'price' => 18.00,
        'category' => ProductCategory::SECONDO, // Categoria aggiunta
        'imageUrl' => 'https://www.giallozafferano.it/images/231-23176/Tagliata-di-manzo_650x433_wm.jpg'
    ]
];

foreach ($products as $p) {
    echo "Aggiungo: " . $p['name'] . "... ";
    
    try {
        // --- MODIFICA FONDAMENTALE QUI ---
        // Creiamo l'oggetto passando tutti i parametri richiesti dal costruttore
        $product = new EProduct(
            $p['name'],
            $p['description'],
            $p['price'],
            $p['category']
        );

        // Ora impostiamo le proprietà aggiuntive che non sono nel costruttore
        $product->setAvailability(true);
        // Nota: la tua entity EProduct non ha un metodo setImageUrl, quindi non possiamo impostarlo.
        // Se vuoi aggiungere l'immagine, dovrai aggiungere il campo e il metodo setImageUrl() alla classe EProduct.

        FPersistentManager::saveProduct($product);
        
        echo "<b style='color: green;'>Fatto!</b><br>";

    } catch (Exception $e) {
        echo "<b style='color: red;'>Errore!</b><br>";
        echo "<p style='color: red; border: 1px solid red; padding: 10px;'><strong>Dettaglio Errore:</strong> " . $e->getMessage() . "</p>";
        break; 
    }
}

echo "<h2>Seeding completato!</h2>";
echo "<p>Ora puoi cancellare questo file (seed.php).</p>";
echo '<a href="/GitHub/Pancia_mia_fatti_capanna/index.php?c=home&a=menu">Vai al Menù</a>';
