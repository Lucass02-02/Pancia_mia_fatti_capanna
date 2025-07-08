<?php
// File: AppORM/Views/VClient.php (COMPLETO)
namespace AppORM\Views;

use AppORM\Entity\EClient;

class VClient
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = StartSmarty::configuration();
    }

    public function showLoginForm(?string $error = null, ?string $success = null)
    {
        $this->smarty->assign('error', $error);
        $this->smarty->assign('success', $success);
        $this->smarty->display('login.tpl');
    }

    public function showRegistrationForm(?string $error = null)
    {
        $this->smarty->assign('error', $error);
        $this->smarty->display('registration.tpl');
    }

    public function showProfile(EClient $client)
    {
        $this->smarty->assign('client', $client);
        $this->smarty->assign('reviews', $client->getReviews());
        $this->smarty->assign('creditCards', $client->getCreditCards());
        $this->smarty->display('profile.tpl');
    }

    public function showAddReviewForm(?string $error = null)
    {
        $this->smarty->assign('error', $error);
        $this->smarty->display('add_review.tpl');
    }

    // Aggiungi qui il metodo per la vista add_credit_card se necessario
}