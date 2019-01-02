<?php
$pro_id = $_GET['pro_id'];
try{
    $host = 'localhost';
    $basename = 'jarditou';
    $user = 'root';
    $password = 'leqxd777';
    $db = new PDO('mysql:host=' . $host . ';charset=utf8;dbname=' . $basename, $user, $password);
}catch(PDOException $e ){
    echo 'Erreur : ' . $e->getMessage() . '<br>';
    die('Fin du script');
}

$sql = 'SELECT * FROM produits WHERE pro_id = :pro_id';
$request = $db->prepare($sql);
$request->bindValue(':pro_id', 7);
$request->execute();

// Tant qu'un résultat existe, lis
while($product = $request->fetch(PDO::FETCH_OBJ)){
    echo $product->pro_libelle;
}
// Libère de la mémoire
$request->closeCursor();