<?php
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;
use AppORM\Services\Utility\UCookie; // <-- Aggiunto

class CCart
{
    /**
     * Legge il carrello dal cookie.
     * @return array
     */
    private static function getCartFromCookie(): array
    {
        $cartJson = UCookie::get('cart');
        return $cartJson ? json_decode($cartJson, true) : [];
    }

    /**
     * Salva il carrello nel cookie.
     * @param array $cart
     */
    private static function saveCartToCookie(array $cart): void
    {
        // Salva per 30 giorni (2592000 secondi)
        UCookie::set('cart', json_encode($cart), 2592000);
    }

    public static function add(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $productId = (int) UHTTPMethods::getPostValue('product_id');
            $quantity = (int) UHTTPMethods::getPostValue('quantity', 1);
            $product = FPersistentManager::getInstance()->getProductById($productId);

            if ($product && $quantity > 0) {
                $cart = self::getCartFromCookie();

                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] += $quantity;
                } else {
                    $cart[$productId] = [
                        'product_id' => $productId,
                        'name' => $product->getName(),
                        'price' => $product->getPrice(),
                        'quantity' => $quantity
                    ];
                }
                self::saveCartToCookie($cart);
            }
        }
        
        // Reindirizza alla pagina di provenienza
        $redirectUrl = UHTTPMethods::getPostValue('from_cart') ? '/Pancia_mia_fatti_capanna/cart/view' : '/Pancia_mia_fatti_capanna/home/menu';
        header("Location: $redirectUrl");
        exit;
    }
    
    public static function view(): void 
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }
        UView::render('cart', ['cartItems' => self::getCartFromCookie()]);
    }

    public static function remove(): void 
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $productId = (int) UHTTPMethods::getPostValue('product_id');
            $removeOne = UHTTPMethods::getPostValue('remove_one');
            
            $cart = self::getCartFromCookie();

            if (isset($cart[$productId])) {
                if ($removeOne && $cart[$productId]['quantity'] > 1) {
                    $cart[$productId]['quantity']--;
                } else {
                    unset($cart[$productId]);
                }
                self::saveCartToCookie($cart);
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/cart/view');
        exit;
    }
    
    public static function clear(): void 
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            // Il modo più semplice per pulire è cancellare il cookie
            UCookie::delete('cart');
        }
        header('Location: /Pancia_mia_fatti_capanna/cart/view');
        exit;
    }
}