<?php // File: AppORM/Control/CAllergen.php
namespace AppORM\Control;

use AppORM\Entity\EAllergens;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;


class CAllergen
{
    private static function checkAdmin(): void {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }
    }

    public static function manage(): void
    {
        self::checkAdmin();
        $allergens = FPersistentManager::getInstance()->getAllAllergens();
        UView::render('manage_allergens', ['allergens' => $allergens]);
    }

    public static function create(): void
    {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $name = UHTTPMethods::getPostValue('name');
            if ($name) {
                $allergen = new EAllergens($name);
                FPersistentManager::getInstance()->saveAllergen($allergen);
            }
        }
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/allergen/manage');
        exit;
    }
    
    // Modificato per accettare l'ID come segmento dell'URL
    public static function delete(int $id): void
    {
        self::checkAdmin();
        if ($id > 0) {
            $allergen = FPersistentManager::getInstance()->getAllergenById($id);
            if ($allergen) {
                FPersistentManager::getInstance()->deleteAllergen($allergen);
            }
        }
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/allergen/manage');
        exit;
    }
}