<?php
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;
use AppORM\Entity\EProduct;
use AppORM\Entity\EProductCategory;
use AppORM\Entity\EAllergens; 


class CProduct {

    private static function checkAdmin(): void {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/Home/home'); 
            exit;
        }
    }

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
        header('Location: /Pancia_mia_fatti_capanna/home/menu');
        exit;
    }

    /**
     * Gestisce l'aggiornamento di un prodotto esistente.
     */
    public static function update(): void {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $productId = (int)UHTTPMethods::getPostValue('product_id');
            $product = FPersistentManager::getInstance()->getProductById($productId);

            if ($product) {
                $product->setName(UHTTPMethods::getPostValue('name'));
                $product->setDescription(UHTTPMethods::getPostValue('description'));
                $product->setPrice((float)UHTTPMethods::getPostValue('price'));
                
                $categoryId = (int)UHTTPMethods::getPostValue('category_id');
                $category = FPersistentManager::getInstance()->getProductCategoryById($categoryId);
                if ($category) {
                    $product->setCategory($category);
                }

                $allergenIds = UHTTPMethods::getPostValue('allergens', []); 

                $product->clearAllergens(); 
                if (is_array($allergenIds)) {
                    foreach ($allergenIds as $allergenId) {
                        $allergen = FPersistentManager::getInstance()->getAllergenById((int)$allergenId);
                        if ($allergen) {
                            $product->addAllergen($allergen); 
                        }
                    }
                }
                
                FPersistentManager::getInstance()->saveProduct($product);
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/home/menu');
        exit;
    }
    
    /**
     * Cancella un prodotto dal database.
     * Modificato per accettare l'ID come segmento dell'URL.
     */
    public static function delete(int $id): void {
        self::checkAdmin();
        
        $product = FPersistentManager::getInstance()->getProductById($id);
        
        if ($product) {
            FPersistentManager::getInstance()->deleteProduct($product); 
        }
        
        header('Location: /Pancia_mia_fatti_capanna/home/menu');
        exit;
    }

    /**
     * Cambia lo stato di disponibilità di un prodotto.
     * Modificato per accettare l'ID come segmento dell'URL.
     */
    public static function toggleAvailability(int $id): void {
        self::checkAdmin();
        
        $product = FPersistentManager::getInstance()->getProductById($id);
        
        if ($product) {
            $newAvailability = !$product->isAvailable();
            FPersistentManager::getInstance()->updateProductAvailability($product, $newAvailability); 
        }
        
        header('Location: /Pancia_mia_fatti_capanna/home/menu');
        exit;
    }
    
    /**
     * Mostra il form per la modifica di un prodotto esistente.
     * @param int $id L'ID del prodotto da modificare.
     */
    public static function showEditForm(int $id): void {
        self::checkAdmin();
        $product = FPersistentManager::getInstance()->getProductById($id);
        
        if ($product) {
            $categories = FPersistentManager::getInstance()->getAllProductCategories();
            $allAllergens = FPersistentManager::getInstance()->getAllAllergens();

            $productAllergenIds = array_map(fn($a) => $a->getId(), $product->getAllergens()->toArray() ?? []); 

            UView::render('edit_product', [
                'product' => $product,
                'categories' => $categories,
                'allAllergens' => $allAllergens,
                'productAllergenIds' => $productAllergenIds
            ]);
        } else {
            header('Location: /Pancia_mia_fatti_capanna/home/menu');
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
            'allAllergens' => $allergens // Corretto: passato come 'allAllergens' al template
        ]);
    }

    /**
     * Mostra la pagina di gestione delle categorie di prodotto.
     */
    public static function manageCategories(): void {
        self::checkAdmin();
        $categories = FPersistentManager::getInstance()->getAllProductCategories();
        UView::render('manage_product_categories', ['categories' => $categories]);
    }

    /**
     * Gestisce la creazione di una nuova categoria di prodotto.
     */
    public static function createCategory(): void {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $categoryName = UHTTPMethods::getPostValue('name');
            if ($categoryName) {
                $newCategory = new EProductCategory($categoryName);
                FPersistentManager::getInstance()->saveProductCategory($newCategory);
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/Product/manageCategories'); 
        exit;
    }

    /**
     * Gestisce l'aggiornamento del nome di una categoria di prodotto esistente.
     */
    public static function updateCategory(): void {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $categoryId = (int)UHTTPMethods::getPostValue('category_id');
            $newName = UHTTPMethods::getPostValue('name');

            $category = FPersistentManager::getInstance()->getProductCategoryById($categoryId);
            if ($category && $newName) {
                FPersistentManager::getInstance()->updateProductCategoryName($category, $newName);
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/Product/manageCategories');
        exit;
    }

    /**
     * Gestisce la cancellazione di una categoria di prodotto.
     */
    public static function deleteCategory(int $id): void {
        self::checkAdmin();
        $category = FPersistentManager::getInstance()->getProductCategoryById($id);
        if ($category) {
            FPersistentManager::getInstance()->deleteProductCategory($category);
        }
        header('Location: /Pancia_mia_fatti_capanna/Product/manageCategories');
        exit;
    }
}