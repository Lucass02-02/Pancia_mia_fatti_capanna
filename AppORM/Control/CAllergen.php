<?php
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
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=allergen&a=manage');
        exit;
    }
    
    public static function delete(): void
    {
        self::checkAdmin();
        $id = (int)UHTTPMethods::getQueryValue('id');
        if ($id > 0) {
            $allergen = FPersistentManager::getInstance()->getAllergenById($id);
            if ($allergen) {
                FPersistentManager::getInstance()->deleteAllergen($allergen);
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=allergen&a=manage');
        exit;
    }
}