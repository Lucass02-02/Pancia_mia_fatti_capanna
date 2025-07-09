<?php
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UView;
use AppORM\Entity\EProduct;
use AppORM\Services\Utility\USession;

class CHome
{
    /**
     * Gestisce la pagina principale del sito (homepage).
     */
    public static function home(): void
    {
       $userRole = USession::getValue('user_role'); 
        $data = [
            'titolo' => 'Benvenuto in Pancia mia fatti capanna!',
            'messaggio' => 'Il miglior ristorante della zona.',
            'user_role' => $userRole 
        ];
        UView::render('home', $data);
    }

    /**
     * Mostra il menù e gestisce la logica di filtro per allergeni.
     */
   public static function menu(): void
{
    // 1. Recupera i filtri per allergeni (ID interi)
    // CAMBIATO da $_GET a $_POST per le richieste POST
    $selectedAllergensIds = array_map('intval', $_POST['allergens'] ?? []); 
    
    $userRole = USession::getValue('user_role');

   // 2. Decide quali prodotti caricare in base al ruolo dell'utente
    if ($userRole === 'admin') {
        // Il proprietario vede tutti i prodotti
        $allProducts = FPersistentManager::getInstance()->getAllProducts();
    } else {
        // I clienti e i visitatori vedono solo i prodotti disponibili
        $allProducts = FPersistentManager::getInstance()->getAvailableProducts();
    }
    
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

    // 4. Passa i dati alla vista
    UView::render('menu', [
        'products' => $filteredProducts,
        'allAllergens' => $allAllergens,
        'selectedAllergens' => $selectedAllergensIds,
        'user_role' => $userRole
    ]);
}
}