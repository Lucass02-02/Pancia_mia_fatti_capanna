<?php // File: AppORM/Control/CHome.php
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager; // Aggiungiamo il PersistentManager
use AppORM\Services\Utility\UView;

class CHome
{
    public static function home(): void {
        // ... questo metodo rimane invariato ...
        $data = ['titolo' => 'Benvenuto in Pancia mia fatti capanna!', 'messaggio' => 'Il miglior ristorante della zona.'];
        UView::render('home', $data);
    }

    /**
     * METODO MODIFICATO
     * Mostra il menù del ristorante recuperando i dati dal database.
     */
    public static function menu(): void
    {
        // Recuperiamo tutti i prodotti usando il nostro nuovo metodo
        $products = FPersistentManager::getAllProducts();

        // Passiamo la lista dei prodotti alla vista 'menu.php'
        UView::render('menu', ['products' => $products]);
    }
}
