
<!-- ----- début viewInsert -->
 
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require ($root . '/app/view/fragment/fragmentCaveHeader.php');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentCaveMenu.html';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
    ?> 

      <h2>Ajout d'un lien parental</h2>
      <form role="form" method='get' action='router2.php'>
          <div class="form-group">
              <input type="hidden" name='action' value='lienCreatedParent'>
              
              <label for="id">Sélectionnez un enfant : </label>
              <select class="form-control" id='nom' name='nom_enfant' style="width: 300px">
                  <?php
                  foreach ($liste_noms as $nom) {
                      echo ("<option>". $nom['nom'] . " " . $nom['prenom'] ."</option>");
                  }
                  ?>
              </select>
              
              
              <label for="id">Sélectionnez un parent : </label>
              <select class="form-control" id='nom' name='nom_parent' style="width: 300px">
                  <?php
                  foreach ($liste_noms as $nom) {
                      echo ("<option>". $nom['nom'] . " " .$nom['prenom'] ."</option>");
                  }
                  ?>
              </select>
              
          </div>
          
          <button class="btn btn-primary" type="submit">Submit form</button>
      </form>
      

  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewInsert -->



