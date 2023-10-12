
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.php');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php
    if (isset($event_id)) {
     echo ("<h3>Confirmation de la création d'un évènement</h3>");
     echo("<ul>");
     echo ("<li>famille_id = " . $famille_id . "</li>");
     echo ("<li>individu_id = " . $individu_id . "</li>");
     echo ("<li>event_id = " . $event_id . "</li>");
     echo ("<li>event_type = " . $_GET['event_type'] . "</li>");
     echo ("<li>event_date = " . $_GET['event_date'] . "</li>");
     echo ("<li>event_lieu = " . $_GET['event_lieu'] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème de création de l'évènement</h3>");
     echo ("<h4> Vérifier que la forme de la date entrée est valide</h4>");
     echo ("<h4> Vérifier que la personne n'est pas déjà née ou décédée</h4>");
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    