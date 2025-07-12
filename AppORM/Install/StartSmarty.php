<?php
namespace AppORM\Install; // O la tua namespace per le classi di installazione/configurazione

// Assicurati che Smarty sia caricato via Composer (vendor/autoload.php)
// Se per qualche motivo non lo fosse, dovresti includere Smarty.class.php qui:
// require_once 'path/to/Smarty/Smarty.class.php';

class StartSmarty {
    private static $smartyInstance = null;

    public static function configuration() {
        if (self::$smartyInstance === null) {
            // Istanzia la classe Smarty
            $smarty = new \Smarty(); // La backslash assicura che trovi la classe globale Smarty

            // --- PERCORSI DELLE CARTELLE DI SMARTY ---
            // Questi percorsi sono cruciali. Modificali in base alla tua struttura.
            // Il percorso deve essere dalla ROOT del tuo progetto (dove c'è index.php).
            // Esempio: se i tuoi template .tpl stanno in una cartella 'templates' alla root:
            // $smarty->setTemplateDir(__DIR__ . '/../../templates/');

            // Basandomi sulla tua struttura dei controller (AppORM/Control) e UView (AppORM/Services/Utility),
            // assumo che i template saranno in una cartella 'templates' o 'views' a livello della root del progetto.
            // Oppure, potresti volerli mettere in 'AppORM/View/'.
            // Scegli uno di questi percorsi o adattalo al tuo:
            // Opzione 1: Cartella 'View' alla root del progetto (vicino a index.php)
            $smarty->setTemplateDir(__DIR__ . '/../../../View/'); // Percorso da AppORM/install/ a View/
            
            // Opzione 2: Cartella 'AppORM/View' (se le tue view sono qui)
            // $smarty->setTemplateDir(__DIR__ . '/../View/'); // Percorso da AppORM/install/ a AppORM/View/

            // --- Cartelle di output di Smarty (devono essere scrivibili dal server web!) ---
            // Crea queste cartelle se non esistono (es. /var/templates_c e /var/cache_smarty)
            $smarty->setCompileDir(__DIR__ . '/../../../var/templates_c/');
            $smarty->setCacheDir(__DIR__ . '/../../../var/cache_smarty/');

            // --- IMPOSTAZIONI SMARTY AGGIUNTIVE ---
            $smarty->debugging = true; // Imposta a TRUE in sviluppo per la console di debug di Smarty (molto utile!)
            $smarty->caching = false;  // Imposta a FALSE in sviluppo, TRUE in produzione
            $smarty->error_reporting = E_ALL & ~E_NOTICE; // Controlla gli errori PHP nei template
            $smarty->escape_html = true; // Abilita l'escaping HTML automatico per sicurezza (FORTEMENTE CONSIGLIATO)

            self::$smartyInstance = $smarty;
        }
        return self::$smartyInstance;
    }
}