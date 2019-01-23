 <?php
session_start();
if (file_exists("../database.php")) {
  require '../database.php'; 
  $db = connection();

if(!isset($_GET["id"])){
  header('Location: list.php');
}else{
  $pro_id = $_GET['id'];
  // Récupère tous les produits
  $request = "SELECT * FROM produits JOIN categories ON produits.pro_cat_id = categories.cat_id WHERE pro_id=$pro_id";
  $result = $db->query($request);
  // Assigne le résultat dans une variable (devient un objet)
  $produit = $result->fetch(PDO::FETCH_OBJ);
}
  // Affiche tous les catégories dans le select
 $sql2 = "SELECT cat_id, cat_nom FROM categories";
 $query = $db->query($sql2);
}else{
  echo 'ERROR FILES DATABASE';
}

if (file_exists("../script_update_delete.php")) {
  require '../script_update_delete.php';
}else{
  echo 'ERROR FILES UPDATE';
}
 if (file_exists("../template/header.php")) {
  require '../template/header.php';
}else{
  echo 'ERROR FILES HEADER';
}
?>
      <br>
      <h1 class="text-center">Détails du produit</h1>
      <form action="" method="POST">
        <div class="form-group">
          <label for="pro_id">ID</label>
          <input type="text" class="form-control" id="pro_id" value="<?= !empty($produit->pro_id) ? $produit->pro_id : '' ?>" disabled>
        </div>
        <div class="form-group">
          <label for="pro_ref">Référence</label>
          <input type="text" class="form-control" id="pro_ref" value="<?= !empty($produit->pro_ref) ? $produit->pro_ref : '' ?>" name="pro_ref" required>
          <small class="text-success"><?= !empty($succes['pro_ref']) ? $succes['pro_ref'] : '' ?></small>
          <small class="text-danger"><?= !empty($size['pro_ref']) ? $size['pro_ref'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_ref']) ? $empty['pro_ref'] : '' ?></small>
        </div>
        <div class="form-group">
          <label for="pro_cat_id">Catégorie</label>
        <select name="pro_cat_id" id="pro_cat_id" class="form-control">
        <option value="<?= !empty($produit->pro_cat_id) ? $produit->pro_cat_id : '' ?>"><?= !empty($produit->pro_cat_id) ? $produit->pro_cat_id . ' - ' . $produit->cat_nom : '' ?></option>
          <?php
            while ($result = $query->fetch(PDO::FETCH_OBJ)){
              echo '<option value=' . $result->cat_id . '>' . $result->cat_id . ' - ' . $result->cat_nom . '</option>';
            }
          ?>
          </select>
          <small class="text-success"><?= !empty($succes['pro_ref']) ? $succes['pro_ref'] : '' ?></small>
          <small class="text-danger"><?= !empty($regex['pro_ref']) ? $regex['pro_ref'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_ref']) ? $empty['pro_ref'] : '' ?></small>
        </div>
        <div class="form-group">
          <label for="pro_libelle">Libellé</label>
          <input type="text" class="form-control" id="pro_libelle" value="<?= !empty($produit->pro_libelle) ? $produit->pro_libelle : '' ?>" name="pro_libelle" required>
          <small class="text-success"><?= !empty($succes['pro_libelle']) ? $succes['pro_libelle'] : '' ?></small>
          <small class="text-danger"><?= !empty($size['pro_libelle']) ? $size['pro_libelle'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_libelle']) ? $empty['pro_libelle'] : '' ?></small>
        </div>
        <div class="form-group">
          <label for="pro_description">Description</label>
          <textarea class="form-control" id="pro_description" name="pro_description" required><?= !empty($produit->pro_description) ? $produit->pro_description : '' ?></textarea>
          <small class="text-success"><?= !empty($succes['pro_description']) ? $succes['pro_description'] : '' ?></small>
          <small><?= !empty($empty['pro_description']) ? $empty['pro_description'] : '' ?></small>          
        </div>
        <div class="form-group">
          <label for="pro_prix">Prix</label>
          <input type="text" class="form-control" id="pro_prix" value="<?= !empty($produit->pro_prix) ? $produit->pro_prix : '' ?>" name="pro_prix" required>
          <small class="text-success"><?= !empty($succes['pro_prix']) ? $succes['pro_prix'] : '' ?></small>
          <small class="text-danger"><?= !empty($regex['pro_prix']) ? $regex['pro_prix'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_prix']) ? $empty['pro_prix'] : '' ?></small>
        </div>
        <div class="form-group">
          <label for="pro_stock">Stock</label>
          <input type="text" class="form-control" id="pro_stock" value="<?= !empty($produit->pro_stock) ? $produit->pro_stock : '' ?>" name="pro_stock" required>
          <small class="text-success"><?= !empty($succes['pro_stock']) ? $succes['pro_stock'] : '' ?></small>
          <small class="text-danger"><?= !empty($regex['pro_stock']) ? $regex['pro_stock'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_stock']) ? $empty['pro_stock'] : '' ?></small>
        </div>
        <div class="form-group">
          <label for="pro_couleur">Couleur</label>
          <input type="text" class="form-control" id="pro_couleur" value="<?= !empty($produit->pro_couleur) ? $produit->pro_couleur : '' ?>" name="pro_couleur" required>
          <small class="text-success"><?= !empty($succes['pro_couleur']) ? $succes['pro_couleur'] : '' ?></small>
          <small class="text-danger"><?= !empty($size['pro_couleur']) ? $size['pro_couleur'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_couleur']) ? $empty['pro_couleur'] : '' ?></small>
        </div>
        <!-- Bouton radio -->
        <?php if($produit->pro_bloque == 0){ ?>
           Produit bloqué : <input type="radio" name="pro_bloque" id="" value="0" checked> Oui
        <?php }else{ ?>
          Produit bloqué : <input type="radio" name="pro_bloque" id="" value="0"> Oui
         <?php }
        if($produit->pro_bloque == 1){ ?>
            <input type="radio" name="pro_bloque" id="" value="1" checked> Non
        <?php }else{ ?>
          <input type="radio" name="pro_bloque" id="" value="1"> Non
        <?php } ?>
        <br>
        <!-- Date ajout et modification -->
        Date d'ajout : <?= !empty($produit->pro_d_ajout) ? $produit->pro_d_ajout : '' ?>
        <br>
        Date de modification : <?= !empty($produit->pro_d_modif) ? $produit->pro_d_modif : '' ?>
        <br/>
        <br>
        <button type="submit" class="btn btn-primary" name="update">Modifier</button>
        <button type="submit" class="btn btn-primary" name="delete" onclick="return confirm('Etes vous sur de vouloir le supprimer ?')">Supprimer</button>
      </form>
    </div>
<?php 
if(file_exists('../template/footer.php')){
  require '../template/footer.php';
}else{
  echo 'ERROR FILES FOOTER';
}
?>