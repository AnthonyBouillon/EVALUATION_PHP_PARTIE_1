<?php
session_start();
if (file_exists("../database.php")) {
    require "../database.php";
    $db = connection();
    // Requête qui permet d'afficher la liste des produits
    $requete = "SELECT pro_photo, pro_id, pro_ref, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif, pro_bloque FROM produits ORDER BY pro_id DESC";	
    $result = $db->query($requete);
}else{
    echo 'ERROR FICHIER DATABASE';
}
if (file_exists("../template/header.php")) {
    require '../template/header.php';	
}else{
     echo 'ERROR FICHIER HEADER';
 }
?>

<br>
<h1 class="text-center">Liste des produits</h1>
<div class="table-responsive">
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
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_OBJ))	{
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
                if($row->pro_bloque == 1){
                    echo"<td>Non</td>";
                }else{
                    echo"<td>Oui</td>";
                } 
                echo"</tr>";
            }	
        }
        ?>
        </tbody>
    </table>
</div>
<?php 
 if (file_exists("../template/footer.php")) {
    require '../template/footer.php'; 
 }else{
     echo 'ERROR FICHIER FOOTER';
 }
?>
