
<!-- ----- debut Router1 -->
<?php
require ('../controller/ControllerFamille.php');
require ('../controller/ControllerEvenement.php');
require ('../controller/ControllerLien.php');
require ('../controller/ControllerIndividu.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);


// --- Liste des méthodes autorisées
switch ($action) {
 case "familleReadAll" :
 case "familleReadOne" :
 case "familleReadName" :
 case "familleCreate" :
 case "familleCreated" :
  ControllerFamille::$action();
  break;
 case "evenementReadAll" : 
 case "evenementReadSelected" :
 case "evenementCreate" :
 case "evenementCreated" :
  ControllerEvenement::$action();
  break;
 case "lienReadSelected" :
 case "lienCreateParent" :
 case "lienCreatedParent" :
 case "lienCreateUnion" :
 case "lienCreatedUnion" :
  ControllerLien::$action();
  break;
 case "individuReadSelected" :
 case "individuCreate" :
 case "individuCreated" :
 case "individuSelect" :
 case "individuPage" :
  ControllerIndividu::$action();
  break;
 // Tache par défaut
 default:
  // --- Passage des arguments à un controller
  $action = "projetAccueil";
  ControllerFamille::$action();
}
?>
<!-- ----- Fin Router1 -->

