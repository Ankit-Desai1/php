<?php

class Helperland {


    function __construct(){
        try{
        //  $this->conn = new PDO("mysql:host=localhost:3306;dbname=event_mgt","root","");
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
    function check($email){
        $sql= "SELECT * FROM user WHERE Email='$email'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count =$stmt->rowCount();
        return $count;

    }
    
    function registration($table,$array){
        $sql= "INSERT INTO $table(FirstName,LastName,Email,Password,Mobile,UserTypeId,CreatedDate) VALUES (:firstname, :lastname, :email, :password, :phonenumber, :usertypeid, :createdon)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($array);
        return $this->conn->lastInsertId();
    }

    function select($email){
        $sql= "SELECT * FROM user WHERE Email='$email'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $res= $stmt->fetch(PDO::FETCH_ASSOC);
        $count =$stmt->rowCount();
        // return $res;
        $username = $res['FirstName'];
        $id= $res['UserId'];
        return array($username,$id,$count);
    }

    function update($array){
        $sql ="UPDATE user SET Password=:password, ModifiedBy=:modifiedby, ModifiedDate=:modifieddate WHERE UserId=:id";
        $stmt = $this->conn->prepare($sql);
        $res = $stmt->execute($array);
         return $res;
       
    }
}
?>