<?php
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UView;
use AppORM\Entity\EProduct;

class CHome
{
    /**
     * Gestisce la pagina principale del sito (homepage).
     */
    public static function home(): void
    {
        $data = [
            'titolo' => 'Benvenuto in Pancia mia fatti capanna!',
            'messaggio' => 'Il miglior ristorante della zona.'
        ];
        UView::render('home', $data);
    }

    /**
     * Mostra il menù e gestisce la logica di filtro per allergeni.
     */
    public static function menu(): void
    {
<<<<<<< Updated upstream
        // 1. Recuperiamo i filtri scelti dall'utente (se ci sono)
        $selectedAllergens = array_map('intval', $_GET['allergens'] ?? []);
        
        // 2. Carichiamo SEMPRE tutti i prodotti dal database
        $allProducts = FPersistentManager::getAllProducts();
        $filteredProducts = [];
=======
        // 1. Recupera i filtri per allergeni (ID interi)
        $selectedAllergensIds = array_map('intval', $_GET['allergens'] ?? []);
>>>>>>> Stashed changes

        // 2. Carica tutti i dati necessari dal database
        $allProducts = FPersistentManager::getInstance()->getAllProducts();
        $allAllergens = FPersistentManager::getInstance()->getAllAllergens();
        
        // 3. Se non ci sono filtri, la lista dei prodotti è quella completa.
        // Altrimenti, applichiamo il filtro.
        if (empty($selectedAllergensIds)) {
            $filteredProducts = $allProducts;
        } else {
            $filteredProducts = [];
            
            /** @var EProduct $product */
            foreach ($allProducts as $product) {
                $hasExcludedAllergen = false;
                
                foreach ($product->getAllergens() as $allergen) {
                    if (in_array($allergen->getId(), $selectedAllergensIds)) {
                        $hasExcludedAllergen = true;
                        break; // Inutile continuare a controllare, il prodotto ha un allergene escluso
                    }
                }

                // Aggiungi il prodotto alla lista solo se non ha nessuno degli allergeni esclusi
                if (!$hasExcludedAllergen) {
                    $filteredProducts[] = $product;
                }
            }
        }

<<<<<<< Updated upstream
        // 4. Recuperiamo tutti gli allergeni da mostrare come checkbox
        $allAllergens = FPersistentManager::getAllAllergens();

        // 5. Passiamo i dati (la lista filtrata) alla vista
=======
        // 4. Passa i dati alla vista
>>>>>>> Stashed changes
        UView::render('menu', [
            'products' => $filteredProducts,
            'allAllergens' => $allAllergens,
            'selectedAllergens' => $selectedAllergensIds // Passiamo gli ID per mantenere i checkbox selezionati
        ]);
    }
}