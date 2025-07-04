<?php // File: AppORM/Control/CCart.php (Modificato per reindirizzamento "add" e "remove")

namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;

class CCart
{
    /**
     * Aggiunge un singolo prodotto al carrello.
     */
    public static function add(): void
    {
        // Reindirizza al login se non loggato
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $productId = (int) UHTTPMethods::getPostValue('product_id');
            $quantity = (int) UHTTPMethods::getPostValue('quantity', 1);
            $fromCart = UHTTPMethods::getPostValue('from_cart'); // NUOVA RIGA: Verifica se proviene dal carrello

            if ($productId > 0 && $quantity > 0) {
                $product = FPersistentManager::getInstance()->getProductById($productId);

                if ($product) {
                    $cart = USession::getValue('cart', []);

                    if (isset($cart[$productId])) {
                        $cart[$productId]['quantity'] += $quantity;
                    } else {
                        $cart[$productId] = [
                            'product_id' => $productId,
                            'name' => $product->getName(),
                            'price' => $product->getCost(),
                            'quantity' => $quantity
                        ];
                    }

                    USession::setValue('cart', $cart);

                    // LOGICA DI REINDIRIZZAMENTO MODIFICATA
                    if ($fromCart) { // Se la richiesta proviene dal carrello, torna al carrello
                        header('Location: /Pancia_mia_fatti_capanna/index.php?c=cart&a=view');
                    } else { // Altrimenti (richiesta dal menù), torna al menù
                        header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
                    }
                    exit;
                }
            }
        }
        // Se non è una POST valida o il prodotto non è trovato, reindirizza al menù
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
        exit;
    }

    /**
     * Aggiunge tutti i prodotti forniti al carrello.
     */
    public static function addAll(): void
    {
        // Reindirizza al login se non loggato
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $productIds = UHTTPMethods::getPostValue('product_ids', []);

            if (!empty($productIds) && is_array($productIds)) {
                $cart = USession::getValue('cart', []);

                foreach ($productIds as $productId) {
                    $productId = (int) $productId;
                    if ($productId > 0) {
                        $product = FPersistentManager::getInstance()->getProductById($productId);
                        if ($product) {
                            if (isset($cart[$productId])) {
                                $cart[$productId]['quantity'] += 1;
                            } else {
                                $cart[$productId] = [
                                    'product_id' => $productId,
                                    'name' => $product->getName(),
                                    'price' => $product->getCost(),
                                    'quantity' => 1
                                ];
                            }
                        }
                    }
                }
                USession::setValue('cart', $cart);
                // Dopo aver aggiunto tutto, reindirizza sempre al menù
                header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
                exit;
            }
        }
        // Se non è una POST valida o non ci sono ID, torna al menù
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
        exit;
    }


    /**
     * Mostra il contenuto del carrello.
     */
    public static function view(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }
        $cart = USession::getValue('cart', []);
        UView::render('cart', ['cartItems' => $cart]);
    }

    /**
     * Rimuove un prodotto dal carrello o diminuisce la quantità.
     */
    public static function remove(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $productId = (int) UHTTPMethods::getPostValue('product_id');
            $removeOne = UHTTPMethods::getPostValue('remove_one'); // Questo campo indica se rimuovere solo una quantità

            $cart = USession::getValue('cart', []);

            if (isset($cart[$productId])) {
                if ($removeOne && $cart[$productId]['quantity'] > 1) { // Se è specificato "remove_one" e la quantità è > 1, decrementa
                    $cart[$productId]['quantity']--;
                } else { // Se quantity è 1 o se è un remove completo
                    unset($cart[$productId]);
                }
                USession::setValue('cart', $cart);
            }
        }
        // Reindirizza sempre al carrello dopo la rimozione
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=cart&a=view');
        exit;
    }
    
    /**
     * Svuota completamente il carrello.
     */
    public static function clear(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }
        
        if (UHTTPMethods::isPost()) { // Richiede POST per sicurezza
            USession::setValue('cart', []);
        }
        // Reindirizza sempre al carrello dopo aver svuotato
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=cart&a=view');
        exit;
    }
}