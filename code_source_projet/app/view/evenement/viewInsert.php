
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

      
      <form role="form" method='get' action='router2.php'>
          <div class="form-group">
              <input type="hidden" name='action' value='evenementCreated'>
              
              <label for="id">Sélectionnez un individu : </label>
              <select class="form-control" id='nom' name='nom' style="width: 300px">
                  <?php
                  foreach ($liste_noms as $nom) {
                      echo ("<option>". $nom['nom'] . " " .$nom['prenom'] ."</option>");
                  }
                  ?>
              </select>
              
              
              <label for="id">Sélectionnez un type d'évènement : </label>
              <select class="form-control" id='nom' name='event_type' style="width: 200px">
                  <option>NAISSANCE</option>
                  <option>DECES</option>
              </select>
              
              <label for="id">Date (AAAA-MM-JJ) : </label><br/>
              <input type="text" name='event_date' size='75' value='2002-07-19'><br/>
              
              <label for="id">Lieu : </label><br/>
              <input type="text" name='event_lieu' size='75' value='Troyes'>
              
          </div>
          
          <button class="btn btn-primary" type="submit">Submit form</button>
      </form>
      

  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewInsert -->



