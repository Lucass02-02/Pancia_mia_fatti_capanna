<?php // File: AppORM/Services/Utility/UHTTPMethods.php

namespace AppORM\Services\Utility;

/**
 * Classe di utilità per gestire i dati provenienti dalle richieste HTTP (GET, POST).
 */ 
class UHTTPMethods
{
    /**
     * Verifica se la richiesta corrente è di tipo POST.
     *
     * @return bool True se è una richiesta POST, altrimenti false.
     */
    public static function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Verifica se la richiesta corrente è di tipo GET.
     *
     * @return bool True se è una richiesta GET, altrimenti false.
     */
    public static function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * Recupera un valore dall'array $_POST.
     *
     * @param string $key La chiave del valore da recuperare.
     * @return mixed|null Il valore se presente, altrimenti null.
     */
    public static function getPostValue(string $key): mixed
    {
        return $_POST[$key] ?? null;
    }

    /**
     * Setta un valore dell'array $_POST
     * 
     * @param string $key La chiave del valore da settare
     * @param mixed $value Il valore da salvare.
     */
    public static function setPostValue(string $key, mixed $value ) {
        $_POST[$key] = $value;
    }


    /**
     * Recupera un valore dall'array $_GET (query string).
     *
     * @param string $key La chiave del valore da recuperare.
     * @return mixed|null Il valore se presente, altrimenti null.
     */
    public static function getQueryValue(string $key): mixed
    {
        return $_GET[$key] ?? null;
    }
}