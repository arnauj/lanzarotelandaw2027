<?php

class Campo
{
    private static $instancia = null;

    private static $val = array();


    private function __construct()
    {

        foreach($_GET as $clave => $valor)
        {
            if (self::comprobar_inyeccion($valor))
            {
                self::$val[$clave] = $valor;   
            }
            
        }

        foreach($_POST as $clave => $valor)
        {
            if (self::comprobar_inyeccion($valor))
            {
                self::$val[$clave] = $valor;   
            }
            
        }

    }


    public static function getInstancia(): Campo 
    {

        if (self::$instancia == null)
            self::$instancia = new Campo();

        return self::$instancia;
    }


    static function val($clave,$set_value='')
    {
        empty($set_value)? self::getInstancia() : self::$val[$clave] = $set_value;

        return self::$val[$clave];
    }

    public function __clone(){}


    public static function comprobar_inyeccion($valor)
    {

        if (preg_match('/\b(SELECT|UPDATE|DELETE|DROP TABLE)\b\s+FROM\b/i',$valor))
            die;

        return True;

    }



}


