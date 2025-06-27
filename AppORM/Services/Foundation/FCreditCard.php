<?php
// PHP Version: 8.1+

namespace App\Foundation;

use AppORM\Entity\ECreditCard; // Importa l'entità
use AppORM\Entity\EClient;    // Importa EClient per i type hint
use App\Foundation\FEntityManager; // Importa FEntityManager

class FCreditCard {
    private static string $table = "AppORM\\Entity\\ECreditCard"; // Aggiunto per consistenza
    private static string $key = "idCard"; // Aggiunto per consistenza

    public static function getTable(): string
    {
        return self::$table;
    }

    public static function getKey(): string
    {
        return self::$key;
    }

    public static function getClass(): string
    {
        return self::class;
    }

    public static function getCreditCardById(int $idCreditCard): ?ECreditCard {
        $results = FEntityManager::getInstance()->retriveObject(self::getTable(), $idCreditCard);
        return $results;
    }

    /**
     * Recupera una carta di credito per ID cliente. Utile se il cliente ha solo una carta.
     * @deprecated Preferire getCreditCardListByClient per liste.
     */
    public static function getCreditCardByClient(int $clientId): ?ECreditCard {
        // Questa funzione recupera UN oggetto, non una lista. Se un cliente ha più carte, ne prenderà solo una.
        // Utilizza retriveObjectOnAttribute per un singolo risultato.
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(self::getTable(), 'client', $clientId);
        return $results;
    }

    /**
     * Recupera tutte le carte di credito per un cliente specifico.
     * @param EClient $client L'oggetto EClient per cui recuperare le carte.
     * @return ECreditCard[] Un array di oggetti ECreditCard.
     */
    public static function getCreditCardListByClient(EClient $client): array {
        // Usa retriveObjectList per ottenere una collezione di oggetti basata sull'attributo 'client'
        return FEntityManager::getInstance()->retriveObjectList(self::getTable(), 'client', $client->getId());
    }

    /**
     * Salva o aggiorna un oggetto ECreditCard.
     * @param ECreditCard $card L'entità ECreditCard da salvare.
     * @return bool True in caso di successo.
     */
    public static function saveObj(ECreditCard $card): bool
    {
        return FEntityManager::getInstance()->saveObject($card);
    }

    /**
     * Elimina un oggetto ECreditCard.
     * @param ECreditCard $card L'entità ECreditCard da eliminare.
     * @return bool True in caso di successo.
     */
    public static function deleteObj(ECreditCard $card): bool
    {
        return FEntityManager::getInstance()->deleteObj($card);
    }
}