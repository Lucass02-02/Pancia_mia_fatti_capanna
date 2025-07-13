<?php
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UView;
use AppORM\Entity\EProduct; // Importiamo EProduct per il type hinting
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UCookie;
use AppORM\Services\Utility\UHTTPMethods;

class CHome
{
    /**
     * Gestisce la pagina principale del sito (homepage).
     */
    public static function home(): void
    {
        if (USession::getValue('redirect_page') !== null) {
            USession::setValue('redirect_page', null);
        }
        $userRole = USession::getValue('user_role');
        $data = [
            'titolo' => 'Benvenuto in Pancia mia fatti capanna!',
            'messaggio' => 'Il miglior ristorante della zona.',
            'user_role' => $userRole
        ];
        
        UView::render('home', $data);
    }

    public static function menu(): void
    {
        $selectedAllergensIds = [];

        // Se clicca Rimuovi Filtro
        if (isset($_POST['remove_filter'])) {
            UCookie::delete('allergen_filter');
            header('Location: /Pancia_mia_fatti_capanna/Home/menu');
            exit;
        }

        // Se invia nuovi allergeni
        if (isset($_POST['allergens'])) {
            $selectedAllergensIds = array_map('intval', $_POST['allergens']);
            UCookie::set('allergen_filter', json_encode($selectedAllergensIds), 604800);
        }

        // Se esiste cookie e non c'è nuovo POST allergens
        if (empty($selectedAllergensIds) && UCookie::get('allergen_filter')) {
            $selectedAllergensIds = json_decode(UCookie::get('allergen_filter'), true);
        }

        // Recupera dati
        $userRole = USession::getValue('user_role');
        $userId = USession::getValue('user_id');

        $allProducts = ($userRole === 'admin')
            ? FPersistentManager::getInstance()->getAllProducts()
            : FPersistentManager::getInstance()->getAvailableProducts();

        $allAllergens = FPersistentManager::getInstance()->getAllAllergens();

        // Filtra prodotti
        $filteredProducts = array_filter($allProducts, function($product) use ($selectedAllergensIds) {
            foreach ($product->getAllergens() as $allergen) {
                if (in_array($allergen->getId(), $selectedAllergensIds)) {
                    return false;
                }
            }
            return true;
        });

        UView::render('menu', [
            'products' => $filteredProducts,
            'allAllergens' => $allAllergens,
            'selectedAllergens' => $selectedAllergensIds,
            'user_role' => $userRole,
            'user_id' => $userId,
        ]);
    }
}