<?php // File: AppORM/Control/CReview.php


namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UView;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UHTTPMethods;
use DateTime;
use AppORM\Entity\EUserReview; 
use AppORM\Entity\EAdminResponse; 

class CReview
{
   

    public static function showAll(): void
    {
        $userRole = USession::getValue('user_role');
        $allReviews = FPersistentManager::getInstance()->getAllReviews();

        UView::render('all_reviews', [
            'reviews' => $allReviews,
            'titolo' => 'Tutte le Recensioni',
            'user_role' => $userRole
        ]);
    }



    /**
     * Gestisce l'invio di una risposta da parte di un amministratore.
     */
    public static function respond(): void
    {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $reviewId = (int)UHTTPMethods::getPostValue('review_id');
            $responseText = UHTTPMethods::getPostValue('response_text');
            $adminId = USession::getValue('user_id');

            if ($reviewId > 0 && !empty($responseText) && $adminId > 0) {
                $review = FPersistentManager::getInstance()->getReviewById($reviewId);
                $admin = FPersistentManager::getInstance()->getAdminById($adminId);

                if ($review && $admin) {
                    FPersistentManager::getInstance()->addAdminResponseToReview($admin, $review, $responseText);
                }
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/review/showAll');
        exit;
    }

    /**
     * Elimina una risposta specifica dell'amministratore.
     */
    public static function deleteAdminResponse(int $id): void
    {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }

        if ($id > 0) {
            $adminResponseToDelete = FPersistentManager::getInstance()->getAdminResponseById($id);

            if ($adminResponseToDelete) {
                FPersistentManager::getInstance()->deleteAdminResponse($adminResponseToDelete);
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/review/showAll');
        exit;
    }

   
    

    /**
     * Mostra il form per modificare una risposta dell'amministratore esistente.
     */
    public static function editAdminResponse(int $id): void
    {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }

        $adminResponse = FPersistentManager::getInstance()->getAdminResponseById($id);

        if ($adminResponse) {
            UView::render('edit_admin_response', [
                'adminResponse' => $adminResponse,
                'titolo' => 'Modifica Risposta Admin'
            ]);
        } else {
            header('Location: /Pancia_mia_fatti_capanna/review/showAll');
            exit;
        }
    }

    /**
     * Gestisce l'invio del form di modifica di una risposta dell'amministratore.
     */
    public static function updateAdminResponseComment(): void
    {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $responseId = (int)UHTTPMethods::getPostValue('response_id');
            $newResponseText = UHTTPMethods::getPostValue('response_text');

            if ($responseId > 0 && $newResponseText !== null) {
                $adminResponse = FPersistentManager::getInstance()->getAdminResponseById($responseId);

                if ($adminResponse) {
                    $adminResponse->setResponseText($newResponseText);
                    FPersistentManager::getInstance()->updateAdminResponse($adminResponse); 
                }
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/review/showAll');
        exit;
    }
    
}