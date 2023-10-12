
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

      <h2>Ajout d'une union</h2>
      <form role="form" method='get' action='router2.php'>
          <div class="form-group">
              <input type="hidden" name='action' value='lienCreatedUnion'>
              
              <label for="id">Sélectionnez un homme : </label>
              <select class="form-control" id='nom' name='nom_homme' style="width: 300px">
                  <?php
                  foreach ($liste_noms_hommes as $nom) {
                      echo ("<option>". $nom['nom'] . " " .$nom['prenom'] ."</option>");
                  }
                  ?>
              </select>
              
              
              <label for="id">Sélectionnez une femme : </label>
              <select class="form-control" id='nom' name='nom_femme' style="width: 300px">
                  <?php
                  foreach ($liste_noms_femmes as $nom) {
                      echo ("<option>". $nom['nom'] . " " .$nom['prenom'] ."</option>");
                  }
                  ?>
              </select>
              
              <label for="id">Sélectionnez un type d'union : </label>
              <select class="form-control" id='nom' name='union_type' style="width: 150px">
                  <option>COUPLE</option>
                  <option>SEPARATION</option>
                  <option>PACS</option>
                  <option>MARIAGE</option>
                  <option>DIVORCE</option>
              </select>
              
              <label for="id">Date (AAAA-MM-JJ) : </label><br/>
              <input type="text" name='union_date' size='75' value='2002-07-19'><br/>
              
              <label for="id">Lieu : </label><br/>
              <input type="text" name='union_lieu' size='75' value='Dieppe'>
          </div>
          
          <button class="btn btn-primary" type="submit">Submit form</button>
      </form>
      

  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewInsert -->



