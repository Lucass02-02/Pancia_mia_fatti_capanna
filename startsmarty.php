<?php
require __DIR__.'/vendor/autoload.php';
use Smarty\Smarty;

class StartSmarty{
    static function configuration(){
        $smarty=new Smarty();
        $smarty->setTemplateDir(__DIR__. '/libs/Smarty/templates/');
        $smarty->setConfigDir(__DIR__. '/libs/Smarty/config/');
        $smarty->setCompileDir(__DIR__. '/libs/Smarty/templates_c/');
        $smarty->setCacheDir(__DIR__. '/libs/Smarty/cache/');
        return $smarty;
    }
}