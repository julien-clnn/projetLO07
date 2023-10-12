
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
    if ($results == 1) {
     echo ("<h3>Confirmation de la création d'un lien union</h3>");
     echo("<ul>");
     echo ("<li>famille_id = " . $famille_id . "</li>");
     echo ("<li>homme_id = " . $homme_id . "</li>");
     echo ("<li>femme_id = " . $femme_id . "</li>");
     echo ("<li>lien_type = " . $_GET['union_type'] . "</li>");
     echo ("<li>lien_date = " . $_GET['union_date'] . "</li>");
     echo ("<li>lien_lieu = " . $_GET['union_lieu'] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème de création du lien</h3>");
     echo ("<h4>Vérifier qu'il n'y a pas de lien de parenté entre les individus</h4>");
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    