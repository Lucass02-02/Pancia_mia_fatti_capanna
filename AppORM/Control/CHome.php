<?php
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UView;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UCookie; // <-- Aggiunto

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
     * Mostra il menù e gestisce la logica di filtro per allergeni usando i cookie.
     */
    public static function menu(): void
    {
        $selectedAllergensIds = [];

        // Se l'utente invia un nuovo filtro, usalo e salva il cookie
        if (isset($_POST['allergens'])) {
            $selectedAllergensIds = array_map('intval', $_POST['allergens']);
            // Salva gli ID come stringa JSON nel cookie per 1 settimana (604800 secondi)
            UCookie::set('allergen_filter', json_encode($selectedAllergensIds), 604800);
        }
        // Altrimenti, se non c'è un invio POST, prova a leggere dal cookie
        elseif (UCookie::get('allergen_filter')) {
            // Decodifica la stringa JSON salvata nel cookie
            $selectedAllergensIds = json_decode(UCookie::get('allergen_filter'), true);
        }

        $userRole = USession::getValue('user_role');
        $userId = USession::getValue('user_id');

        if ($userRole === 'admin') {
            $allProducts = FPersistentManager::getInstance()->getAllProducts();
        } else {
            $allProducts = FPersistentManager::getInstance()->getAvailableProducts();
        }

        $allAllergens = FPersistentManager::getInstance()->getAllAllergens();

        if (empty($selectedAllergensIds)) {
            $filteredProducts = $allProducts;
        } else {
            $filteredProducts = [];
            foreach ($allProducts as $product) {
                $hasExcludedAllergen = false;
                foreach ($product->getAllergens() as $allergen) {
                    if (in_array($allergen->getId(), $selectedAllergensIds)) {
                        $hasExcludedAllergen = true;
                        break;
                    }
                }
                if (!$hasExcludedAllergen) {
                    $filteredProducts[] = $product;
                }
            }
        }

        UView::render('menu', [
            'products' => $filteredProducts,
            'allAllergens' => $allAllergens,
            'selectedAllergens' => $selectedAllergensIds,
            'user_role' => $userRole,
            'user_id' => $userId,
        ]);
    }
}