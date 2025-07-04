<?php // File: AppORM/Control/CReview.php
namespace AppORM\Control;

use AppORM\Services\Foundation\FUserReview;
use AppORM\Services\Utility\UView;

class CReview 
{
    /**
     * Recupera tutte le recensioni da tutti gli utenti e le mostra in una pagina.
     */
    public static function showAll(): void
    {
        // 1. Recupera tutte le recensioni usando il metodo creato al Passo 1
        $allReviews = FUserReview::fetchAll();

        // 2. Passa l'array di recensioni alla vista per la visualizzazione
        UView::render('all_reviews', [
            'reviews' => $allReviews,
            'titolo' => 'Tutte le Recensioni'
        ]);
    }

}