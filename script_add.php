<?php

// Connexion à la base de données
//require 'database.php';
//$db = connection();
// Validation du formulaire
$validation = true;
// Tableau d'erreur
$empty = array();
$size = array();
$regex = array();
$succes = array();
/**
 * Vérifie si les champs sont vident
 * Vérifie si le format est correct
 * Vérifie si la taille est correct
 */
if(isset($_POST['add'])){
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
    /**
     * Vérifie si l'image a été ajouté
     * Vérifie l'extension de l'image
     */
    if(isset($_FILES['pro_photo']['name'])){
        // Vérifie l'extension de l'image
        $validate_extension = array('jpg', 'jpeg', 'png', 'pdf', 'gif');
        $extension = substr(strrchr($_FILES['pro_photo']['name'], '.'), 1);
        if(in_array($extension, $validate_extension)){
            $succes['pro_photo'] = 'Correct';
        }else{
            $error_img = 'Extension invalide';
        }
    }else{
        $empty['pro_photo'] = 'La photo est obligatoire';
        $validation = false;
    }
    // Si le formulaire est soumis sans erreur
    if($validation){
        // Insert un produit
        $sql = "INSERT INTO produits (pro_cat_id, pro_ref, pro_libelle, pro_description, pro_prix, pro_stock, pro_couleur, pro_photo, pro_bloque) VALUES (:pro_cat_id, :pro_ref, :pro_libelle, :pro_description, :pro_prix, :pro_stock, :pro_couleur, :pro_photo, :pro_bloque)";
        $request = $db->prepare($sql);
        $request->bindValue(':pro_cat_id', $_POST['pro_cat_id']);
        $request->bindValue(':pro_ref', $_POST['pro_ref']);
        $request->bindValue(':pro_libelle', $_POST['pro_libelle']);
        $request->bindValue(':pro_description', $_POST['pro_description']);
        $request->bindValue(':pro_prix', $_POST['pro_prix']);
        $request->bindValue(':pro_stock', $_POST['pro_stock']);
        $request->bindValue(':pro_couleur', $_POST['pro_couleur']);
        $request->bindValue(':pro_photo', 'jpg');
        if(!isset($_POST['pro_bloque'])){
            $request->bindValue(':pro_bloque', 0);
        }else{
            $request->bindValue(':pro_bloque', $_POST['pro_bloque']);
        }
        $request->execute();

        // Sélectionne le dernier identifiant inséré, pour le nom de l'image
        $sql = "SELECT MAX(pro_id) as 'pro_id' FROM produits";
        $request = $db->query($sql);
        $result = $request->fetch(PDO::FETCH_OBJ);
        $name_photo = $result->pro_id;
        
        // Si c'est bon, l'image est téléchargé
        move_uploaded_file($_FILES["pro_photo"]['tmp_name'], "../image/" . $name_photo . '.jpg');
        $succes['validation'] = 'Bravo le produit a été ajouté';
        // Redirection
        header('Location: list.php');
    }
}

