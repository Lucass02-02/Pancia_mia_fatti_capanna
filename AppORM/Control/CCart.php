<?php // File: AppORM/Control/CCart.php
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
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $productId = (int) UHTTPMethods::getPostValue('product_id');
            $quantity = (int) UHTTPMethods::getPostValue('quantity', 1);
            $fromCart = UHTTPMethods::getPostValue('from_cart');

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
                            'price' => $product->getPrice(),
                            'quantity' => $quantity
                        ];
                    }

                    USession::setValue('cart', $cart);

                    if ($fromCart) {
                        // URL pulito
                        header('Location: /Pancia_mia_fatti_capanna/cart/view');
                    } else {
                        // URL pulito
                        header('Location: /Pancia_mia_fatti_capanna/home/menu');
                    }
                    exit;
                }
            }
        }
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/home/menu');
        exit;
    }
    
    public static function addAll(): void {
        if (!USession::isSet('user_id')) {
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }
        if (UHTTPMethods::isPost()) {
            $productIds = UHTTPMethods::getPostValue('product_ids', []);
            if (!empty($productIds) && is_array($productIds)) {
                $cart = USession::getValue('cart', []);
                foreach ($productIds as $productId) {
                    $product = FPersistentManager::getInstance()->getProductById((int)$productId);
                    if ($product) {
                        $pId = $product->getId();
                        if (isset($cart[$pId])) {
                            $cart[$pId]['quantity']++;
                        } else {
                            $cart[$pId] = ['product_id' => $pId, 'name' => $product->getName(), 'price' => $product->getPrice(), 'quantity' => 1];
                        }
                    }
                }
                USession::setValue('cart', $cart);
            }
        }
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/home/menu');
        exit;
    }

    public static function view(): void {
        if (!USession::isSet('user_id')) {
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }
        UView::render('cart', ['cartItems' => USession::getValue('cart', [])]);
    }

    public static function remove(): void {
        if (!USession::isSet('user_id')) {
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }
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
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/cart/view');
        exit;
    }
    
    public static function clear(): void {
        if (!USession::isSet('user_id')) {
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }
        if (UHTTPMethods::isPost()) {
            USession::setValue('cart', []);
        }
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/cart/view');
        exit;
    }
}