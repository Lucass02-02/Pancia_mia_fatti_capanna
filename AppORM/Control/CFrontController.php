<?php
namespace AppORM\Control; // Assicurati che questa namespace sia corretta

class CFrontController {
    public function run(string $requestUri) {
        // Rimuove la parte della base URL (es. /Pancia_mia_fatti_capanna)
        $baseUrl = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        $path = str_replace($baseUrl, '', $requestUri);
        $path = trim($path, '/');

        $queryParams = $_GET; // Mantiene i parametri GET se presenti

        $segments = explode('/', $path);

        $controllerName = array_shift($segments);
        $actionName = array_shift($segments);

        $controllerName = $controllerName ?: 'home';
        $actionName = $actionName ?: 'home';

        $controllerClass = 'AppORM\\Control\\C' . ucfirst($controllerName); // Assicurati che 'C' sia il tuo prefisso

        // --- DEBUG TEMPORANEO ---
        echo "DEBUG: Analizzando URL: '$requestUri'<br>";
        echo "DEBUG: Percorso pulito: '$path'<br>";
        echo "DEBUG: Controller determinato: '$controllerClass'<br>";
        echo "DEBUG: Azione determinata: '$actionName'<br>";
        // --- FINE DEBUG TEMPORANEO ---


        if (class_exists($controllerClass) && method_exists($controllerClass, $actionName)) {
            // Prepara gli argomenti per il metodo del controller
            $reflectionMethod = new \ReflectionMethod($controllerClass, $actionName);
            $methodParameters = $reflectionMethod->getParameters();
            $arguments = [];

            foreach ($methodParameters as $param) {
                if (!empty($segments)) {
                    $arguments[] = array_shift($segments);
                } elseif (isset($queryParams[$param->getName()])) {
                    $arguments[] = $queryParams[$param->getName()];
                } elseif ($param->isDefaultValueAvailable()) {
                    $arguments[] = $param->getDefaultValue();
                } else {
                    $arguments[] = null;
                }
            }

            call_user_func_array([$controllerClass, $actionName], $arguments);

        } else {
            http_response_code(404);
            echo "<h1>Errore 404</h1><p>Pagina o azione non trovata. Debug: Controller '$controllerClass' o Azione '$actionName' non esiste.</p>";
        }
    }
}