
<!-- ----- debut ControllerIndividu -->
<?php
require_once '../model/ModelIndividu.php';
require_once '../model/ModelEvenement.php';
require_once '../model/ModelLien.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ControllerIndividu {
    
 // Affiche les Individus de la famille selctionnée
 public static function IndividuReadSelected() {
  //On récupère les valeurs
  if(!isset($_SESSION)){
      session_start();
    }
  $results = ModelIndividu::getOne($_SESSION["SESSION_famille_selected_id"]);
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/individu/viewAll.php';
  if (DEBUG)
   echo ("ControllerIndividu : IndividuReadAll : vue = $vue");
  require ($vue);
 }

 // Affiche le formulaire de creation d'un Evenement
 public static function individuCreate() {
  if(!isset($_SESSION)){
      session_start();
    }
  $liste_noms = ModelIndividu::getAllNames($_SESSION["SESSION_famille_selected_id"]);
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/individu/viewInsert.php';
  require ($vue);
 }
 
 public static function individuCreated() {
     
  // Affectation de l'ID de famille
  if(!isset($_SESSION)){
      session_start();
    }
  $famille_id = $_SESSION['SESSION_famille_selected_id'];
  
  // On adapte l'entrée de l'utilisateur à notre DB
  $nom = strtoupper($_GET['nom']);
  $prenom = strtolower($_GET['prenom']);

  // ajouter une validation des informations du formulaire
  $id = ModelIndividu::insert($famille_id,$nom,$prenom);


  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/individu/viewInserted.php';
  require ($vue);
 }
 
 public static function individuSelect() {
  if(!isset($_SESSION)){
      session_start();
    }
  $liste_noms = ModelIndividu::getAllNames($_SESSION["SESSION_famille_selected_id"]);
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/individu/viewSelect.php';
  require ($vue);
 }
 
 public static function individuPage() {
  // On récupère sa famille
     if(!isset($_SESSION)){
      session_start();
    }
     $famille_id = $_SESSION['SESSION_famille_selected_id'];
  
  // On récupère son prénom et son id
     $nometprenom = explode(" ",$_GET['nom']);
     $prenom = [];
     foreach ($nometprenom as $mot){
        if (preg_match('/[a-z]/', $mot) == 1) {$prenom[] = $mot;}}
     $prenom = implode(" ", $prenom);
     $individu_id = ModelIndividu::getIdFromPrenom($prenom, $famille_id);
     
     
  // Obtention des événements
     $liste_events = ModelEvenement::getAllEventsFromId($famille_id,$individu_id);
     
  // Obtention des parents
     $liste_parents = ModelIndividu::getParentsFromId($famille_id,$individu_id);
     if ($liste_parents[0]['sexe'] == 'F'){
         $inter=$liste_parents[0];
         $liste_parents[0]=$liste_parents[1];
         $liste_parents[1]=$inter;
     }
     if (!isset($liste_parents[0])){
         $liste_parents[0] = null;
     }
     if (!isset($liste_parents[1])){
         $liste_parents[1] = null;
     }
     
  // Obtention des unions
     $liste_unions = ModelLien::getAllUnionsFromId($famille_id,$individu_id);
     
  // Obtention des enfants en fonction des unions
     $liste_unions_second = [];
     foreach($liste_unions as $union){
         // On donne la bonne valeur d'id a celle de la personne avec qui on est en union
         if($union['iid1']==$individu_id){
             $union_id = $union['iid2'];
         }
         else{
             $union_id = $union['iid1'];
         }
         
         // On associe a chaque union une liste d'enfants
         if (ModelIndividu::getSexeFromId($famille_id, $individu_id)=='H'){
             $id_pere = $individu_id;
             $id_mere = $union_id;
         }
         else{
             $id_pere = $union_id;
             $id_mere = $individu_id;
         }
         $union['enfants'] = ModelIndividu::getEnfantsFromUnions($famille_id,$id_pere,$id_mere);
         $union['nometprenom'] = ModelIndividu::getNomPrenomFromId($famille_id, $union_id);
         
         // On ajoute les valeurs récupérés pour chaque union dans une table
         $liste_unions_second[] = $union;
         
     }
     
  
  
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/individu/viewPage.php';
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerProducteur -->


