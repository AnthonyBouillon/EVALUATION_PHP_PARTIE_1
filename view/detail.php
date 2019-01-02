 <?php
 require "../database.php";
 ?>
 <!DOCTYPE html>
	
 <html lang="fr">
	
   <head>
     <title>Atelier PHP N°4 - page de détail</title>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

   <?php     
    $db = connection();
    $pro_id = $_GET["id"];
    $request = "SELECT * FROM produits JOIN categories ON produits.pro_cat_id = categories.cat_id WHERE pro_id=$pro_id";
    $result = $db->query($request);
    // Renvoi de l'enregistrement sous forme d'un objet
    $produit = $result->fetch(PDO::FETCH_OBJ);
   ?>
   </head>
	
   <body> 
    <div class="container">
      <?php
        require '../template/header.php';
      ?>
      <br>
      <h1 class="text-center">Détails du produit</h1>
      <form action="../script_update_delete.php?id=<?= $_GET['id'] ?>" method="POST">
        <div class="form-group">
          <label for="pro_id">ID</label>
          <input type="text" class="form-control" id="pro_id" value="<?= $produit->pro_id ?>" disabled>
        </div>
        <div class="form-group">
          <label for="pro_ref">Référence</label>
          <input type="text" class="form-control" id="pro_ref" value="<?= $produit->pro_ref ?>" name="pro_ref">
        </div>
        <div class="form-group">
          <label for="cat_nom">Catégorie</label>
          <input type="text" class="form-control" id="cat_nom" value="<?= $produit->cat_nom ?>" name="cat_nom">
        </div>
        <div class="form-group">
          <label for="pro_libelle">Libellé</label>
          <input type="text" class="form-control" id="pro_libelle" value="<?= $produit->pro_libelle ?>" name="pro_libelle">
        </div>
        <div class="form-group">
          <label for="pro_description">Description</label>
          <textarea class="form-control" id="pro_description" name="pro_description"><?= $produit->pro_description ?></textarea>
        </div>
        <div class="form-group">
          <label for="pro_prix">Prix</label>
          <input type="text" class="form-control" id="pro_prix" value="<?= $produit->pro_prix ?>" name="pro_prix">
        </div>
        <div class="form-group">
          <label for="pro_stock">Stock</label>
          <input type="text" class="form-control" id="pro_stock" value="<?= $produit->pro_stock ?>" name="pro_stock">
        </div>
        <div class="form-group">
          <label for="pro_couleur">Couleur</label>
          <input type="text" class="form-control" id="pro_couleur" value="<?= $produit->pro_couleur ?>" name="pro_couleur">
        </div>
        Produit bloqué : <input type="radio" name="pro_bloque" id="" value="1"> Oui <input type="radio" name="pro_bloque" id="" value="0"> Non
        <br>
        Date d'ajout : <?= $produit->pro_d_ajout ?>
        <br>
        Date de modification : <?= $produit->pro_d_modif ?>
        <br/>
        <br>
        <button type="submit" class="btn btn-primary" name="update">Modifier</button>
        <button type="submit" class="btn btn-primary" name="delete" onclick="return confirm('Etes vous sur de vouloir le supprimer ?')">Supprimer</button>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
   </body>
	
 </html>