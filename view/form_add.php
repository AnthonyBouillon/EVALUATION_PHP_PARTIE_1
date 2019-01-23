 <?php
 if (file_exists("../database.php")) {
  require "../database.php";
  $db = connection();
 }else{
   echo 'ERROR FICHIER DATABASE';
 }
 if (file_exists("../script_update_delete.php")) {
  require "../script_add.php";
 }else{
    echo 'ERROR FICHIER UPDATE_FORM';
 }
 // Affiche catégorie dans sélection
 $sql = "SELECT cat_id, cat_nom FROM categories";
 $query = $db->query($sql);
 require '../template/header.php';
?>
      <br>
      <h1 class="text-center">Détails du produit</h1>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="pro_cat_id">Catégorie</label>
          <select name="pro_cat_id" id="pro_cat_id">
          <?php
            while ($result = $query->fetch(PDO::FETCH_OBJ)){
              echo '<option value=' . $result->cat_id . '>' . $result->cat_id . ' - ' . $result->cat_nom . '</option>';
            }
          ?>
          </select>
          <small class="text-success"><?= !empty($succes['pro_cat_id']) ? $succes['pro_cat_id'] : '' ?></small>
          <small class="text-danger"><?= !empty($regex['pro_cat_id']) ? $regex['pro_cat_id'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_cat_id']) ? $empty['pro_cat_id'] : '' ?></small>          
        </div>
        <div class="form-group">
          <label for="pro_ref">Référence</label>
          <input type="text" class="form-control" id="pro_ref" name="pro_ref" required value="<?= !empty($_POST['pro_ref']) ? $_POST['pro_ref'] : '' ?>">
          <small class="text-success"><?= !empty($succes['pro_ref']) ? $succes['pro_ref'] : '' ?></small>
          <small class="text-danger"><?= !empty($size['pro_ref']) ? $size['pro_ref'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_ref']) ? $empty['pro_ref'] : '' ?></small>
        </div>
        <div class="form-group">
          <label for="pro_libelle">Libellé</label>
          <input type="text" class="form-control" id="pro_libelle" name="pro_libelle" required value="<?= !empty($_POST['pro_libelle']) ? $_POST['pro_libelle'] : '' ?>">
          <small class="text-success"><?= !empty($succes['pro_libelle']) ? $succes['pro_libelle'] : '' ?></small>
          <small class="text-danger"><?= !empty($size['pro_libelle']) ? $size['pro_libelle'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_libelle']) ? $empty['pro_libelle'] : '' ?></small>
        </div>
        <div class="form-group">
          <label for="pro_description">Description</label>
          <textarea class="form-control" id="pro_description" name="pro_description" required value="<?= !empty($_POST['pro_description']) ? $_POST['pro_description'] : '' ?>"></textarea>
          <small class="text-success"><?= !empty($succes['pro_description']) ? $succes['pro_description'] : '' ?></small>
          <small><?= !empty($empty['pro_description']) ? $empty['pro_description'] : '' ?></small>          
        </div>
        <div class="form-group">
          <label for="pro_prix">Prix</label>
          <input type="text" class="form-control" id="pro_prix" name="pro_prix" required value="<?= !empty($_POST['pro_prix']) ? $_POST['pro_prix'] : '' ?>">
          <small class="text-success"><?= !empty($succes['pro_prix']) ? $succes['pro_prix'] : '' ?></small>
          <small class="text-danger"><?= !empty($regex['pro_prix']) ? $regex['pro_prix'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_prix']) ? $empty['pro_prix'] : '' ?></small>
        </div>
        <div class="form-group">
          <label for="pro_stock">Stock</label>
          <input type="text" class="form-control" id="pro_stock" name="pro_stock" required value="<?= !empty($_POST['pro_stock']) ? $_POST['pro_stock'] : '' ?>">
          <small class="text-success"><?= !empty($succes['pro_stock']) ? $succes['pro_stock'] : '' ?></small>
          <small class="text-danger"><?= !empty($regex['pro_stock']) ? $regex['pro_stock'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_stock']) ? $empty['pro_stock'] : '' ?></small>
        </div>
        <div class="form-group">
          <label for="pro_couleur">Couleur</label>
          <input type="text" class="form-control" id="pro_couleur" name="pro_couleur" required value="<?= !empty($_POST['pro_couleur']) ? $_POST['pro_couleur'] : '' ?>">
          <small class="text-success"><?= !empty($succes['pro_couleur']) ? $succes['pro_couleur'] : '' ?></small>
          <small class="text-danger"><?= !empty($size['pro_couleur']) ? $size['pro_couleur'] : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_couleur']) ? $empty['pro_couleur'] : '' ?></small>
        </div>
        <div class="form-group">
          <label for="pro_photo" class="col 12">Photo</label>
          <input type="file" class="" id="pro_photo" name="pro_photo" required>
          <small class="text-danger"><?= !empty($error_img) ? $error_img : '' ?></small>
          <small class="text-danger"><?= !empty($empty['pro_photo']) ? $empty['pro_photo'] : '' ?></small>
          <small class="text-success"><?= !empty($succes['pro_photo']) ? $succes['pro_photo'] : '' ?></small> 
        </div>
            Produit bloqué : <input type="radio" name="pro_bloque" id="" value="1"> Oui <input type="radio" name="pro_bloque" id="" value="0"> Non
        <br>
        <br/>
        <br>
        <button type="submit" class="btn btn-primary" name="add" required>Envoyer</button>
      </form>
    </div>
<?php
 if (file_exists("../template/footer.php")) {
    require '../template/footer.php'; 
 }else{
   echo 'ERROR FICHIER FOOTER';
 }
 ?>