<?php

require_once('dbconfig.php');

class DONATE {

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

    public function adddonate($donate_title,$donate_description,$donate_button_text,$donate_button_link,$donate_image) {
        try {
            $file_name = $this->_file_upload($donate_image);
            $stmt = $this->conn->prepare("INSERT INTO donate
                                                        (donate_title,donate_description,donate_button_text,donate_button_link,donate_image) 
                                                        VALUES
                                                        (:title,:description,:text,:link,:image)");

            $stmt->bindparam(":title", $donate_title);
            $stmt->bindparam(":description", $donate_description);
            $stmt->bindparam(":text", $donate_button_text);
            $stmt->bindparam(":link", $donate_button_link);
            $stmt->bindparam(":image", $file_name);

            $stmt->execute();

            return TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete_donate($id){
        $statement = $this->conn->prepare("DELETE from donate WHERE donate_id=$id");
        $delete = $statement->execute();
        if($delete){
            return TRUE;
        }else{
            return false;
        }
        
    }
        
    public function details($donate_id){
        $sql = "SELECT * FROM donate WHERE donate_id=$donate_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
           return $row;
       }else{
           return FALSE;
       }
    }
    
    public function update($donate_id){
            $sql = "SELECT * FROM donate WHERE donate_id=$donate_id";
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
        $sql = "SELECT donate_image FROM donate WHERE donate_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row[0]['donate_image'];
           }else{
               return FALSE;
           }
    }
    
    
    
      
    
     public function update_save($donate_title,$donate_description,$donate_button_text,$donate_button_link,$donate_image,$donate_id) {
        try {
           
            if($donate_image['name']==""){
                $file_name = $this->selectimage($donate_id); 
            }else{
               $file_name = $this->_file_upload($donate_image);
            }
           
            $query = 'UPDATE donate 
                 SET
                   
                   donate_title = :title,
                   donate_description = :ddes,
                   donate_button_text = :dtext,
                   donate_button_link = :dlink,
                   donate_image = :dimage
                   WHERE 
                   donate_id = :did';
            
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':did', $donate_id);
                    $stmt->bindParam(':title', $donate_title);
                    $stmt->bindParam(':ddes', $donate_description);
                    $stmt->bindParam(':dtext', $donate_button_text);
                    $stmt->bindParam(':dlink', $donate_button_link);
                    $stmt->bindParam(':dimage', $file_name);

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