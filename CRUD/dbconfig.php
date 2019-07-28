<?php

class Database
{   
    private $host = "localhost";
    private $db_name = "php97_portal"; // database name
    private $username = "root"; // for localhost username will be root. Yes, we can set username and password in localhost also.
    private $password = "";
    public $conn;
     
    public function dbConnection()
	{
           $this->conn = null; // just set a null property
        try
		{
            // try this
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
            //echo "Connected successfully";
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}