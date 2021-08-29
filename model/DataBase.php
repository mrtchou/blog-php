<?php
// pour se connecter a Data Base il suffira de changer les params ici 

class DataBase extends PDO
{
    // Informations de connexion
    public const DBHOST = 'localhost';
    public const DBUSER = 'root';
    public const DBPASS = '';
    public const DBNAME = 'blogPro';

    public function __construct()
    {
      // DSN de connexion
      $_dsn = 'mysql:dbname='. self::DBNAME . ';host=' . self::DBHOST;

      // On appelle le constructeur de la classe PDO
      try{
          parent::__construct($_dsn, self::DBUSER, self::DBPASS);

          $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
          $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
          $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
      catch(PDOException $e)
          {
              die($e->getMessage());
          }
    }
}
