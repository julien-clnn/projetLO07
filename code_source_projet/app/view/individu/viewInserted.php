
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
    if ($id) {
     echo ("<h3>Confirmation de la création d'un individu</h3>");
     echo("<ul>");
     echo ("<li>famille_id = " . $famille_id . "</li>");
     echo ("<li>id = " . $id . "</li>");
     echo ("<li>nom = " . $nom . "</li>");
     echo ("<li>prenom = " . $prenom . "</li>");
     echo ("<li>sexe = " . $_GET['radio'] . "</li>");
     echo ("<li>pere = 0</li>");
     echo ("<li>mere = 0</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème de création de l'individu</h3>");
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    