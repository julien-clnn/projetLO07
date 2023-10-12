
<!-- ----- debut ControllerFamille -->
<?php
require_once '../model/ModelFamille.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class ControllerFamille {
 // --- page d'accueil
 public static function projetAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewProjetAccueil.php';
  if (DEBUG)
   echo ("ControllerFamille : projetAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des familles
 public static function familleReadAll() {
  $results = ModelFamille::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewAll.php';
  if (DEBUG)
   echo ("ControllerFamille : familleReadAll : vue = $vue");
  require ($vue);
 }

 // --- Affiche un formulaire pour sélectionner un nom qui existe
 public static function familleReadName() {
  $results = ModelFamille::getAllNames();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewName.php';
  require ($vue);
 }

 // Affiche un famille particulier 
 public static function familleReadOne() {
  if(!isset($_SESSION)){
      session_start();
    }

  // --- On récupère le nom rempli dans le formulaire
  $famille_name = $_GET['nom'];
  $results = ModelFamille::getOne($famille_name);
  $famille_id = $results['0']->getId();
  
  // --- On stocke dans nos variables de sessions : FAMILLE + ID
  $_SESSION["SESSION_famille_selected"]=$famille_name;
  $_SESSION["SESSION_famille_selected_id"]=$famille_id;
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewAll.php';
  require ($vue);
 }
 
 // Affiche le formulaire de creation d'un famille
 public static function familleCreate() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'une nouvelle famille.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function familleCreated() {
  // ajouter une validation des informations du formulaire
  if (!preg_match('#[0-9&~\"\#\'{}\[\]()\|`_\^@°=+*/<>?,.;:!§¨£\$%€ß·’“”«»•–—±×÷²³†‡¢¥™©®ª×÷¼½¾¿¶¸º¯…¦≠¬ˆ‰]#', $_GET['nom'])){
     $famille_id = ModelFamille::insert(htmlspecialchars(strtoupper($_GET['nom']))); 
  }
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewInserted.php';
  require ($vue);
 }
 
}
?>
<!-- ----- fin ControllerFamille -->


