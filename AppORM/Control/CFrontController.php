<?php

namespace AppORM\Control;

class CFrontController {

    public function run($requestUri) {

        echo "$requestUri ";

        $requestUri = trim($requestUri, '/');
        $uriParts = explode( '/', $requestUri);

        array_shift($uriParts);

        var_dump($uriParts);

        $controllerName = !empty($uriParts[0]) ? ucfirst($uriParts[0]) : 'Home';

        $methodName = !empty($uriParts[1]) ? $uriParts[1] : 'home'; 

        $controllerClass = __NAMESPACE__ . '\\C' . $controllerName;

        
        var_dump($methodName);
        
        if (class_exists($controllerClass)) {
            

            if (method_exists($controllerClass, $methodName)) {

                $params = array_slice($uriParts, 2);
                call_user_func_array([$controllerClass, $methodName], $params);

            } else {

                header('Location: /Pancia_mia_fatti_capanna/Home/home');
            }

        }else{
            header('Location: /Pancia_mia_fatti_capanna/Home/home');
        }
    }
}