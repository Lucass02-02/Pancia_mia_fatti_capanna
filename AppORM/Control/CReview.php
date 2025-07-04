<?php // File: AppORM/Control/CReview.php

namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UView;

class CReview 
{
    /**
     * Recupera tutte le recensioni da tutti gli utenti e le mostra in una pagina.
     */
    public static function showAll(): void
    {
        // 1. Usa il metodo appena aggiunto a FPersistentManager.
        // In questo modo, il controller rispetta la regola di usare solo il manager.
        $allReviews = FPersistentManager::getInstance()->getAllReviews();

        // 2. Passa l'array di recensioni alla vista per la visualizzazione.
        UView::render('all_reviews', [
            'reviews' => $allReviews,
            'titolo' => 'Tutte le Recensioni'
        ]);
    }
}