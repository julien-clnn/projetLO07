
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

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">id</th>
          <th scope = "col">nom</th>
        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des familles est dans une variable $results             
          foreach ($results as $element) {
           printf("<tr><td>%d</td><td>%s</td></tr>", $element->getId(), $element->getNom());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  