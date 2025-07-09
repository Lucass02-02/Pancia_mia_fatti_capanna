<?php // File: AppORM/Control/CHome.php 

namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UView;
use AppORM\Entity\EProduct; // Importiamo EProduct per il type hinting
use AppORM\Services\Utility\USession;

class CHome
{
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
     * Mostra il menù e gestisce la logica di filtro per allergeni in PHP.
     */
    public static function menu(): void
    {
        // 1. Recuperiamo i filtri scelti dall'utente (se ci sono)
        $selectedAllergens = array_map('intval', $_GET['allergens'] ?? []);
        
        // 2. Carichiamo SEMPRE tutti i prodotti dal database
        $allProducts = FPersistentManager::getInstance()->getAllProducts();
        $filteredProducts = [];

        // 3. Se l'utente ha scelto dei filtri, filtriamo la lista in PHP
        if (!empty($selectedAllergens)) {
            /** @var EProduct $product */
            foreach ($allProducts as $product) {
                $productHasAllergen = false;
                // Controlliamo ogni allergene del prodotto
                foreach ($product->getAllergens() as $allergen) {
                    // Se l'ID dell'allergene del prodotto è nella lista di quelli da escludere...
                    if (in_array($allergen->getId(), $selectedAllergens)) {
                        $productHasAllergen = true; // ...marchiamo questo prodotto come "da non mostrare"
                        break; // Non serve controllare gli altri allergeni di questo prodotto
                    }
                }

                // Se il prodotto NON ha nessuno degli allergeni da escludere, lo aggiungiamo alla lista finale.
                if (!$productHasAllergen) {
                    $filteredProducts[] = $product;
                }
            }
        } else {
            // Se non ci sono filtri, la lista finale è semplicemente la lista completa
            $filteredProducts = $allProducts;
        }

        // 4. Recuperiamo tutti gli allergeni da mostrare come checkbox
        $allAllergens = FPersistentManager::getInstance()->getAllAllergens();

        // 5. Passiamo i dati (la lista filtrata) alla vista
        UView::render('menu', [
            'products' => $filteredProducts,
            'allAllergens' => $allAllergens,
            'selectedAllergens' => $selectedAllergens
        ]);
    }
}