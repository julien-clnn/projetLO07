
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
     echo ("<h3>Confirmation de la création d'un lien parental</h3>");
     echo("<ul>");
     echo ("<li>famille_id = " . $famille_id . "</li>");
     echo ("<li>enfant_id = " . $enfant_id . "</li>");
     echo ("<li>parent_id = " . $parent_id . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème de création du lien</h3>");
     echo ("<h4>Vérifier que le parent n'est pas le même individu que l'enfant</h4>");
     echo ("<h4>Vérifier que le parent n'est pas l'enfant du parent</h4>");
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    