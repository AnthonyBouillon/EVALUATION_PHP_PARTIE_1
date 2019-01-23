<?php
    /**
     * Connexion à la base de données
     * return : $db, permettant de gérer la bdd
     */
    function connection(){
        $host = 'localhost';
        $basename = 'jarditou';
        $user = 'root';
        $password = 'leqxd777';
        try{
            $db = new PDO('mysql:host=' . $host . ';charset=utf8;dbname=' . $basename, $user, $password);
            return $db;
        }catch(PDOException $e ){
            echo 'Erreur : Impossible de se connecter à la base de données <br>';
            die('Si cela se produit, veuillez m\'en faire part à cette adresse : blabla@blabla.com, pour que je puisse corriger le problème rapidemment.');
        }
    }
