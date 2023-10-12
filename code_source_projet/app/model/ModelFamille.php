
<!-- ----- debut ModelFamille -->

<?php
require_once 'Model.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class ModelFamille {
 private $id, $nom;

 // pas possible d'avoir 2 constructeurs
 public function __construct($id = NULL, $nom = NULL) {
     
    if (!is_null($id)){
     $this->id = $id;
     $this->nom = $nom; 
    }
 }
 
 public function getId() {
     return $this->id;
 }

 public function getNom() {
     return $this->nom;
 }

 public function setId($id) {
     $this->id = $id;
 }

 public function setNom($nom) {
     $this->nom = $nom;
 }


// retourne une liste des id
 public static function getAllNames() {
  try {
   $database = Model::getInstance();
   $query = "select nom from famille";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }


 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from famille";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamille");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($nom) {
  try {
   $database = Model::getInstance();
   $query = "select * from famille where nom = :nom";
   $statement = $database->prepare($query);
   $statement->execute([
     'nom' => $nom
   ]);
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamille");
  
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function insert($nom) {
  try {
   $database = Model::getInstance();

   // recherche de la valeur de la clé = max(id) + 1
   $query = "select max(id) from famille";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;
   echo("id = $id");

   // ajout d'un nouveau tuple;
   $query = "insert into famille value (:id, :nom)";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id,
     'nom' => $nom
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

   
}
?>
<!-- ----- fin ModelFamille -->
