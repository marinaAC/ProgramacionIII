<?php

class ConexionDb{
    private static $_objetoConexionDb;
    private $_objetoPDO;
    private $uss;
    private $pass;
    private $dbName;

    public function __construct($dbName,$uss,$pass)
    {
        try {
 
            $this->_objetoPDO = new PDO('mysql:host=localhost;dbname='.$dbName.';charset=utf8',$uss,$pass, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 
            $this->_objetoPDO->exec("SET CHARACTER SET utf8");
 
        } catch (PDOException $e) {
 
            print "Error!!!<br/>" . $e->getMessage();
 
            die();
        }
    }

    public function GetConsulta($sql)
    {
        return $this->_objetoPDO->prepare($sql);
    }
 
    //Singleton
    public static function GetObjDb()
    {
        if (!isset(self::$_objetoConexionDb)) {       
            self::$_objetoConexionDb = new ConexionDb(); 
        }
 
        return self::$_objetoConexionDb;        
    }
 
    // Evita que el objeto se pueda clonar
    public function __clone()
    {
        trigger_error('La clonaci&oacute;n de este objeto no est&aacute; permitida!!!', E_USER_ERROR);
    }
}

?>