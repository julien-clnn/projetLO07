<!-- ----- debut fragmentCaveJumbotron -->
<?php 

if (isset($_SESSION['SESSION_famille_selected'])) {
    $titre = "FAMILLE " . $_SESSION['SESSION_famille_selected'];
} else {
    $titre = "PAS DE FAMILLE SELECTIONNEE";
}
?>
<div class="jumbotron">
  <h1>
  <?php 
  echo("$titre");
  ?>
  </h1>
  <p><a class="btn btn-primary btn-lg" href="https://moodle.utt.fr/pluginfile.php/326930/mod_resource/content/15/p22_lo07_projet_genealogie-3.pdf?redirect=1" target="_blank" role="button">Voir le sujet</a></p>
</div>
<p/>

<!-- ----- fin fragmentCaveJumbotron -->