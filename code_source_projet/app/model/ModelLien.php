
<!-- ----- debut ModelProducteur -->

<?php
require_once 'Model.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ModelLien {

    private $famille_id, $id, $iid1, $iid2, $lien_type, $lien_date, $lien_lieu;
    
    public function __construct($famille_id = NULL, $id = NULL, $iid1 = NULL, $iid2 = NULL, $lien_type = NULL, $lien_date = NULL, $lien_lieu = NULL) {
        if (!is_null($famille_id)){
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->iid1 = $iid1;
            $this->iid2 = $iid2;
            $this->lien_type = $lien_type;
            $this->lien_date = $lien_date;
            $this->lien_lieu = $lien_lieu;
        }
    }

    public function getFamille_id() {
        return $this->famille_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getIid1() {
        return $this->iid1;
    }

    public function getIid2() {
        return $this->iid2;
    }

    public function getLien_type() {
        return $this->lien_type;
    }

    public function getLien_date() {
        return $this->lien_date;
    }

    public function getLien_lieu() {
        return $this->lien_lieu;
    }

    public function setFamille_id($famille_id) {
        $this->famille_id = $famille_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIid1($iid1) {
        $this->iid1 = $iid1;
    }

    public function setIid2($iid2) {
        $this->iid2 = $iid2;
    }

    public function setLien_type($lien_type) {
        $this->lien_type = $lien_type;
    }

    public function setLien_date($lien_date) {
        $this->lien_date = $lien_date;
    }

    public function setLien_lieu($lien_lieu) {
        $this->lien_lieu = $lien_lieu;
    }

       
    public static function getOne($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from lien where famille_id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLien");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
   public static function insert_union($famille_id,$homme_id,$femme_id) { // On ne demande pas les IDs, on les détermine après, sauf famille qui est stocké avec la session
        try {
            $database = Model::getInstance();
           
            // Détermination de l'ID de l'event
            $query = "select max(id) from lien where famille_id = :famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into lien value (:famille_id, :id, :iid1, :iid2, :lien_type, :lien_date, :lien_lieu)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id,
                'iid1' => $homme_id,
                'iid2' => $femme_id,
                'lien_type' => $_GET['union_type'],
                'lien_date' => $_GET['union_date'],
                'lien_lieu' => $_GET['union_lieu']
            ]);
            return 1;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
    
    public static function GetAllUnionsFromId($famille_id,$individu_id) {
        try {
            $database = Model::getInstance();
            $query = "select * from lien where famille_id = :famille_id and (iid1 = :id or iid2= :id)";
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
}
?>
<!-- ----- fin ModelProducteur -->

