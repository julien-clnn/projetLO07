
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.php');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    if (isset($famille_id)){
        $_SESSION["SESSION_famille_selected"]= strtoupper($_GET['nom']);
        $_SESSION["SESSION_famille_selected_id"]=$famille_id;
    }
    include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php
    if (isset($famille_id)) {
     echo ("<h3>La nouvelle famille a été ajoutée </h3>");
     echo("<ul>");
     echo ("<li>id = " . $famille_id . "</li>");
     echo ("<li>nom = " . $_SESSION["SESSION_famille_selected"] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion de la famille</h3>");
     echo ("<h4>Vérifier que le nom ne contient pas de caractères spéciaux</h4>");
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    