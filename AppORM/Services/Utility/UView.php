<?php // File: AppORM/Services/Utility/UView.php

namespace AppORM\Services\Utility;
require __DIR__. '/../../../startsmarty.php';

use StartSmarty;
/**
 * Classe di utilità per la gestione delle viste (template HTML/PHP).
 * Permette di separare la logica del controller dalla presentazione.
 */
class UView
{
    /**
     * Renderizza una vista, passandole dei dati.
     *
     * @param string $viewName Il nome del file della vista (senza estensione .php).
     * @param array $data Un array associativo di dati da rendere disponibili alla vista.
     * La chiave di ogni elemento diventerà una variabile nella vista.
     */
    public static function render(string $viewName , array $data = []): void
    {
        // Inizializza Smarty
        $smarty = StartSmarty::configuration(); 
        foreach ($data as $key => $value) {
            // Assegna ogni elemento dell'array come variabile Smarty
            $smarty->assign($key, $value);
        }
    
        // Definisce il percorso base per le viste.
        // Assumiamo che le viste si trovino in una cartella 'View' alla radice del progetto.
        // Modifica questo percorso se la tua struttura è diversa.
        $viewPath = __DIR__ . '/../../../libs/Smarty/templates/' . $viewName . '.tpl';

        if (file_exists($viewPath)) {
            // L'output buffering cattura tutto l'output (echo, HTML)
            // senza inviarlo subito al browser.
            ob_start();
            
            // Include il file della vista. Le variabili create con extract()
            // saranno disponibili qui dentro.
            $smarty->display($viewPath);

            // Pulisce (svuota) il buffer di output e lo disattiva.
            ob_end_flush();
        } else {
            // Se la vista non esiste, mostra un errore.
            // In un'applicazione reale, qui potresti mostrare una pagina 404.
            echo "Errore: Vista non trovata a: " . $viewPath;
        }
    }
}
