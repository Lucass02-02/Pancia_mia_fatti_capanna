<?php

namespace AppORM\Control;

class CFrontController {

    public function run($requestUri) {
        
        $requestUri = trim($requestUri, '/');
        $uriParts = explode( '/', $requestUri);

        array_shift($uriParts);

        $controllerName = !empty($uriParts[0]) ? ucfirst($uriParts[0]) : 'Home';
        $methodName = !empty($uriParts[1]) ? $uriParts[1] : 'home'; 

        $controllerClass = __NAMESPACE__ . '\\C' . $controllerName;
        
        // --- INIZIO DEBUG ---
     //   echo "<pre>"; // Formatta l'output per renderlo più leggibile
    //    echo "Richiesta URI originale (senza slash): " . htmlspecialchars($requestUri) . "\n";
     //   echo "Parti URI dopo array_shift: \n";
     //   print_r($uriParts);
      //  echo "Nome Controller calcolato: " . htmlspecialchars($controllerName) . "\n";
     //   echo "Nome Metodo calcolato: " . htmlspecialchars($methodName) . "\n";
     //   echo "Classe Controller completa da cercare: " . htmlspecialchars($controllerClass) . "\n";
     //   echo "</pre>";
        // --- FINE DEBUG ---

        if (class_exists($controllerClass)) {
            // --- DEBUG: Conferma che la classe esiste ---
          //  echo "<pre>CLASSE TROVATA: " . htmlspecialchars($controllerClass) . "</pre>";

            if (method_exists($controllerClass, $methodName)) {
                // --- DEBUG: Conferma che il metodo esiste e viene chiamato ---
                // echo "<pre>METODO TROVATO E CHIAMATO: " . htmlspecialchars($controllerClass) . "::" . htmlspecialchars($methodName) . "</pre>";
                $params = array_slice($uriParts, 2);
                call_user_func_array([$controllerClass, $methodName], $params);

            } else {
                // --- DEBUG: Messaggio se il metodo non è trovato ---
            //    echo "<pre>ERRORE: Metodo '" . htmlspecialchars($methodName) . "' NON trovato nella classe '" . htmlspecialchars($controllerClass) . "'. Reindirizzo alla home.</pre>";
                header('Location: /Pancia_mia_fatti_capanna/Home/home');
            }

        } else {
            // --- DEBUG: Messaggio se la classe non è trovata ---
          //  echo "<pre>ERRORE: Classe controller '" . htmlspecialchars($controllerClass) . "' NON trovata. Reindirizzo alla home.</pre>";
            header('Location: /Pancia_mia_fatti_capanna/Home/home');
        }
    }
}