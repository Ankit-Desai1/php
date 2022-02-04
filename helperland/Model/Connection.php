<?php

class Helperland {


    function __construct(){
        try{
        //  $this->conn = new PDO("mysql:host=localhost;dbname=event_mgt","root","");
            $servername = "localhost";
            $dbname = "helperland_schema";
            $username = "root";
            $password = "";

            $this->conn = new PDO(
                "mysql:host=$servername; dbname=helperland_schema",
                $username, $password
            );

    $this->conn->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
       }catch(PDOException $e){
                echo $e->getMessage();
       }
    }
    
    function insert($table,$array){
        $sql = "INSERT INTO $table(email,password) VALUES (:email, :pswd)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($array);
        return $this->conn->lastInsertId();
    }

    function contact($table,$array){
        $sql = "INSERT INTO $table(Name,Email,SubjectType,PhoneNumber,Message,CreatedOn) VALUES (:firstname, :email, :subject, :phonenumber,:message,:createdon)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($array);
        return $this->conn->lastInsertId(); 
    }

    function check($email){
        $sql= "SELECT * 
        FROM user 
        where Email = '$email'";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        $res= $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
       
    }
}