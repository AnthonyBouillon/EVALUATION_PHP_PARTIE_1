<?php
require "../database.php";
$db = connection(); // Appel de la fonction de connexion
$requete = "SELECT pro_photo, pro_id, pro_ref, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif, pro_bloque FROM produits ORDER BY pro_id DESC";	
$result = $db->query($requete);
if ($result->rowCount() == 0) {
   // Pas d'enregistrement
   die("La table est vide");
}
?>
<!DOCTYPE html>

<html lang="fr">
<head>	
    <title>Atelier PHP N° 4 - Affichage de la liste</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
	
<body> 
    <div class="container">
        <?php require '../template/header.php';	?>
        <br>
        <h1 class="text-center">Liste des produits</h1>
        
        <table class="table table-bordered table-striped">
            <tr style="background-color: white!important">
                <th>Photo</th>
                <th>ID</th>
                <th>Référence</th>
                <th>Libellé</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Couleur</th>
                <th>Ajout</th>
                <th>Modif</th>
                <th>Bloqué</th>
            </tr>
            <tbody>
            <?php	
            while ($row = $result->fetch(PDO::FETCH_OBJ))	
            {
                echo"<tr>";
                echo"<td><img src='../image/$row->pro_id.$row->pro_photo' class='img-fluid'></td>";
                echo"<td>$row->pro_id</td>";
                echo"<td>$row->pro_ref</td>";
                echo"<td><a href='detail.php?id=$row->pro_id' title='$row->pro_libelle'>$row->pro_libelle</a></td>";
                echo"<td>$row->pro_prix</td>";
                echo"<td>$row->pro_stock</td>";
                echo"<td>$row->pro_couleur</td>";
                echo"<td>$row->pro_d_ajout</td>";
                echo"<td>$row->pro_d_modif</td>";
                if($row->pro_bloque == 0){
                    echo"<td>Non</td>";
                }else{
                    echo"<td>Oui</td>";
                }
                
                echo"</tr>";
            }	
            ?>
            </tbody>

        </table>
    </div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
	
</html> 
