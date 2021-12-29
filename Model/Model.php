<?php

    namespace Model;
    abstract class Model{

        public static $BD;

        public function __construct(){
            self::Conectar();
        }

        public static function Conectar(){
            // $host = 'sql200.epizy.com';
            // $bd = 'epiz_28384599_forum';
            // $senha = 'yWj5C42ztg8m7c';
            // $user = 'epiz_28384599';
            
            $host = 'localhost';
            $bd = 'forum';
            $senha = '';
            $user = 'root';
            
            if(!isset(self::$BD)){
                self::$BD = new \PDO("mysql:dbname=$bd;host=$host",$user,$senha);
            }
        }

        public static function Desconectar(){
            self::$BD = null;
        }

    }

    Model::Conectar();
?>