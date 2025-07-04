<?php
// scripts/seed_products.php

// 1. Bootstrap dell'applicazione per caricare Doctrine e le classi
require_once __DIR__ . '/../bootstrap.php';

use AppORM\Entity\EProduct;
use AppORM\Entity\EAllergens;

// Ottiene l'EntityManager, essenziale per parlare col database
$entityManager = getEntityManager();

echo "Avvio dello script di seeding per prodotti e allergeni...\n";

// 2. Dati di esempio
$allergeni_data = [
    'Glutine', 'Crostacei', 'Uova', 'Pesce', 'Arachidi', 
    'Soia', 'Latte', 'Frutta a guscio', 'Sedano', 'Senape'
];

$prodotti_data = [
    [
        'name' => 'Spaghetti alla Carbonara',
        'description' => 'Un classico intramontabile della cucina romana, con guanciale croccante, pecorino e uova.',
        'price' => 12.50,
        'allergens' => ['Glutine', 'Uova', 'Latte']
    ],
    [
        'name' => 'Margherita Verace',
        'description' => 'La regina delle pizze: pomodoro San Marzano, mozzarella di bufala, basilico fresco e olio EVO.',
        'price' => 8.00,
        'allergens' => ['Glutine', 'Latte']
    ],
    [
        'name' => 'Tagliata di Manzo',
        'description' => 'Controfiletto di manzo scottato alla perfezione, servito con rucola, scaglie di Grana e aceto balsamico.',
        'price' => 18.00,
        'allergens' => ['Latte']
    ],
    [
        'name' => 'Frittura di Paranza',
        'description' => 'Un misto di pesci piccoli e crostacei freschissimi, infarinati e fritti come vuole la tradizione.',
        'price' => 16.00,
        'allergens' => ['Glutine', 'Pesce', 'Crostacei']
    ],
    [
        'name' => 'Tiramisù della Casa',
        'description' => 'Savoiardi inzuppati nel caffè, crema al mascarpone e una spolverata di cacao amaro. Il finale perfetto.',
        'price' => 6.50,
        'allergens' => ['Glutine', 'Uova', 'Latte']
    ],
    [
        'name' => 'Insalata Caprese',
        'description' => 'Pomodoro cuore di bue, mozzarella di bufala campana, origano e basilico fresco.',
        'price' => 9.00,
        'allergens' => ['Latte']
    ]
];

try {
    // 3. Creazione e salvataggio degli Allergeni
    $allergenObjects = [];
    echo "Creazione degli allergeni...\n";
    foreach ($allergeni_data as $allergenName) {
        $allergen = new EAllergens($allergenName);
        $entityManager->persist($allergen);
        $allergenObjects[$allergenName] = $allergen; // Salva l'oggetto per un facile accesso dopo
    }
    echo "Allergeni creati.\n";

    // 4. Creazione e salvataggio dei Prodotti con le loro relazioni
    echo "Creazione dei prodotti...\n";
    foreach ($prodotti_data as $prodotto_info) {
        // Crea una nuova istanza di Prodotto
        $product = new EProduct(
            $prodotto_info['name'],
            $prodotto_info['description'],
            $prodotto_info['price']
        );

        // Associa gli allergeni al prodotto
        if (isset($prodotto_info['allergens'])) {
            foreach ($prodotto_info['allergens'] as $allergenName) {
                if (isset($allergenObjects[$allergenName])) {
                    $allergenObject = $allergenObjects[$allergenName];
                    $product->addAllergen($allergenObject); // Usa il metodo per creare la relazione
                }
            }
        }

        // Dice a Doctrine di prepararsi a salvare il prodotto
        $entityManager->persist($product);
    }
    echo "Prodotti creati.\n";

    // 5. Scrittura effettiva sul database
    echo "Salvataggio dei dati nel database...\n";
    $entityManager->flush();
    echo "\n--------------------------------------------------\n";
    echo "✅ Script completato con successo! Il database è stato popolato.\n";
    echo "--------------------------------------------------\n";

} catch (\Exception $e) {
    echo "\n❌ Si è verificato un errore durante l'esecuzione dello script:\n";
    echo $e->getMessage() . "\n";
}