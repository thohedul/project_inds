<?php

require_once('dbconfig.php');

class FRONTEND {

    private $conn;

    public function __construct() {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    
    public function details($slug){
        $sql = "SELECT * FROM posts WHERE post_slug='".$slug."'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
           return $row;
       }else{
           return FALSE;
       }
    }
    
       public function selectcatname($id){
           $sql = "SELECT postcat_title FROM postcategory WHERE postcat_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row['postcat_title'];
           }else{
               return FALSE;
           }
    } 
        
    public function redirect($url) {
        header("Location: $url");
    }

}

?>