<?php

require_once('dbconfig.php');

class DOCCAT {

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

    public function _file_upload($image) {

        $file_name = $image['name'];
        $file_type = $image['type'];
        $tmp_name = $image['tmp_name'];
        $error = $image['error'];
        $file_size = $image['size'];

        $errors = array();

        if ($file_size > 221569) {
            $error[] = "files must be below .5MB";
        }
        $extensions = array("jpg", "png", "gif");
        $extn = explode(".", $file_name);
        $ext = strtolower(end($extn));
        if (in_array($ext, $extensions) == false) {

            $errors[] = "entention is not allowed";
        }
        $newfilename = rand(0,9000).time().$file_name;
        
        if (empty($errors) == true) {
            move_uploaded_file($tmp_name, "uploads/" . $newfilename);
            return $newfilename;
        } else {
            return $errors;
        }
    }

    public function adddoccat($dcat_name, $dcat_desctiption) {
        try {
            
            $stmt = $this->conn->prepare("INSERT INTO doccategory
                                                        (dcat_name,dcat_desctiption) 
                                                        VALUES
                                                        (:dc_name,:dc_des)");

            $stmt->bindparam(":dc_name", $dcat_name);
            $stmt->bindparam(":dc_des", $dcat_desctiption);
            
            $stmt->execute();

            return TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    
    public function delete($id){
        $statement = $this->conn->prepare("DELETE from doccategory WHERE dcat_id=$id");
        $delete = $statement->execute();
        if($delete){
            return TRUE;
        }else{
            return false;
        }  
    }
    public function  details($id){
        $sql = "SELECT * FROM doccategory WHERE dcat_id=$id";
        $smt = $this->conn->prepare($sql);
        $smt->execute();
        $row=$smt->fetch(PDO::FETCH_ASSOC);
        if($smt->rowCount()){
            return $row;
        }else{
           return FALSE; 
        }
        
    }
    
    
    public function redirect($url) {
        header("Location: $url");
    }

}

?>