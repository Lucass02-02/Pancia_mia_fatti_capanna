<?php
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;
use AppORM\Entity\EProduct;
use AppORM\Entity\ECategory; // Assicurati di importare ECategory se non lo è già
use AppORM\Entity\EAllergen; // Assicurati di importare EAllergen se non lo è già

class CProduct {

    private static function checkAdmin(): void {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/Home/home'); // Reindirizza a home per non admin
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
            $allergenIds = UHTTPMethods::getPostValue('allergens', []); // Il secondo parametro [] è utile se non ci sono allergeni

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
                
                // --- Gestione della categoria ---
                $categoryId = (int)UHTTPMethods::getPostValue('category_id');
                $category = FPersistentManager::getInstance()->getProductCategoryById($categoryId);
                if ($category) {
                    $product->setCategory($category);
                }

                // --- Gestione degli allergeni ---
                $allergenIds = UHTTPMethods::getPostValue('allergens', []); // Ottieni gli ID degli allergeni selezionati

                // Assumi che EProduct abbia un metodo clearAllergens() e addAllergen()
                // Se non ce l'ha, dovrai implementarlo nella tua entità EProduct
                $product->clearAllergens(); // Rimuovi tutti gli allergeni attuali
                if (is_array($allergenIds)) {
                    foreach ($allergenIds as $allergenId) {
                        $allergen = FPersistentManager::getInstance()->getAllergenById((int)$allergenId);
                        if ($allergen) {
                            $product->addAllergen($allergen); // Aggiungi solo quelli selezionati
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
        // L'ID viene passato come parametro della funzione, non da query GET
        $product = FPersistentManager::getInstance()->getProductById($id);
        
        if ($product) {
            FPersistentManager::getInstance()->deleteProduct($product); // Presumo che questo elimini l'oggetto EProduct
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
        // L'ID viene passato come parametro della funzione, non da query GET
        $product = FPersistentManager::getInstance()->getProductById($id);
        
        if ($product) {
            $newAvailability = !$product->isAvailable();
            // Assumo che FPersistentManager::updateProductAvailability() esista e salvi lo stato
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
        // L'ID viene passato come parametro della funzione, non da query GET
        $product = FPersistentManager::getInstance()->getProductById($id);
        
        if ($product) {
            $categories = FPersistentManager::getInstance()->getAllProductCategories();
            $allAllergens = FPersistentManager::getInstance()->getAllAllergens();
            // Estrai gli ID degli allergeni già associati al prodotto
            // Assumi che $product->getAllergens() restituisca un array di oggetti EAllergen o null
            $productAllergenIds = array_map(fn($a) => $a->getId(), $product->getAllergens() ?? []);

            UView::render('edit_product', [
                'product' => $product,
                'categories' => $categories,
                'allAllergens' => $allAllergens, // Passa tutti gli allergeni per i checkbox
                'productAllergenIds' => $productAllergenIds // Passa gli ID degli allergeni del prodotto per pre-selezionare
            ]);
        } else {
            // Prodotto non trovato, reindirizza al menu
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
}