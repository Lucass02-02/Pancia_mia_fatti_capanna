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
use AppORM\Services\Foundation\FProduct; // Assicurati che questa riga ci sia
use DateTime;
use Exception;

class FPersistentManager
{
    // --- METODI ESISTENTI ---
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
            if ($client->getCreditCards()->contains($creditCard)) { $client->removeCreditCard($creditCard); $entityManager->persist($client); }
            $entityManager->remove($creditCard);
            $entityManager->flush();
            $entityManager->commit();
            return true;
        } catch (Exception $e) {
            $entityManager->rollback();
            error_log("Errore: " . $e->getMessage());
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


    // --- METODO MANCANTE AGGIUNTO QUI ---
    /**
     * Recupera tutti i prodotti dal database.
     * @return array Un array di oggetti EProduct.
     */
    public static function getAllProducts(): array
    {
        return FProduct::fetchAll();
    }
    /**
     * Recupera TUTTI gli allergeni dal database.
     * @return array Un array di oggetti EAllergens.
     */
    public static function getAllAllergens(): array
    {
        return FAllergens::fetchAll();
    }
     /**
     * Salva una nuova recensione e la associa a un cliente.
     * @param EClient $client Il cliente che lascia la recensione.
     * @param string $comment Il testo della recensione.
     * @param int $rating Il voto da 1 a 5.
     * @return bool True se il salvataggio ha avuto successo.
     */
    public static function addReviewToClient(EClient $client, string $comment, int $rating): bool
    {
        try {
            $review = new EUserReview($client, $comment, $rating);
            // Non serve chiamare $client->addReview($review) perché il costruttore di EUserReview
            // già imposta la relazione. Doctrine gestirà il salvataggio grazie al 'cascade'.
            return FUserReview::saveObj($review);
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio della recensione: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Salva una nuova carta di credito e la associa a un cliente.
     * NOTA: In un'app reale, il token verrebbe da un gateway di pagamento (es. Stripe).
     * @return bool True se il salvataggio ha avuto successo.
     */
    public static function addCreditCardToClient(EClient $client, string $brand, string $last4, int $expMonth, int $expYear, ?string $cardName): bool
    {
        try {
            // Simuliamo un token di pagamento per non salvare dati sensibili.
            $paymentToken = 'pm_' . bin2hex(random_bytes(12));
            
            $creditCard = new ECreditCard($client, $paymentToken, $brand, $last4, $expMonth, $expYear, $cardName);
            return FCreditCard::saveObj($creditCard);
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio della carta: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Rimuove una carta di credito dal database.
     * @param int $cardId L'ID della carta da rimuovere.
     * @return bool True se la rimozione ha avuto successo.
     */
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
}
