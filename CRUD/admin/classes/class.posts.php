<?php
require_once('dbconfig.php');

class POSTS {

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

    public function addpost($post_title,$post_description,$postcat_id,$post_image) {
        try {
            $file_name = $this->_file_upload($post_image);
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $post_title)));
            $stmt = $this->conn->prepare("INSERT INTO posts
                                                        (post_title,post_slug,post_description,postcat_id,post_image) 
                                                        VALUES
                                                        (:ptitle,:pslug,:pdescription,:pid,:pimage)");

            $stmt->bindparam(":ptitle", $post_title);
            $stmt->bindparam(":pslug", $slug);
            $stmt->bindparam(":pdescription", $post_description);
            $stmt->bindparam(":pid", $postcat_id);
            $stmt->bindparam(":pimage", $file_name);

            $stmt->execute();

            return TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addcat($postcat_title,$postcat_desctiption,$postcat_image) {
        try {
            $file_name = $this->_file_upload($postcat_image);
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $postcat_title)));
            $stmt = $this->conn->prepare("INSERT INTO postcategory
                                                        (postcat_title,postcat_slug,postcat_desctiption,postcat_image) 
                                                        VALUES
                                                        (:title,:slug,:desctiption,:cimage)");

            $stmt->bindparam(":title", $postcat_title);
            $stmt->bindparam(":slug", $slug);
            $stmt->bindparam(":desctiption", $postcat_desctiption);
            $stmt->bindparam(":cimage", $file_name);

            $stmt->execute();

            return TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function delete_post($id){
        $statement = $this->conn->prepare("DELETE from posts WHERE post_id=$id");
        $delete = $statement->execute();
        if($delete){
            return TRUE;
        }else{
            return false;
        }
        
    }
        
    public function details($post_id){
        $sql = "SELECT * FROM posts WHERE post_id=$post_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
           return $row;
       }else{
           return FALSE;
       }
    }
    
    public function selectAllCat(){
        $sql = "SELECT * FROM postcategory";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
           return $row;
       }else{
           return FALSE;
       }
    }
    
    
    
    public function update($post_id){
            $sql = "SELECT * FROM posts WHERE post_id=$post_id";
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
        $sql = "SELECT post_image FROM posts WHERE post_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row[0]['post_image'];
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
    
    
      
    
     public function update_save($post_title,$post_description,$postcat_id,$post_image,$post_id) {
        try {
           
            if($post_image['name']==""){
                $file_name = $this->selectimage($post_id); 
            }else{
               $file_name = $this->_file_upload($post_image);
            }
           
            $query = 'UPDATE posts
                 SET
                   post_title = :ptitle,
                   post_description = :pdes,
                   postcat_id = :pcid,
                   post_image=:pimage,
                   WHERE 
                   post_id = :pid';
            
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':pid', $post_id);
                    $stmt->bindParam(':ptitle', $post_title);
                    $stmt->bindParam(':pdes', $post_description);
                    $stmt->bindParam(':pcid', $postcat_id);
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