<?php
// File: AppORM/Views/StartSmarty.php (AGGIORNATO)
namespace AppORM\Views;

use AppORM\Services\Utility\UUrl; // Importa la nuova classe
use Smarty\Smarty;

class StartSmarty
{
    public static function configuration(): Smarty
    {
        $smarty = new Smarty();

        $smarty->setTemplateDir(__DIR__ . '/../../templates/');
        $smarty->setCompileDir(__DIR__ . '/../../templates_c/');
        $smarty->setCacheDir(__DIR__ . '/../../cache/');
        $smarty->setConfigDir(__DIR__ . '/../../configs/');
        $smarty->caching = false;

        // --- RIGA AGGIUNTA ---
        // Registra la funzione 'url' e la collega al metodo UUrl::C
        $smarty->registerPlugin('function', 'url', [UUrl::class, 'C']);

        return $smarty;
    }
}