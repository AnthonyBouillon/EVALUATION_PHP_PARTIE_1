 <?php
 require "../database.php";
 ?>
 <!DOCTYPE html>
	
 <html lang="fr">
	
   <head>
     <title>Atelier PHP N°4 - page de détail</title>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
   </head>
	
   <body> 
    <div class="container">
      <?php
        require '../template/header.php';
      ?>
      <br>
      <h1 class="text-center">Détails du produit</h1>
      <form action="../script_add.php" method="POST">
        <div class="form-group">
          <label for="cat_id">Catégorie</label>
          <input type="text" class="form-control" id="cat_id" name="cat_id">
        </div>
        <div class="form-group">
          <label for="pro_ref">Référence</label>
          <input type="text" class="form-control" id="pro_ref" name="pro_ref">
        </div>
        <div class="form-group">
          <label for="pro_libelle">Libellé</label>
          <input type="text" class="form-control" id="pro_libelle" name="pro_libelle">
        </div>
        <div class="form-group">
          <label for="pro_description">Description</label>
          <textarea class="form-control" id="pro_description" name="pro_description"></textarea>
        </div>
        <div class="form-group">
          <label for="pro_prix">Prix</label>
          <input type="text" class="form-control" id="pro_prix" name="pro_prix">
        </div>
        <div class="form-group">
          <label for="pro_stock">Stock</label>
          <input type="text" class="form-control" id="pro_stock" name="pro_stock">
        </div>
        <div class="form-group">
          <label for="pro_couleur">Couleur</label>
          <input type="text" class="form-control" id="pro_couleur" name="pro_couleur">
        </div>
        <div class="form-group">
          <label for="pro_ref" class="col 12">Photo</label>
          <input type="file" class="" id="pro_ref" name="pro_ref">
        </div>
            Produit bloqué : <input type="radio" name="pro_bloque" id="" value="1"> Oui <input type="radio" name="pro_bloque" id="" value="0"> Non
        <br>
        <br/>
        <br>
        <button type="submit" class="btn btn-primary" name="add">Envoyer</button>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
   </body>
	
 </html>