<?php
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;

class CAdmin
{
    public static function profile(): void
    {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }
        $adminId = USession::getValue('user_id');
        $admin = FPersistentManager::getInstance()->getAdminById($adminId);
        if ($admin) {
            UView::render('admin_profile', ['admin' => $admin]);
        } else {
            CClient::logout();
        }
    }
}