<?php

  //Class Autoloader POUR CHARGER TOUTES LES CLASS AUTOMATIQUEMEN
class Autoloader
{
     // Enregistre autoloader
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    /*
     Inclue le fichier correspondant à classe
     $class c'est Le nom de la classe à charger
     */
    static function autoload($class)
    {
        require 'model/' . $class . '.php';
    }
}
?>
