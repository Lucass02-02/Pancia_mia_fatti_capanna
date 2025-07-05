<?php
// File: AppORM/Control/CProduct.php (CON LA LOGICA MANCANTE)
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;
use AppORM\Entity\EProduct;

class CProduct {

    private static function checkAdmin(): void {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }
    }

    // --- Questo metodo è corretto e non va toccato ---
    public static function create(): void {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $name = UHTTPMethods::getPostValue('name');
            $description = UHTTPMethods::getPostValue('description');
            $price = (float)UHTTPMethods::getPostValue('price');
            $categoryId = (int)UHTTPMethods::getPostValue('category_id');
            $allergenIds = UHTTPMethods::getPostValue('allergens', []);

            if ($name && $description && $price > 0 && $categoryId > 0) {
                $category = FPersistentManager::getInstance()->getProductCategoryById($categoryId);
                if ($category) {
                    $product = new EProduct($name, $description, $price, $category);
                    foreach ($allergenIds as $allergenId) {
                        $allergen = FPersistentManager::getInstance()->getAllergenById((int)$allergenId);
                        if ($allergen) {
                            $product->addAllergen($allergen);
                        }
                    }
                    FPersistentManager::getInstance()->saveProduct($product);
                }
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
        exit;
    }

    // --- La logica mancante viene aggiunta qui sotto ---

    /**
     * COMPLETATO: Gestisce l'aggiornamento di un prodotto esistente.
     */
    public static function update(): void {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $productId = (int)UHTTPMethods::getPostValue('product_id');
            $product = FPersistentManager::getInstance()->getProductById($productId);

            if ($product) {
                // Aggiorna l'oggetto EProduct con i nuovi dati dal form
                $product->setName(UHTTPMethods::getPostValue('name'));
                $product->setDescription(UHTTPMethods::getPostValue('description'));
                $product->setPrice((float)UHTTPMethods::getPostValue('price'));
                
                // TODO: Gestire la modifica di categoria e allergeni se necessario
                
                // Salva le modifiche nel database
                FPersistentManager::getInstance()->saveProduct($product);
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
        exit;
    }
    
    /**
     * COMPLETATO: Cancella un prodotto dal database.
     */
    public static function delete(): void {
        self::checkAdmin();
        $productId = (int)UHTTPMethods::getQueryValue('id');
        $product = FPersistentManager::getInstance()->getProductById($productId);
        
        if ($product) {
            // Cancella il prodotto dal database
            FPersistentManager::getInstance()->deleteProduct($product);
        }
        
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
        exit;
    }

    /**
     * COMPLETATO: Cambia lo stato di disponibilità di un prodotto.
     */
    public static function toggleAvailability(): void {
        self::checkAdmin();
        $productId = (int)UHTTPMethods::getQueryValue('id');
        $product = FPersistentManager::getInstance()->getProductById($productId);
        
        if ($product) {
            // Inverte lo stato di disponibilità attuale
            $newAvailability = !$product->isAvailable();
            // Aggiorna il prodotto nel database
            FPersistentManager::getInstance()->updateProductAvailability($product, $newAvailability);
        }
        
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
        exit;
    }
    
    // Il metodo per mostrare il form di modifica è corretto
    public static function showEditForm(): void {
        self::checkAdmin();
        $productId = (int)UHTTPMethods::getQueryValue('id');
        $product = FPersistentManager::getInstance()->getProductById($productId);
        if ($product) {
            $categories = FPersistentManager::getInstance()->getAllProductCategories();
            UView::render('edit_product', ['product' => $product, 'categories' => $categories]);
        } else {
            header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
            exit;
        }
    }
    
    // Il metodo per mostrare il form di creazione è corretto
    public static function showCreateForm(): void {
        self::checkAdmin();
        $categories = FPersistentManager::getInstance()->getAllProductCategories();
        $allergens = FPersistentManager::getInstance()->getAllAllergens();
        UView::render('create_product', [
            'categories' => $categories,
            'allAllergens' => $allergens
        ]);
    }
}