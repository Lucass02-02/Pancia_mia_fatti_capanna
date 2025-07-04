<?php
// PHP Version: 8.1+

namespace AppORM\Services\Foundation;

use AppORM\Entity\EClient;
use AppORM\Entity\ECreditCard;
use AppORM\Entity\EUserReview;
use AppORM\Entity\EProduct;
use AppORM\Entity\EAllergens;
use DateTime;
use Exception;

class FPersistentManager
{
   
    public static function registerClient(string $name, string $surname, DateTime $birthDate, string $email, string $password, ?string $nickname = null, ?string $phoneNumber = null): ?EClient {
        if (FClient::getClientByEmail($email) !== null) { return null; }
        if ($nickname !== null && FClient::getClientByNickname($nickname) !== null) { return null; }
        $client = new EClient($name, $surname, $birthDate, $email, password_hash($password, PASSWORD_DEFAULT));
        $client->setNickname($nickname);
        $client->setPhonenumber($phoneNumber);
        if (FClient::saveObj($client)) { return $client; }
        return null;
    }
    
    public static function authenticateClient(string $email, string $password): ?EClient {
        $client = FClient::getClientByEmail($email);
        if ($client && password_verify($password, $client->getPassword())) { return $client; }
        return null;
    }
    
    // --- Metodi di recupero e aggiornamento mantenuti per fornire un'API completa ---
    
    public static function getClientById(int $id): ?EClient { return FClient::getObj($id); }
    
    public static function getClientByEmail(string $email): ?EClient { return FClient::getClientByEmail($email); }
    
    public static function updateClientPhonenumber(EClient $client, ?string $newPhoneNumber): bool { return FClient::setPhonenumber($client, $newPhoneNumber); }
    
    public static function updateClientNickname(EClient $client, ?string $newNickname): bool { return FClient::setNickname($client, $newNickname); }
    
    public static function updateClientReceivesNotifications(EClient $client, bool $status): bool { return FClient::setReceivesNotifications($client, $status); }
    
    public static function addClientLoyaltyPoints(EClient $client, int $pointsToAdd): bool { $newPoints = $client->getLoyaltyPoints() + $pointsToAdd; return FClient::setLoyaltyPoints($client, $newPoints); }
    
    public static function removeClientLoyaltyPoints(EClient $client, int $pointsToRemove): bool { $newPoints = max(0, $client->getLoyaltyPoints() - $pointsToRemove); return FClient::setLoyaltyPoints($client, $newPoints); }

    public static function addReviewToClient(EClient $client, string $comment, int $rating): bool
    {
        try {
            $review = new EUserReview($client, $comment, $rating);
            return FUserReview::saveObj($review);
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio della recensione: " . $e->getMessage());
            return false;
        }
    }

    public static function addCreditCardToClient(EClient $client, string $brand, string $last4, int $expMonth, int $expYear, ?string $cardName): bool
    {
        try {
            $paymentToken = 'pm_' . bin2hex(random_bytes(12));
            $creditCard = new ECreditCard($client, $paymentToken, $brand, $last4, $expMonth, $expYear, $cardName);
            return FCreditCard::saveObj($creditCard);
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio della carta: " . $e->getMessage());
            return false;
        }
    }
    
    public static function getClientCreditCards(EClient $client): array { 
        return $client->getCreditCards()->toArray();
     }
    
    public static function deleteCreditCard(int $cardId): bool
    {
        try {
            $creditCard = FEntityManager::retriveObject(ECreditCard::class, $cardId);
            if ($creditCard) {
                return FEntityManager::removeObject($creditCard);
            }
            return false;
        } catch (Exception $e) {
            error_log("Errore durante la cancellazione della carta: " . $e->getMessage());
            return false;
        }
    }
    
    public static function deleteClient(EClient $client): bool { return FClient::deleteObj($client); }
    
    // --- Metodi di gestione Prodotti e Allergeni mantenuti per il Proprietario ---
    
    public static function saveProduct(EProduct $product): bool { return FProduct::saveObj($product); }
    
    public static function getProductById(int $id): ?EProduct { return FProduct::getObj($id); }

    public static function getAllProducts(): array
    {
        return FProduct::fetchAll();
    }
    
    public static function updateProductAvailability(EProduct $product, bool $availability): bool { return FProduct::setAvailability($product, $availability); }
    
    public static function deleteProduct(EProduct $product): bool { return FProduct::deleteObj($product); }
    
    public static function saveAllergen(EAllergens $allergen): bool { return FAllergens::saveObj($allergen); }
    
    public static function getAllergenById(int $id): ?EAllergens { return FAllergens::getAllergenById($id); }

    public static function getAllAllergens(): array
    {
        return FAllergens::fetchAll();
    }
    
    public static function deleteAllergen(EAllergens $allergen): bool { return FAllergens::deleteObj($allergen); }
    
    public static function addAllergenToProduct(EProduct $product, EAllergens $allergen): bool { $product->addAllergen($allergen); return FProduct::saveObj($product); }
    
    public static function removeAllergenFromProduct(EProduct $product, EAllergens $allergen): bool { $product->removeAllergen($allergen); return FProduct::saveObj($product); }
}