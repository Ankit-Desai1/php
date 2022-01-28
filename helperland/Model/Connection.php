<?php

class Helperland {

    /* Creates database connection */
    // public function __construct() {
    //     try {            
    //          /* Properties */
    //         $dsn = 'mysql:dbname=helperland_schema;host=localhost';
    //         $user = 'root';
    //         $password = '';
    //         $this-> conn = new PDO($dsn, $user, $password);
    //     } catch (PDOException $e) {
    //         print "Error!: " . $e->getMessage() . "";
    //         die();
    //     }
    // } 

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
    
//     function insert($table,$array){
//         $sql = "INSERT INTO $table(email,password) VALUES (:email, :pswd)";
//         $stmt= $this->conn->prepare($sql);
//         $stmt->execute($array);
//         return $this->conn->lastInsertId();
// }
}   