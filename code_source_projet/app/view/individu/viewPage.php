
<!-- ----- début viewAll -->
<?php

require ($root . '/app/view/fragment/fragmentCaveHeader.php');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentCaveMenu.html';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
      ?>

      <?php
      echo("<h2>" . $_GET['nom'] . "</h2>");
      echo("<ul>");
      foreach ($liste_events as $event){
          if($event['event_type']=='NAISSANCE'){
              echo("<li> Né le " . $event['event_date'] . " à " . $event['event_lieu'] . "</li>");
          }
          else{
              echo("<li> Décès le " . $event['event_date'] . " à " . $event['event_lieu'] . "</li>");
          }
      }
      echo("</ul>");
      
      echo("<h2> Parents </h2>");
      echo("<ul>");
      if(($liste_parents[0]['nom'] == '?') || !isset($liste_parents[0])){
          echo("<li> Père Inconnu </li>");
      }
      else{
          echo("<li> Père <a href='https://dev-isi.utt.fr/~calonnej/lo07_tds/projet/app/router/router2.php?action=individuPage&nom=" . $liste_parents[0]['nom'] . " " . $liste_parents[0]['prenom'] . "'>". $liste_parents[0]['nom'] . " " . $liste_parents[0]['prenom'] ." </a></li>");
      }
      if(($liste_parents[1]['nom'] == '?') || !isset($liste_parents[1])){
          echo("<li> Mère Inconnu </li>");
      }
      else{
          echo("<li> Mère <a href='https://dev-isi.utt.fr/~calonnej/lo07_tds/projet/app/router/router2.php?action=individuPage&nom=" . $liste_parents[1]['nom'] . " " . $liste_parents[1]['prenom'] . "'>". $liste_parents[1]['nom'] . " " . $liste_parents[1]['prenom'] ." </a></li>");
      }
      echo("</ul>");
      
      echo("<h2> Unions et enfants </h2>");
      echo("<ul>");
      foreach($liste_unions_second as $union){
          echo("<li>" . $union['lien_type'] . " avec <a href='https://dev-isi.utt.fr/~calonnej/lo07_tds/projet/app/router/router2.php?action=individuPage&nom=" . $union['nometprenom'][0]['nom'] . " " . $union['nometprenom'][0]['prenom'] . "'>". $union['nometprenom'][0]['nom'] . " " . $union['nometprenom'][0]['prenom'] ."</a></li>");
          echo("<ol>");
          foreach ($union['enfants'] as $enfant){
              echo("<li> Enfant <a href='https://dev-isi.utt.fr/~calonnej/lo07_tds/projet/app/router/router2.php?action=individuPage&nom=" . $enfant['nom'] . " " . $enfant['prenom'] . "'>". $enfant['nom'] . " " . $enfant['prenom']."</a></li>");
          }
          echo("</ol>");
      }
      echo("</ul>");
      ?>
    
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  