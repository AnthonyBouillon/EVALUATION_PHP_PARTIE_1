<?php

    function connection(){
        $host = 'localhost';
        $basename = 'jarditou';
        $user = 'root';
        $password = 'leqxd777';
        try{
            $db = new PDO('mysql:host=' . $host . ';charset=utf8;dbname=' . $basename, $user, $password);
            return $db;
        }catch(PDOException $e ){
            echo 'Erreur : ' . $e->getMessage() . '<br>';
            die('Fin du script');
        }
    }
