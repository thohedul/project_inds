<?php

require_once('dbconfig.php');

class SETTINGS {

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

    public function addsettings($setting_tagline,$setting_logo,$setting_phone,$setting_facebook,$setting_rss, 
$setting_twitter,$setting_linkedin,$setting_google,$setting_copyright,
    $setting_googlemap,$setting_footertext,$id) {
        try {
            if($setting_logo['name']==""){
                $logo = $this->checkimage("setting_logo",$id); 
            }else{
               $logo = $this->_file_upload($setting_logo);
            }
            
            if($setting_phone['name']==""){
                $phone = $this->checkimage("setting_phone",$id);
            }else{
               $phone = $this->_file_upload($setting_phone);
            }
            
            $query = 'UPDATE settings 
                 SET
                   setting_tagline = :tagline,
                   setting_logo = :logo,
                   setting_phone = :phone,
                   setting_facebook = :facebook,
                   setting_rss = :rss,
                   setting_twitter = :twitter,
                   setting_linkedin = :linkedin,
                   setting_google = :google,
                   setting_copyright = :copyright,
                   setting_googlemap = :googlemap,
                   setting_footertext =:footertext
                   WHERE 
                   setting_id = :id';
            
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindparam(":id", $id);
                    $stmt->bindparam(":tagline", $setting_tagline);
                    $stmt->bindparam(":logo", $logo);
                    $stmt->bindparam(":phone", $phone);
                    $stmt->bindparam(":facebook", $setting_facebook);
                    $stmt->bindparam(":rss", $setting_rss);
                    $stmt->bindparam(":twitter", $setting_twitter);
                    $stmt->bindparam(":linkedin", $setting_linkedin);
                    $stmt->bindparam(":google", $setting_google);
                    $stmt->bindparam(":copyright", $setting_copyright);
                    $stmt->bindparam(":googlemap", $setting_googlemap);
                    $stmt->bindparam(":footertext", $setting_footertext);

            $result = $stmt->execute();
            if($result){
                return TRUE;
            }else{
                return FALSE;
            }

            $stmt->execute();

            return TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    
    public function selectlogo($id){
        $sql = "SELECT setting_logo FROM settings WHERE setting_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row[0]['setting_logo'];
           }else{
               return FALSE;
           }
    }
    
    public function selectphone($id){
        $sql = "SELECT setting_phone FROM settings WHERE setting_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row[0]['setting_phone'];
           }else{
               return FALSE;
           }
    }
    
    public function checkimage($checkimage,$id){
        $sql = "SELECT $checkimage FROM settings WHERE setting_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
               return $row[0]["$checkimage"];
           }else{
               return FALSE;
           }
    }
    
    
    
    public function update($id){
            $sql = "SELECT * FROM settings WHERE setting_id=$id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
           if($stmt->rowCount() > 0){
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