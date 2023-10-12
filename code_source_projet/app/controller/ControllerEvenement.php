
<!-- ----- debut ControllerEvenement -->
<?php
require_once '../model/ModelEvenement.php';
require_once '../model/ModelIndividu.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ControllerEvenement {
 // --- page d'accueil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewProjetAccueil.php';
  if (DEBUG)
   echo ("ControllerEvenement : projetAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des Evenements
 public static function EvenementReadAll() {
  $results = ModelEvenement::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/evenement/viewAll.php';
  if (DEBUG)
   echo ("ControllerEvenement : EvenementReadAll : vue = $vue");
  require ($vue);
 }
 
 public static function EvenementReadSelected() {
  if(!isset($_SESSION)){
      session_start();
    }
  $results = ModelEvenement::getOne($_SESSION["SESSION_famille_selected_id"]);
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/evenement/viewAll.php';
  if (DEBUG)
   echo ("ControllerEvenement : EvenementReadAll : vue = $vue");
  require ($vue);
 }


 // Affiche le formulaire de creation d'un Evenement
 public static function evenementCreate() {
  if(!isset($_SESSION)){
      session_start();
    }
  $liste_noms = ModelIndividu::getAllNames($_SESSION["SESSION_famille_selected_id"]);
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/evenement/viewInsert.php';
  require ($vue);
 }


 // La clé est gérée par le systeme et pas par l'internaute
 public static function evenementCreated() {
     
  // Affectation de l'ID de famille
  if(!isset($_SESSION)){
      session_start();
    }
  $famille_id = $_SESSION['SESSION_famille_selected_id'];
  
  // On cherche l'id du prenom sélectionné
  $nometprenom = explode(" ",$_GET['nom']);

  // Méthode qui prend en compte les noms composés pour ne sélectionner que le nom
  foreach ($nometprenom as $mot){
      if (preg_match('/[a-z]/', $mot) == 1) {$prenom[] = $mot;}}
  $prenom = implode(" ", $prenom);
  
  // Récupération de l'id d'un individu avec son prénom
  $individu_id = ModelIndividu::getIdFromPrenom($prenom, $famille_id);

  // Vérification de la validité du format de la date 
  if ( preg_match(" #^[0-9]{4}[-][0-9]{2}[-][0-9]{2}# ", $_GET["event_date"]) == 1){
      if (ModelEvenement::VerifLogiqueEvent($famille_id,$individu_id,$_GET['event_type']) == TRUE){
          // ajouter une validation des informations du formulaire
          $event_id = ModelEvenement::insert($famille_id,$individu_id);
      }
  }
  

  

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/evenement/viewInserted.php';
  require ($vue);
 }
 

}
?>
<!-- ----- fin ControllerEvenement -->


