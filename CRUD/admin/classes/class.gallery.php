<?php

require_once('dbconfig.php');

class GALLERYS {

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

    public function addgallerys($gallery_title,$gallery_custom_title,$gallery_new_window,$gallery_image) {
        try {
            $file_name = $this->_file_upload($gallery_image);
            $stmt = $this->conn->prepare("INSERT INTO gallerys
                                                        (gallery_title,gallery_custom_title,gallery_new_window,gallery_image) 
                                                        VALUES
                                                        (:title,:ctitle,:window,:gimage)");

            $stmt->bindparam(":title", $gallery_title);
            $stmt->bindparam(":ctitle", $gallery_custom_title);
            $stmt->bindparam(":window", $gallery_new_window);
            $stmt->bindparam(":gimage", $file_name);

            $stmt->execute();

            return TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete_gallerys($id){
        $statement = $this->conn->prepare("DELETE from gallerys WHERE gallery_id=$id");
        $delete = $statement->execute();
        if($delete){
            return TRUE;
        }else{
            return false;
        }
        
    }
        
    public function details($gallery_id){
        $sql = "SELECT * FROM gallerys WHERE gallery_id=$gallery_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
           return $row;
       }else{
           return FALSE;
       }
    }
    
    public function update($gallery_id){
            $sql = "SELECT * FROM gallerys WHERE gallery_id=$gallery_id";
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
        $sql = "SELECT gallery_image FROM gallerys WHERE gallery_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row[0]['gallery_image'];
           }else{
               return FALSE;
           }
    }
    
    
    
      
    
     public function update_save($gallery_title,$gallery_custom_title,$gallery_image,$gallery_new_window,$gallery_id) {
        try {
           
            if($gallery_image['name']==""){
                $file_name = $this->selectimage($gallery_id); 
            }else{
               $file_name = $this->_file_upload($gallery_image);
            }
           
            $query = 'UPDATE gallerys
                 SET
                   
                   gallery_title = :title,
                   gallery_custom_title = :gactitle,
                   gallery_new_window = :gawindow,                
                   gallery_image = :gaimage
                   WHERE 
                   gallery_id = :gaid';
            
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':gaid', $gallery_id);
                    $stmt->bindParam(':title', $gallery_title);
                    $stmt->bindParam(':gactitle', $gallery_custom_title);
                    $stmt->bindParam(':gawindow', $gallery_new_window);
                    $stmt->bindParam(':gaimage', $file_name);

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