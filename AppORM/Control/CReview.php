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
    /**
     * Elimina una recensione. Accessibile solo agli amministratori.
     */
    public static function delete(): void
    {
        // Sicurezza: solo gli admin possono eliminare
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $reviewId = (int)UHTTPMethods::getPostValue('review_id');
            if ($reviewId > 0) {
                // Si assume che esista un metodo deleteReview() nel FPersistentManager
                FPersistentManager::getInstance()->deleteReview($reviewId);
            }
        }

        // Reindirizza alla pagina con tutte le recensioni
        header('Location: /Pancia_mia_fatti_capanna/review/showAll');
        exit;
    }
}