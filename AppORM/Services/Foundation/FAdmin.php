<?php // File: AppORM/Services/Foundation/FAdmin.php
namespace AppORM\Services\Foundation;

use AppORM\Entity\EAdmin;

class FAdmin
{
    /**
     * Recupera un amministratore (proprietario) tramite il suo indirizzo email.
     * @param string $email
     * @return EAdmin|null
     */
    public static function getAdminByEmail(string $email): ?EAdmin
    {
        $em = FEntityManager::getInstance()->getEntityManager();
        // Cerca nella repository di EAdmin un record che corrisponda all'email
        return $em->getRepository(EAdmin::class)->findOneBy(['email' => $email]);
    }
}