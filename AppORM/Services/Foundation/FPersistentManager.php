<?php
// PHP Version: 8.1+

namespace AppORM\Services\Foundation;

use AppORM\Entity\EClient;
use AppORM\Entity\ECreditCard;
use AppORM\Entity\EUserReview;
use AppORM\Entity\EProduct;
use AppORM\Entity\EAllergens;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Services\Foundation\FClient;
use AppORM\Services\Foundation\FCreditCard;
use AppORM\Services\Foundation\FAllergens;
use AppORM\Services\Foundation\FProduct;
use DateTime;
use Exception;

class FPersistentManager
{
    /**
     * Registra un nuovo cliente nel sistema.
     */
    public static function registerClient(
        string $name,
        string $surname,
        DateTime $birthDate,
        string $email,
        string $password,
        ?string $nickname = null,
        ?string $phoneNumber = null
    ): ?EClient {
        if (FClient::getClientByEmail($email) !== null) {
            error_log("Tentativo di registrazione con email già esistente: " . $email);
            return null;
        }
        if ($nickname !== null && FClient::getClientByNickname($nickname) !== null) {
            error_log("Tentativo di registrazione con nickname già esistente: " . $nickname);
            return null;
        }

        $client = new EClient($name, $surname, $birthDate, $email, password_hash($password, PASSWORD_DEFAULT));
        $client->setNickname($nickname);
        $client->setPhonenumber($phoneNumber);
        $client->setReceivesNotifications(false);
        $client->setLoyaltyPoints(0);

        if (FClient::saveObj($client)) {
            return $client;
        }

        // --- MODIFICA CRUCIALE QUI ---
        // Se il salvataggio fallisce, dobbiamo esplicitamente restituire null
        // per rispettare il tipo di ritorno della funzione (?EClient).
        return null; 
    }

    /**
     * Autentica un cliente tramite email e password.
     */
    public static function authenticateClient(string $email, string $password): ?EClient
    {
        $client = FClient::getClientByEmail($email);
        if ($client && password_verify($password, $client->getPassword())) {
            return $client;
        }
        return null;
    }

    // ... Il resto dei metodi della classe non necessita di modifiche ...

    public static function getClientById(int $id): ?EClient { return FClient::getObj($id); }
    public static function getClientByEmail(string $email): ?EClient { return FClient::getClientByEmail($email); }
    public static function updateClientPhonenumber(EClient $client, ?string $newPhoneNumber): bool { return FClient::setPhonenumber($client, $newPhoneNumber); }
    public static function updateClientNickname(EClient $client, ?string $newNickname): bool { return FClient::setNickname($client, $newNickname); }
    public static function updateClientReceivesNotifications(EClient $client, bool $status): bool { return FClient::setReceivesNotifications($client, $status); }
    public static function addClientLoyaltyPoints(EClient $client, int $pointsToAdd): bool { $newPoints = $client->getLoyaltyPoints() + $pointsToAdd; return FClient::setLoyaltyPoints($client, $newPoints); }
    public static function removeClientLoyaltyPoints(EClient $client, int $pointsToRemove): bool { $newPoints = max(0, $client->getLoyaltyPoints() - $pointsToRemove); return FClient::setLoyaltyPoints($client, $newPoints); }
    public static function addClientReview(EUserReview $review): bool { return FEntityManager::saveObject($review); }
    public static function addClientPaymentMethod(EClient $client, string $paymentToken, string $brand, string $last4, int $expMonth, int $expYear, ?string $cardName = null): ?ECreditCard {
        $creditCard = new ECreditCard($client, $paymentToken, $brand, $last4, $expMonth, $expYear, $cardName);
        if (FCreditCard::saveObj($creditCard)) { return $creditCard; }
        return null;
    }
    public static function getClientCreditCards(EClient $client): array { return $client->getCreditCards()->toArray(); }
    public static function removeClientCreditCard(EClient $client, ECreditCard $creditCard): bool {
        $entityManager = FEntityManager::getEntityManager();
        $entityManager->beginTransaction();
        try {
            if ($client->getCreditCards()->contains($creditCard)) {
                $client->removeCreditCard($creditCard);
                $entityManager->persist($client);
            }
            $entityManager->remove($creditCard);
            $entityManager->flush();
            $entityManager->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->rollback();
            error_log("Errore durante la rimozione della carta di credito: " . $e->getMessage());
            return false;
        }
    }
    
    public static function deleteClient(EClient $client): bool { return FClient::deleteObj($client); }
    public static function saveProduct(EProduct $product): bool { return FProduct::saveObj($product); }
    public static function getProductById(int $id): ?EProduct { return FProduct::getObj($id); }
    public static function updateProductAvailability(EProduct $product, bool $availability): bool { return FProduct::setAvailability($product, $availability); }
    public static function deleteProduct(EProduct $product): bool { return FProduct::deleteObj($product); }
    public static function saveAllergen(EAllergens $allergen): bool { return FAllergens::saveObj($allergen); }
    public static function getAllergenById(int $id): ?EAllergens { return FAllergens::getAllergenById($id); }
    public static function deleteAllergen(EAllergens $allergen): bool { return FAllergens::deleteObj($allergen); }
    public static function addAllergenToProduct(EProduct $product, EAllergens $allergen): bool { $product->addAllergen($allergen); return FProduct::saveObj($product); }
    public static function removeAllergenFromProduct(EProduct $product, EAllergens $allergen): bool { $product->removeAllergen($allergen); return FProduct::saveObj($product); }
}
