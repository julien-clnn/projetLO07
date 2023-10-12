
<!-- ----- debut ControllerIndividu -->
<?php
require_once '../model/ModelLien.php';
require_once '../model/ModelIndividu.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ControllerLien {
    
 // Affiche les Individus de la famille selctionnée
 public static function lienReadSelected() {
  //On récupère les valeurs
  if(!isset($_SESSION)){
      session_start();
    }
  $results = ModelLien::getOne($_SESSION["SESSION_famille_selected_id"]);
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/lien/viewAll.php';
  if (DEBUG)
   echo ("ControllerLien : LienReadAll : vue = $vue");
  require ($vue);
 }

 public static function lienCreateParent() {
  if(!isset($_SESSION)){
      session_start();
    }
  $liste_noms = ModelIndividu::getAllNames($_SESSION["SESSION_famille_selected_id"]);
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/lien/viewInsertParent.php';
  require ($vue);
 }
 
 public static function lienCreatedParent() {
  
  // Affectation de l'ID de famille
  if(!isset($_SESSION)){
      session_start();
    }
  $famille_id = $_SESSION['SESSION_famille_selected_id'];
  
  // On vérifie que la personne n'est pas elle meme ou qu'elle ne créé pas de lien de parenté avec un enfant
  if ($_GET['nom_enfant'] != $_GET['nom_parent']){
      
         // On cherche l'id du prenom sélectionné pour l'enfant
        $nometprenom = explode(" ",$_GET['nom_enfant']);
        $prenom = [];
        foreach ($nometprenom as $mot){
            if (preg_match('/[a-z]/', $mot) == 1) {$prenom[] = $mot;}}
        $prenom = implode(" ", $prenom);
        $enfant_id = ModelIndividu::getIdFromPrenom($prenom, $famille_id);

        // On cherche l'id du prenom sélectionné pour le parent
        $nometprenom = explode(" ",$_GET['nom_parent']);
        $prenom = [];
        foreach ($nometprenom as $mot){
            if (preg_match('/[a-z]/', $mot) == 1) {$prenom[] = $mot;}}
        $prenom = implode(" ", $prenom);
        $parent_id = ModelIndividu::getIdFromPrenom($prenom, $famille_id);
        
        // Pere ou mere ?
        $parent_sexe = ModelIndividu::getSexeFromId($famille_id, $parent_id);

     if(ModelIndividu::VerifLogiqueParent($famille_id,$parent_id,$enfant_id)){
        // ajouter une validation des informations du formulaire
        $results = ModelIndividu::update_individu($famille_id,$enfant_id,$parent_id,$parent_sexe); 
      }
     else{
         $results = -1;
     }
  }
  else {
      $results = -1;
  }

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/lien/viewInsertedParent.php';
  require ($vue);
 }
 
 public static function lienCreateUnion() {
  if(!isset($_SESSION)){
      session_start();
    }
  $liste_noms_hommes = ModelIndividu::getAllHommes($_SESSION["SESSION_famille_selected_id"]);
  $liste_noms_femmes = ModelIndividu::getAllFemmes($_SESSION["SESSION_famille_selected_id"]);
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/lien/viewInsertUnion.php';
  require ($vue);
 }
 
  public static function lienCreatedUnion() {
      
    // Affectation de l'ID de famille
    if(!isset($_SESSION)){
      session_start();
    }
    $famille_id = $_SESSION['SESSION_famille_selected_id'];
     
    // On cherche l'id du prenom sélectionné pour l'enfant
    $nometprenom = explode(" ",$_GET['nom_homme']);
    $prenom = [];
    foreach ($nometprenom as $mot){
        if (preg_match('/[a-z]/', $mot) == 1) {$prenom[] = $mot;}}
    $prenom = implode(" ", $prenom);
    $homme_id = ModelIndividu::getIdFromPrenom($prenom, $famille_id);

    // On cherche l'id du prenom sélectionné pour le parent
    $nometprenom = explode(" ",$_GET['nom_femme']);
    $prenom = [];
    foreach ($nometprenom as $mot){
        if (preg_match('/[a-z]/', $mot) == 1) {$prenom[] = $mot;}}
    $prenom = implode(" ", $prenom);
    $femme_id = ModelIndividu::getIdFromPrenom($prenom, $famille_id);
    
    
    if (ModelIndividu::VerifLogiqueUnion($famille_id, $homme_id, $femme_id)){
        $results = ModelLien::insert_union($famille_id,$homme_id,$femme_id);
    }
    else{
        $results = -1;
    }
    

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/lien/viewInsertedUnion.php';
  require ($vue);
 }
 
}
?>
<!-- ----- fin ControllerProducteur -->


