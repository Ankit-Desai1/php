<?php

class Helperland
{


    function __construct()
    {
        try {
            //  $this->conn = new PDO("mysql:host=localhost;dbname=event_mgt","root","");
            $servername = "localhost";
            $dbname = "helperland_schema";
            $username = "root";
            $password = "";

            $this->conn = new PDO(
                "mysql:host=$servername; dbname=helperland_schema",
                $username,
                $password
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function insert($table, $array)
    {
        $sql = "INSERT INTO $table(email,password) VALUES (:email, :pswd)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($array);
        return $this->conn->lastInsertId();
    }

    function contact($table, $array)
    {
        $sql = "INSERT INTO $table(Name,Email,SubjectType,PhoneNumber,Message,CreatedOn) VALUES (:firstname, :email, :subject, :phonenumber,:message,:createdon)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($array);
        return $this->conn->lastInsertId();
    }

    function check($email)
    {
        $sql = "SELECT * 
        FROM user 
        where Email = '$email'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function PostalExists($postal)
    {
        $sql = "SELECT * FROM zipcode WHERE ZipcodeValue = $postal";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function Location($pincode)
    {

        $sql  = " SELECT
        zipcode.ZipcodeValue,
        city.CityName, state.StateName  FROM zipcode 
      JOIN city
        ON zipcode.CityId = city.Id  AND ZipcodeValue = $pincode
		JOIN state 
        ON state.Id = city.StateId";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();

        $row  = $stmt->fetch(PDO::FETCH_ASSOC);

        $zipcode = $row['ZipcodeValue'];
        $city = $row['CityName'];
        $state = $row['StateName'];

        return array($city, $state);
    }


    function Get_email($userid)
    {
        $sql = "SELECT * 
        FROM user 
        where UserId = '$userid'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $res['Email'];
        return array($email);
    }


    function Insert_address($array)
    {
        $sql = "INSERT INTO useraddress (UserId , AddressLine1	 , AddressLine2 , City ,State,  PostalCode , Mobile , Email ,Type)
        VALUES (:userid , :streetname,  :housenumber, :location ,:state , :pincode , :phonenumber , :email , :type)";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        return $result;
    }


    public function Get_address($userid)
    {
        $sql =  "SELECT * FROM useraddress WHERE UserId = '$userid'  ORDER BY AddressId DESC";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function ADD_Service_request($array)
    {
        $sql = "INSERT INTO servicerequest ( UserId, ServiceStartDate, ZipCode,  ServiceHourlyRate, ServiceHours, ExtraHours,ExtraService,  SubTotal, Discount, TotalCost,  Comments,  HasPets, Status, CreatedDate,  PaymentDone, RecordVersion)
     VALUES (:userid ,:servicestartdate, :zipcode, :servicehourrate ,:servicehours, :extrahour ,:extraservice,  :subtotal, :discount, :totalcost ,   :comments, :pets,:status ,:createddate , :paymentdone, :recordversion)
     ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($array);
        $serviceid = $this->conn->lastInsertId();

        return $serviceid;
    }

    public function get_selected_address($addressid)
    {
        $sql =  "SELECT * FROM useraddress WHERE AddressId = '$addressid' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function service_address($address)
    {
        $sql = "INSERT INTO servicerequestaddress (ServiceRequestId , AddressLine1	 , AddressLine2 , City ,State,  PostalCode , Mobile , Email ,Type)
        VALUES (:servicerequestid , :street,  :houseno, :city ,:state , :pincode , :mobile , :email , :type)";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($address);
        return $result;
    }



    public function Service_provider($zipcode)
    {
        $sql = "SELECT * FROM user WHERE UserTypeId = 1 AND ZipCode='$zipcode' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function customer_data($userid, $start_from, $record_per_page)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = 17 AND Status !='pending'   LIMIT $start_from, $record_per_page";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function old_service()
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = 17 AND Status !='pending' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function dashboard_data($userid, $start_from, $record_per_page)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = 17 AND Status ='pending'  LIMIT $start_from, $record_per_page";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function all_service()
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = 17 AND Status='pending' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }
    public function cancel_service($service_id)
    {
        $sql = "UPDATE servicerequest SET Status='cancelled' WHERE ServiceRequestId = $service_id";
        $stmt =  $this->conn->prepare($sql);
        $res = $stmt->execute([$service_id]);
        return $res;
    }

    public function reschedule_service($array)
    {
        $sql = "UPDATE servicerequest SET ServiceStartDate=:servicestartdate WHERE ServiceRequestId = :service_id";
        $stmt =  $this->conn->prepare($sql);
        $res = $stmt->execute($array);
        return $res;
    }

    public function detail_of_service($serviceid)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = 17 AND ServiceRequestId =  $serviceid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
