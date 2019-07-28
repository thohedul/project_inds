<?php

require_once('dbconfig.php');

class USERGROUP {

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

    public function addgroup($group_name, $group_des, $group_image) {
        try {
            $file_name = $this->_file_upload($group_image);
            $stmt = $this->conn->prepare("INSERT INTO groups
                                                        (group_name,group_des,group_image) 
                                                        VALUES
                                                        (:g_name,:g_des,:g_image)");

            $stmt->bindparam(":g_name", $group_name);
            $stmt->bindparam(":g_des", $group_des);
            $stmt->bindparam(":g_image", $file_name);

            $stmt->execute();

            return TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete_group($id){
        $statement = $this->conn->prepare("DELETE from groups WHERE group_id=$id");
        $delete = $statement->execute();
        if($delete){
            return TRUE;
        }else{
            return false;
        }
        
    }
        
    public function details($group_id){
        $sql = "SELECT * FROM groups WHERE group_id=$group_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       if($stmt->rowCount() > 0){
           return $row;
       }else{
           return FALSE;
       }
    }
    
    public function update($group_id){
            $sql = "SELECT * FROM groups WHERE group_id=$group_id";
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
        $sql = "SELECT group_image FROM groups WHERE group_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row[0]['group_image'];
           }else{
               return FALSE;
           }
    }
    
    
    
      
    
     public function update_save($group_name, $group_des, $group_image,$group_id) {
        try {
           
            if($group_image['name']==""){
                $file_name = $this->selectimage($group_id); 
            }else{
               $file_name = $this->_file_upload($group_image);
            }
           
            $query = 'UPDATE groups 
                 SET
                   group_name = :gname,
                   group_des = :gdes,
                   group_image = :gimage
                   
                   WHERE 
                   group_id = :gid';
            
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':gid', $group_id);
                    $stmt->bindParam(':gname', $group_name);
                    $stmt->bindParam(':gdes', $group_des);
                    $stmt->bindParam(':gimage', $file_name);

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