
<!-- ----- debut ModelEvenement -->

<?php
require_once 'Model.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ModelEvenement {

    private $famille_id, $id, $iid, $event_type, $event_date, $event_lieu;

    public function __construct($famille_id = NULL, $id = NULL, $iid = NULL, $event_type = NULL, $event_date = NULL, $event_lieu = NULL) {
        if (!is_null($id)){
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->iid = $iid;
            $this->event_type = $event_type;
            $this->event_date = $event_date;
            $this->event_lieu = $event_lieu; 
        }
              
    }
    
    public function getFamille_id() {
        return $this->famille_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getIid() {
        return $this->iid;
    }

    public function getEvent_type() {
        return $this->event_type;
    }

    public function getEvent_date() {
        return $this->event_date;
    }

    public function getEvent_lieu() {
        return $this->event_lieu;
    }

    public function setFamille_id($famille_id) {
        $this->famille_id = $famille_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIid($iid) {
        $this->iid = $iid;
    }

    public function setEvent_type($event_type) {
        $this->event_type = $event_type;
    }

    public function setEvent_date($event_date) {
        $this->event_date = $event_date;
    }

    public function setEvent_lieu($event_lieu) {
        $this->event_lieu = $event_lieu;
    }

    
    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from evenement where famille_id=:";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelEvenement");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function getOne($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from evenement where famille_id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelEvenement");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($famille_id,$individu_id) { // On ne demande pas les IDs, on les détermine après, sauf famille qui est stocké avec la session
        try {
            $database = Model::getInstance();
           
            // Détermination de l'ID de l'event
            $query = "select max(id) from evenement where famille_id = :famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id
            ]);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into evenement value (:famille_id, :id, :iid, :event_type, :event_date, :event_lieu)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $id,
                'iid' => $individu_id,
                'event_type' => $_GET['event_type'],
                'event_date' => $_GET['event_date'],
                'event_lieu' => $_GET['event_lieu']
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
    
    public static function getAllEventsFromId($famille_id,$individu_id) {
        try {
            $database = Model::getInstance();
            $query = "select * from evenement where famille_id = :famille_id and iid = :iid";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'iid' => $individu_id
            ]);
            $results = $statement->fetchAll();
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    
    public static function VerifLogiqueEvent($famille_id,$individu_id,$event_type) {
        try {
            $database = Model::getInstance();
            $query = "select event_type from evenement where famille_id = :famille_id and (iid = :iid and event_type = :event_type)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'iid' => $individu_id,
                'event_type' => $event_type
            ]);
            $results = $statement->fetchAll();
            if (empty($results)){
                return TRUE;
            }
            else{
                return FALSE;
            }
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
<!-- ----- fin ModelEvenement -->

