<?php

require_once('dbconfig.php');

class SLIDER {

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

    public function addslide($slide_title,$slide_custom_title,$slide_description,$slide_button_text,$slide_button_link,$slide_new_window,$slide_image) {
        try {
            $file_name = $this->_file_upload($slide_image);
            $stmt = $this->conn->prepare("INSERT INTO slider
                                                        (slide_title,slide_custom_title,slide_description,slide_button_text,slide_button_link,slide_new_window,slide_image) 
                                                        VALUES
                                                        (:title,:custom_title,:description,:button_text,:button_link,:new_window,:image)");

            $stmt->bindparam(":title", $slide_title);
            $stmt->bindparam(":custom_title", $slide_custom_title);
            $stmt->bindparam(":description", $slide_description);
            $stmt->bindparam(":button_text", $slide_button_text);
            $stmt->bindparam(":button_link", $slide_button_link);
            $stmt->bindparam(":new_window", $slide_new_window);
            $stmt->bindparam(":image", $file_name);

            $stmt->execute();

            return TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete_slide($id){
        $statement = $this->conn->prepare("DELETE from slider WHERE slide_id=$id");
        $delete = $statement->execute();
        if($delete){
            return TRUE;
        }else{
            return false;
        }
        
    }
        
    public function details($slide_id){
        $sql = "SELECT * FROM slider WHERE slide_id=$slide_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
           return $row;
       }else{
           return FALSE;
       }
    }
    
    public function update($slide_id){
            $sql = "SELECT * FROM slider WHERE slide_id=$slide_id";
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
        $sql = "SELECT slide_image FROM slider WHERE slide_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row[0]['slide_image'];
           }else{
               return FALSE;
           }
    }
    
    
    
      
    
     public function update_save($slide_title,$slide_custom_title,$slide_description,$slide_button_text,$slide_button_link,$slide_new_window,$slide_image,$slide_id) {
        try {
           
            if($slide_image['name']==""){
                $file_name = $this->selectimage($slide_id); 
            }else{
               $file_name = $this->_file_upload($slide_image);
            }
           
            $query = 'UPDATE slider 
                 SET
                   slide_title = :title,
                   slide_custom_title = :ctitle,
                   slide_description = :sdes,
                   slide_button_text = :bt,
                   slide_button_link = :bl,
                   slide_new_window = :nw,
                   slide_image = :simage
                   WHERE 
                   slide_id = :sid';
            
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':sid', $slide_id);
                    $stmt->bindParam(':title', $slide_title);
                    $stmt->bindParam(':ctitle', $slide_custom_title);
                    $stmt->bindParam(':sdes', $slide_description);
                    $stmt->bindParam(':bt', $slide_button_text);
                    $stmt->bindParam(':bl', $slide_button_link);
                    $stmt->bindParam(':nw', $slide_new_window);
                    $stmt->bindParam(':simage', $file_name);

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