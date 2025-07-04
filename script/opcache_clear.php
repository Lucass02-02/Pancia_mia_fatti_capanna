<?php
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "OPcache resettata con successo!\n";
} else {
    echo "OPcache non è abilitata o la funzione opcache_reset non esiste.\n";
}
?>
