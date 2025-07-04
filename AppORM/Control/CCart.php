<?php
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;

class CCart
{
    public static function add(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $productId = (int) UHTTPMethods::getPostValue('product_id');
            $quantity = (int) UHTTPMethods::getPostValue('quantity', 1);
            $fromCart = UHTTPMethods::getPostValue('from_cart');

            if ($productId > 0 && $quantity > 0) {
                $product = FPersistentManager::getProductById($productId);

                if ($product) {
                    $cart = USession::getValue('cart', []);

                    if (isset($cart[$productId])) {
                        $cart[$productId]['quantity'] += $quantity;
                    } else {
                        $cart[$productId] = [
                            'product_id' => $productId,
                            'name' => $product->getName(),
<<<<<<< Updated upstream
                            'price' => $product->getPrice(),
=======
                            // ***** CORREZIONE QUI *****
                            // Il metodo corretto è getPrice(), non getCost()
                            'price' => $product->getPrice(), //
>>>>>>> Stashed changes
                            'quantity' => $quantity
                        ];
                    }

                    USession::setValue('cart', $cart);

<<<<<<< Updated upstream
                    // LOGICA DI REINDIRIZZAMENTO MODIFICATA
                    if ($fromCart) { // Se la richiesta proviene dal carrello, torna al carrello
                        header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=cart&a=view');
                    } else { // Altrimenti (richiesta dal menù), torna al menù
                        header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
=======
                    if ($fromCart) {
                        header('Location: /Pancia_mia_fatti_capanna/index.php?c=cart&a=view');
                    } else {
                        header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
>>>>>>> Stashed changes
                    }
                    exit;
                }
            }
        }
<<<<<<< Updated upstream
        // Se non è una POST valida o il prodotto non è trovato, reindirizza al menù
        header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
        exit;
    }

    /**
     * Aggiunge tutti i prodotti forniti al carrello.
     */
    public static function addAll(): void
    {
        // Reindirizza al login se non loggato
        if (!USession::isSet('user_id')) {
            header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }

=======
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
        exit;
    }
    
    // Il resto dei metodi (addAll, view, remove, clear) sono corretti e rimangono invariati.
    // Li includo per completezza, assicurandomi che anche loro usino getPrice().
    
    public static function addAll(): void {
        if (!USession::isSet('user_id')) { header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login'); exit; }
>>>>>>> Stashed changes
        if (UHTTPMethods::isPost()) {
            $productIds = UHTTPMethods::getPostValue('product_ids', []);
            if (!empty($productIds) && is_array($productIds)) {
                $cart = USession::getValue('cart', []);
                foreach ($productIds as $productId) {
<<<<<<< Updated upstream
                    $productId = (int) $productId;
                    if ($productId > 0) {
                        $product = FPersistentManager::getProductById($productId);
                        if ($product) {
                            if (isset($cart[$productId])) {
                                $cart[$productId]['quantity'] += 1;
                            } else {
                                $cart[$productId] = [
                                    'product_id' => $productId,
                                    'name' => $product->getName(),
                                    'price' => $product->getPrice(),
                                    'quantity' => 1
                                ];
                            }
=======
                    $product = FPersistentManager::getInstance()->getProductById((int)$productId);
                    if ($product) {
                        $pId = $product->getId();
                        if (isset($cart[$pId])) {
                            $cart[$pId]['quantity']++;
                        } else {
                            $cart[$pId] = ['product_id' => $pId, 'name' => $product->getName(), 'price' => $product->getPrice(), 'quantity' => 1];
>>>>>>> Stashed changes
                        }
                    }
                }
                USession::setValue('cart', $cart);
<<<<<<< Updated upstream
                // Dopo aver aggiunto tutto, reindirizza sempre al menù
                header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
                exit;
            }
        }
        // Se non è una POST valida o non ci sono ID, torna al menù
        header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
        exit;
    }


    /**
     * Mostra il contenuto del carrello.
     */
    public static function view(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=login');
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
            header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }

=======
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=home&a=menu');
        exit;
    }

    public static function view(): void {
        if (!USession::isSet('user_id')) { header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login'); exit; }
        UView::render('cart', ['cartItems' => USession::getValue('cart', [])]);
    }

    public static function remove(): void {
        if (!USession::isSet('user_id')) { header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login'); exit; }
>>>>>>> Stashed changes
        if (UHTTPMethods::isPost()) {
            $productId = (int) UHTTPMethods::getPostValue('product_id');
            $removeOne = UHTTPMethods::getPostValue('remove_one');
            $cart = USession::getValue('cart', []);
            if (isset($cart[$productId])) {
                if ($removeOne && $cart[$productId]['quantity'] > 1) {
                    $cart[$productId]['quantity']--;
                } else {
                    unset($cart[$productId]);
                }
                USession::setValue('cart', $cart);
            }
        }
<<<<<<< Updated upstream
        // Reindirizza sempre al carrello dopo la rimozione
        header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=cart&a=view');
        exit;
    }
    
    /**
     * Svuota completamente il carrello.
     */
    public static function clear(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }
        
        if (UHTTPMethods::isPost()) { // Richiede POST per sicurezza
            USession::setValue('cart', []);
        }
        // Reindirizza sempre al carrello dopo aver svuotato
        header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=cart&a=view');
=======
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=cart&a=view');
        exit;
    }
    
    public static function clear(): void {
        if (!USession::isSet('user_id')) { header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login'); exit; }
        if (UHTTPMethods::isPost()) {
            USession::setValue('cart', []);
        }
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=cart&a=view');
>>>>>>> Stashed changes
        exit;
    }
}