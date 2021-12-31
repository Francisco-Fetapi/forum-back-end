<?php

    namespace Model;
    abstract class Model{

        public static $BD;

        public function __construct(){
            self::Conectar();
        }

        public static function Conectar(){
            $host = 'sql112.epizy.com';
            $bd = 'epiz_30698652_forum';
            $senha = 'G4ZwG8c6SOMg';
            $user = 'epiz_30698652';
            
            // $host = 'localhost';
            // $bd = 'forum';
            // $senha = '';
            // $user = 'root';
            
            if(!isset(self::$BD)){
                self::$BD = new \PDO("mysql:dbname=$bd;host=$host",$user,$senha);
            }
        }

        public static function Desconectar(){
            self::$BD = null;
        }

    }

    Model::Conectar();
