<?php

class Conexion{

    static public function conectar(){

        $host = 'localhost';
        $user ='root';
        $db = 'atpruebabd';
        $pass = '';
        $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8',$user,$pass);

        $pdo ->exec("set names utf8");

        return $pdo;
    }
}
