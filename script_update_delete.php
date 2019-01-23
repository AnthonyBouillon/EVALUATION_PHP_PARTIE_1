<?php

 // Validation du formulaire
$validation = true;
// Tableau d'erreur
$empty = array();
$size = array();
$regex = array();
$succes = array();
// Si le formulaire n'a pas été soumis, on redirige
if(isset($_POST['update'])){
    if(!isset($_POST['pro_bloque'])){
        $_POST['pro_bloque'] = $_SESSION['pro_bloque'];
    }
/**
 * Vérifie si les champs sont vident
 * Vérifie si le format est correct
 * Vérifie si la taille est correct
 */
    if(!empty($_POST['pro_cat_id'])){
        if(preg_match('/\d/', $_POST['pro_cat_id'])){
            $succes['pro_cat_id'] = 'Correct';
        }else{
            $regex['pro_cat_id'] = 'La valeur de la catégorie est incorrect';
            $validation = false; 
        }
    }else{
        $empty['pro_cat_id'] = 'La valeur de la catégorie est vide';
        $validation = false; 
    }
    if(!empty($_POST['pro_ref'])){
        if(strlen($_POST['pro_ref']) <= 10){
            $succes['pro_ref'] = 'Correct';
        }else{
            $size['pro_ref'] = '10 catactères maximum';
            $validation = false; 
        }
    }else{
        $empty['pro_ref'] = 'La référence est obligatoire';
        $validation = false; 
    }

    if(!empty($_POST['pro_libelle'])){
        if(strlen($_POST['pro_libelle']) <= 200){
            $succes['pro_libelle'] = 'Correct';
        }else{
            $size['pro_libelle'] = '200 catactères maximum';
            $validation = false; 
        }
    }else{
        $empty['pro_libelle'] = 'Le libellé est obligatoire';
        $validation = false;   
    }

    if(!empty($_POST['pro_description'])){
        $succes['pro_description'] = 'Correct';    
    }else{
        $empty['pro_description'] = 'La description est obligatoire';
        $validation = false; 
    }

    if(!empty($_POST['pro_prix'])){
        if(preg_match('/[[:digit:]]/', $_POST['pro_prix'])){
            $succes['pro_prix'] = 'Correct';
        }else{
            $regex['pro_prix'] = 'La valeur du prix est incorrect';
            $validation = false; 
        }
    }else{
        $empty['pro_prix'] = 'Le prix est obligatoire';
        $validation = false; 
    }

    if(!empty($_POST['pro_stock'])){
        if(preg_match('/\d/', $_POST['pro_stock'])){
            $succes['pro_stock'] = 'Correct';
        }else{
            $regex['pro_stock'] = 'La valeur du stock est incorrect';
            $validation = false; 
        }
    }else{
        $empty['pro_stock'] = 'Le stock est obligatoire';
        $validation = false;    
    }

    if(!empty($_POST['pro_couleur'])){
        if(strlen($_POST['pro_couleur']) <= 30){
            $succes['pro_couleur'] = 'Correct';
        }else{
            $size['pro_couleur'] = '30 catactères maximum';
            $validation = false; 
        }
    }else{
        $empty['pro_couleur'] = 'La couleur est obligatoire';
        $validation = false; 
    }
     if($validation){
        $sql = "UPDATE produits 
        JOIN categories ON produits.pro_cat_id = categories.cat_id 
        SET pro_ref=:pro_ref, 
        pro_cat_id = :pro_cat_id, 
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
        $request->bindValue(':pro_cat_id', $_POST['pro_cat_id']);
        $request->bindValue(':pro_libelle', $_POST['pro_libelle']);
        $request->bindValue(':pro_description', $_POST['pro_description']);
        $request->bindValue(':pro_prix', $_POST['pro_prix']);
        $request->bindValue(':pro_stock', $_POST['pro_stock']);
        $request->bindValue(':pro_couleur', $_POST['pro_couleur']);
        $request->bindValue(':pro_bloque', $_POST['pro_bloque']);
        $request->execute();
        // Libère de la mémoire
        $request->closeCursor();
        header('Location: list.php');
     }
}else if (isset($_POST['delete'])){
    if(!empty($_GET['id'])){
        $db = connection();
        $sql = "DELETE FROM produits WHERE pro_id=:pro_id";
        $request = $db->prepare($sql);
        $request->bindValue(':pro_id', $_GET['id']);
        $request->execute();
        $request->closeCursor();
        header('location:list.php');
    }
}
