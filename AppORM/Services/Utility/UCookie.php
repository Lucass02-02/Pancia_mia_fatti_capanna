<?php // File: AppORM/Services/Utility/UCookie.php

namespace AppORM\Services\Utility;

/**
 * Classe di utilità per la gestione dei cookie.
 * Semplifica l'impostazione, la lettura e la cancellazione dei cookie.
 */
class UCookie
{
    /**
     * Imposta un cookie.
     *
     * @param string $name Il nome del cookie.
     * @param string $value Il valore del cookie.
     * @param int $expire La data di scadenza del cookie (timestamp Unix). Default: 1 ora.
     * @param string $path Il percorso sul server in cui il cookie sarà disponibile.
     */
    public static function set(string $name, string $value, int $expire = 3600, string $path = '/'): void
    {
        // L'ora corrente + il tempo di scadenza in secondi
        setcookie($name, $value, time() + $expire, $path);
    }

    /**
     * Recupera il valore di un cookie.
     *
     * @param string $name Il nome del cookie.
     * @return string|null Il valore del cookie se esiste, altrimenti null.
     */
    public static function get(string $name): ?string
    {
        return $_COOKIE[$name] ?? null;
    }

    /**
     * Cancella un cookie.
     * Per cancellare un cookie, lo si imposta con una data di scadenza nel passato.
     *
     * @param string $name Il nome del cookie da cancellare.
     * @param string $path Il percorso del cookie.
     */
    public static function delete(string $name, string $path = '/'): void
    {
        if (isset($_COOKIE[$name])) {
            // Imposta il cookie con lo stesso nome ma con un timestamp nel passato
            setcookie($name, '', time() - 3600, $path);
            unset($_COOKIE[$name]);
        }
    }
}