<?php
require 'database.php';
if(isset($_POST['update'])){
    if(!isset($_POST['pro_bloque'])){
        $_POST['pro_bloque'] = 0;
    }
    $db = connection();
    $sql = "UPDATE produits 
    JOIN categories ON produits.pro_cat_id = categories.cat_id 
    SET pro_ref=:pro_ref, 
     cat_nom = :cat_nom, 
     pro_libelle = :pro_libelle, 
     pro_description = :pro_description, 
     pro_prix = :pro_prix, 
     pro_stock = :pro_stock, 
     pro_couleur = :pro_couleur, 
     pro_bloque = :pro_bloque,
     pro_d_modif = NOW()
     WHERE pro_id=:pro_id";
    $request = $db->prepare($sql);
    $request->bindValue(':pro_id', $_GET['id']);
    $request->bindValue(':pro_ref', $_POST['pro_ref']);
    $request->bindValue(':cat_nom', $_POST['cat_nom']);
    $request->bindValue(':pro_libelle', $_POST['pro_libelle']);
    $request->bindValue(':pro_description', $_POST['pro_description']);
    $request->bindValue(':pro_prix', $_POST['pro_prix']);
    $request->bindValue(':pro_stock', $_POST['pro_stock']);
    $request->bindValue(':pro_couleur', $_POST['pro_couleur']);
    $request->bindValue(':pro_bloque', $_POST['pro_bloque']);
    $request->execute();
    // Libère de la mémoire
    $request->closeCursor();
    header('location:view/list.php');
}else if (isset($_POST['delete'])){
     $db = connection();
    $sql = "DELETE FROM produits WHERE pro_id=:pro_id";
    $request = $db->prepare($sql);
    $request->bindValue(':pro_id', $_GET['id']);
    $request->execute();
    $request->closeCursor();
    header('location:view/list.php');
}