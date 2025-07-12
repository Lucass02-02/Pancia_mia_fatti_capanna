<?php

/**
 * Calcola e visualizza l'output della funzione str_rot13()
 * per una stringa data come parametro GET 'text'.
 */

// Controlla se il parametro 'text' è presente nell'URL
if (isset($_GET['text'])) {
    $inputText = $_GET['text'];
    $rot13Output = str_rot13($inputText);

    echo "<h1>Calcolo str_rot13()</h1>";
    echo "<p>Stringa di input: <strong>" . htmlspecialchars($inputText) . "</strong></p>";
    echo "<p>Output di str_rot13(): <strong>" . htmlspecialchars($rot13Output) . "</strong></p>";
} else {
    echo "<h1>Calcolo str_rot13()</h1>";
    echo "<p>Nessun testo fornito. Si prega di aggiungere '?text=la_tua_stringa' all'URL.</p>";
    echo "<p>Esempio: <a href=\"?text=Hello_World\">?text=Hello_World</a></p>";
}

?>