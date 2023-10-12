
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
              <input type="hidden" name='action' value='individuCreated'>
              
              <label for="id">Nom ? </label><br/>
              <input type="text" name='nom' size='75' value='Niney'><br/>
              
              <label for="id">Prenom ? </label><br/>
              <input type="text" name='prenom' size='75' value='Pierre'><br/>
              
              <label>Sexe ?</label><br/>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="radio" checked id="inlineRadio1" value="H">
                  <label class="form-check-label" for="inlineRadio1">Homme</label>
                  <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="F">
                  <label class="form-check-label" for="inlineRadio2">Femme</label>
              </div>
          </div>
          
          <button class="btn btn-primary" type="submit">Submit form</button>
      </form>
      

  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewInsert -->



