<?php

require __DIR__ . '/vendor/autoload.php';

echo "Funzioni di autoload registrate:\n";
print_r(spl_autoload_functions());

echo "\n--- Test di caricamento classi ---\n";

try {
    if (class_exists('App\\Foundation\\FEntityManager')) {
        echo "La classe App\\Foundation\\FEntityManager è stata trovata!\n";
    } else {
        echo "La classe App\\Foundation\\FEntityManager NON è stata trovata.\n";
    }
} catch (Throwable $e) {
    echo "Errore durante il caricamento di App\\Foundation\\FEntityManager: " . $e->getMessage() . "\n";
}

try {
    if (class_exists('AppORM\\Entity\\EAdmin')) {
        echo "La classe AppORM\\Entity\\EAdmin è stata trovata!\n";
    } else {
        echo "La classe AppORM\\Entity\\EAdmin NON è stata trovata.\n";
    }
} catch (Throwable $e) {
    echo "Errore durante il caricamento di AppORM\\Entity\\EAdmin: " . $e->getMessage() . "\n";
}

echo "\n--- Fine test ---\n";

?>