<?php

require_once('dbconfig.php');

class ABOUTES {

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

    public function addaboutes($aboutes_title,$aboutes_description,$aboutes_button_text,$aboutes_button_link,$aboutes_image) {
        try {
            $file_name = $this->_file_upload($aboutes_image);
            $stmt = $this->conn->prepare("INSERT INTO aboutes
                                                        (aboutes_title,aboutes_description,aboutes_button_text,aboutes_button_link,aboutes_image) 
                                                        VALUES
                                                        (:title,:description,:text,:link,:image)");

            $stmt->bindparam(":title", $aboutes_title);
            $stmt->bindparam(":description", $aboutes_description);
            $stmt->bindparam(":text", $aboutes_button_text);
            $stmt->bindparam(":link", $aboutes_button_link);
            $stmt->bindparam(":image", $file_name);

            $stmt->execute();

            return TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete_aboutes($id){
        $statement = $this->conn->prepare("DELETE from aboutes WHERE aboutes_id=$id");
        $delete = $statement->execute();
        if($delete){
            return TRUE;
        }else{
            return false;
        }
        
    }
        
    public function details($aboutes_id){
        $sql = "SELECT * FROM aboutes WHERE aboutes_id=$aboutes_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
           return $row;
       }else{
           return FALSE;
       }
    }
    
    public function update($aboutes_id){
            $sql = "SELECT * FROM aboutes WHERE aboutes_id=$aboutes_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row;
           }else{
               return FALSE;
           }
        }
    
    public function selectimage($id){
        $sql = "SELECT aboutes_image FROM aboutes WHERE aboutes_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row[0]['aboutes_image'];
           }else{
               return FALSE;
           }
    }
    
    
    
      
    
     public function update_save($aboutes_title,$aboutes_description,$aboutes_button_text,$aboutes_button_link,$aboutes_image,$aboutes_id) {
        try {
           
            if($aboutes_image['name']==""){
                $file_name = $this->selectimage($aboutes_id); 
            }else{
               $file_name = $this->_file_upload($aboutes_image);
            }
           
            $query = 'UPDATE aboutes
                 SET
                   
                   aboutes_title = :title,
                   aboutes_description = :ades,
                   aboutes_button_text = :atext,
                   aboutes_button_link = :alink,
                   aboutes_image = :aimage
                   WHERE 
                   aboutes_id = :aid';
            
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':aid', $aboutes_id);
                    $stmt->bindParam(':title', $aboutes_title);
                    $stmt->bindParam(':ades', $aboutes_description);
                    $stmt->bindParam(':atext', $aboutes_button_text);
                    $stmt->bindParam(':alink', $aboutes_button_link);
                    $stmt->bindParam(':aimage', $file_name);

            $result = $stmt->execute();
            if($result){
                return TRUE;
            }else{
                return FALSE;
            }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }   
        
        
    public function redirect($url) {
        header("Location: $url");
    }

}


?>