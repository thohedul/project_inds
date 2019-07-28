<?php

require_once('dbconfig.php');

class PAGES {

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

    public function addpage($page_title,$page_description,$page_category,$page_slug,$page_image) {
        try {
            $file_name = $this->_file_upload($page_image);
            $stmt = $this->conn->prepare("INSERT INTO pages
                                                        (page_title,page_description,page_category,page_slug,page_image) 
                                                        VALUES
                                                        (:title,:description,:category,:slug,:image)");

            $stmt->bindparam(":title", $page_title);
            $stmt->bindparam(":description", $page_description);
            $stmt->bindparam(":category", $page_category);
            $stmt->bindparam(":slug", $page_slug);
            $stmt->bindparam(":image", $file_name);

            $stmt->execute();

            return TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete_page($id){
        $statement = $this->conn->prepare("DELETE from pages WHERE page_id=$id");
        $delete = $statement->execute();
        if($delete){
            return TRUE;
        }else{
            return false;
        }
        
    }
        
    public function details($page_id){
        $sql = "SELECT * FROM pages WHERE page_id=$page_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
           return $row;
       }else{
           return FALSE;
       }
    }
    
    public function update($page_id){
            $sql = "SELECT * FROM pages WHERE page_id=$page_id";
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
        $sql = "SELECT page_image FROM pages WHERE page_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchALL(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row[0]['page_image'];
           }else{
               return FALSE;
           }
    }
    
    
    
      
    
     public function update_save($page_title,$page_description,$page_category,$page_slug,$page_image,$page_id) {
        try {
           
            if($page_image['name']==""){
                $file_name = $this->selectimage($page_id); 
            }else{
               $file_name = $this->_file_upload($page_image);
            }
           
            $query = 'UPDATE pages 
                 SET
                   page_title = :title,
                   page_description = :pdes,
                   page_category = :pcat,
                   page_slug = :pslug,
                   page_image = :pimage
                   WHERE 
                   page_id = :pid';
            
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':pid', $page_id);
                    $stmt->bindParam(':title', $page_title);
                    $stmt->bindParam(':pdes', $page_description);
                    $stmt->bindParam(':pcat', $page_category);
                    $stmt->bindParam(':pslug', $page_slug);
                    $stmt->bindParam(':pimage', $file_name);

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