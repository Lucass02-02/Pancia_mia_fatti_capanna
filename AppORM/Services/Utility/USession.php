<?php // File: AppORM/Services/Utility/USession.php

namespace AppORM\Services\Utility;

/**
 * Classe di utilità per la gestione delle sessioni PHP.
 * Fornisce un wrapper attorno all'array superglobale $_SESSION.
 */
class USession
{
    /**
     * Avvia la sessione se non è già attiva.
     * È fondamentale chiamare questo metodo all'inizio di ogni script
     * che deve accedere ai dati di sessione.
     */
    public static function start(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Distrugge la sessione corrente.
     * Utile per implementare la funzionalità di logout.
     */
    public static function destroy(): void
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_unset(); // Rimuove tutte le variabili di sessione
            session_destroy(); // Distrugge la sessione
        }
    }

    /**
     * Imposta un valore nella sessione.
     *
     * @param string $key La chiave con cui salvare il valore.
     * @param mixed $value Il valore da salvare.
     */
    public static function setValue(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Recupera un valore dalla sessione.
     *
     * @param string $key La chiave del valore da recuperare.
     * @return mixed|null Il valore se presente, altrimenti null.
     */
    public static function getValue(string $key): mixed
    {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    /**
     * Verifica se una chiave è impostata nella sessione.
     *
     * @param string $key La chiave da verificare.
     * @return bool True se la chiave esiste, altrimenti false.
     */
    public static function isSet(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    /**
     * Rimuove una chiave e il suo valore dalla sessione.
     *
     * @param string $key La chiave da rimuovere.
     */
    public static function unsetValue(string $key): void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}