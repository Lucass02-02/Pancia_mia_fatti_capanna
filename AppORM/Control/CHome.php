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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Se clicca Rimuovi Filtro
        if (isset($_POST['remove_filter'])) {
            UCookie::delete('allergen_filter');
            header('Location: /Pancia_mia_fatti_capanna/Home/menu');
            exit;
        }

        // Se invia allergeni
        if (isset($_POST['allergens'])) {
            $selectedAllergensIds = array_map('intval', $_POST['allergens']);
            UCookie::set('allergen_filter', json_encode($selectedAllergensIds), 604800);
        }
    }

    // Se esiste cookie e nessun POST allergens
    if (empty($selectedAllergensIds) && UCookie::get('allergen_filter')) {
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

    // Filtra prodotti
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