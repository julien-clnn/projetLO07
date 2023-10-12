
<!-- ----- debut ModelProducteur -->

<?php
require_once 'Model.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ModelIndividu {

    private $famille_id, $id, $nom, $prenom, $sexe, $pere, $mere;
    
    public function __construct($famille_id = NULL, $id = NULL, $nom = NULL, $prenom = NULL, $sexe = NULL, $pere = NULL, $mere = NULL) {
        if (!is_null($famille_id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->sexe = $sexe;
            $this->pere = $pere;
            $this->mere = $mere; 
        }
    }
    
    public function getFamille_id() {
        return $this->famille_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function getPere() {
        return $this->pere;
    }

    public function getMere() {
        return $this->mere;
    }

    public function setFamille_id($famille_id){
        $this->famille_id = $famille_id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function setSexe($sexe){
        $this->sexe = $sexe;
    }

    public function setPere($pere){
        $this->pere = $pere;
    }

    public function setMere($mere){
        $this->mere = $mere;
    }

    public static function getAllNames($famille_id) {
        try {
         $database = Model::getInstance();
         $query = "select nom,prenom from individu where famille_id = :famille_id";
         $statement = $database->prepare($query);
         $statement->execute([
             'famille_id' => $famille_id
         ]);
         $results = $statement->fetchAll();
         return $results;
        } catch (PDOException $e) {
         printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
         return NULL;
        }
       }
       
    public static function getIdFromPrenom($prenom,$famille_id) {
        try {
         $database = Model::getInstance();
         $query = "select id from individu where prenom = :prenom and famille_id = :famille_id";
         $statement = $database->prepare($query);
         $statement->execute([
             'prenom' => $prenom,
             'famille_id' => $famille_id
         ]);
         $results = $statement->fetch();
         return $results['id'];
        } catch (PDOException $e) {
         printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
         return NULL;
        }
       }
       
    public static function getOne($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where famille_id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getSexeFromId($famille_id, $id) {
        try {
         $database = Model::getInstance();
         $query = "select sexe from individu where famille_id = :famille_id and id = :id";
         $statement = $database->prepare($query);
         $statement->execute([
             'famille_id' => $famille_id,
             'id' => $id
         ]);
         $results = $statement->fetch(); // Marche aussi avec un Model Individu
         return $results['sexe'];
        } catch (PDOException $e) {
         printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
         return NULL;
        }
       }
       
    public static function update_individu($famille_id, $id, $parent_id, $sexe) {
        try {
            
            // On ajuste la requete en fonction de si c'est un père ou une mère
            if($sexe=='H'){
                $query = "UPDATE individu SET pere = :parent WHERE famille_id = :famille_id AND id = :id";
            }
            else {
                $query = "UPDATE individu SET mere = :parent WHERE famille_id = :famille_id AND id = :id";
            }
            
            $database = Model::getInstance();
            $statement = $database->prepare($query);
            $statement->execute([
                'parent' => $parent_id,
                'famille_id' => $famille_id,
                'id' => $id
            ]);
            return 1;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
    
    public static function getAllHommes($famille_id) {
        try {
         $database = Model::getInstance();
         $query = "select nom,prenom from individu where famille_id = :famille_id and sexe = 'H'";
         $statement = $database->prepare($query);
         $statement->execute([
             'famille_id' => $famille_id
         ]);
         $results = $statement->fetchAll();
         return $results;
        } catch (PDOException $e) {
         printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
         return NULL;
        }
    }
       
    public static function getAllFemmes($famille_id) {
        try {
         $database = Model::getInstance();
         $query = "select nom,prenom from individu where famille_id = :famille_id and sexe = 'F'";
         $statement = $database->prepare($query);
         $statement->execute([
             'famille_id' => $famille_id
         ]);
         $results = $statement->fetchAll();
         return $results;
        } catch (PDOException $e) {
         printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
         return NULL;
        }
    }
    
    public static function insert($famille_id,$nom,$prenom) { // On ne demande pas les IDs, on les détermine après, sauf famille qui est stocké avec la session
        try {
            $database = Model::getInstance();
           
            // Détermination de l'ID de l'individu
            $query = "select max(id) from individu where famille_id = :famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;
            

            // ajout d'un nouveau tuple;
            $query = "insert into individu value (:famille_id, :id, :nom, :prenom, :sexe, :pere, :mere)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'sexe' => $_GET['radio'],
                'pere' => 0,
                'mere' => 0
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
    
    public static function getParentsFromId($famille_id,$individu_id) {
        try {
            // Récupération des ids des parents
            $database = Model::getInstance();
            $query = "select pere,mere from individu where famille_id = :famille_id and id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $individu_id
            ]);
            $id_parents = $statement->fetchAll();

            // Récupération des noms des parents
            $database = Model::getInstance();
            $query = "select * from individu where famille_id = :famille_id and (id = :id1 or id = :id2)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id1' => $id_parents[0]['pere'],
                'id2' => $id_parents[0]['mere'], 
            ]);
            $results = $statement->fetchAll();
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getEnfantsFromUnions($famille_id,$id_pere,$id_mere) {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where famille_id = :famille_id and (pere = :id_pere and mere = :id_mere)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id_pere' => $id_pere,
                'id_mere' => $id_mere
            ]);
            $results = $statement->fetchAll();
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getNomPrenomFromId($famille_id,$individu_id) {
        try {
         $database = Model::getInstance();
         $query = "select nom,prenom from individu where famille_id = :famille_id and id = :id";
         $statement = $database->prepare($query);
         $statement->execute([
             'famille_id' => $famille_id,
             'id' => $individu_id
         ]);
         $results = $statement->fetchAll();
         return $results;
        } catch (PDOException $e) {
         printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
         return NULL;
        }
       }
       
                      
    public static function VerifLogiqueParent($famille_id,$parent_id,$enfant_id) {
        try {
            $database = Model::getInstance();
            $query = "select pere,mere from individu where famille_id = :famille_id and id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $parent_id,
            ]);
            $results = $statement->fetchAll();
 
            if (empty($results) || ($results[0]['pere'] != $enfant_id && $results[0]['mere'] != $enfant_id)){
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function VerifLogiqueUnion($famille_id,$homme_id,$femme_id) {
        try {
            $database = Model::getInstance();
            // Sélection de la mère de l'homme
            $query1 = "select mere from individu where famille_id = :famille_id and id = :id";
            $statement = $database->prepare($query1);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $homme_id,
            ]);
            $results1 = $statement->fetchAll();
            
            // Sélection du père de la femme
            $query2 = "select pere from individu where famille_id = :famille_id and id = :id";
            $statement = $database->prepare($query2);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $femme_id,
            ]);
            $results2 = $statement->fetchAll();
            
            // Vérification
            if ($results1[0]['mere'] == $femme_id || $results2[0]['pere'] == $homme_id) {
                return FALSE;
            } else {
                return TRUE;
            }
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

}
?>
<!-- ----- fin ModelProducteur -->

