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
        $sql = "SELECT * FROM servicerequest WHERE UserId = $userid AND Status !='pending'   LIMIT $start_from, $record_per_page";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function old_service($userid)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = $userid AND Status !='pending' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function dashboard_data($userid, $start_from, $record_per_page)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = $userid AND Status ='pending'  LIMIT $start_from, $record_per_page";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function all_service($userid)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = $userid AND Status='pending' ";
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

    public function detail_of_service($userid, $serviceid)
    {
        $sql = "SELECT * FROM servicerequest
        JOIN servicerequestaddress
        ON servicerequest.ServiceRequestId = servicerequestaddress.ServiceRequestId  WHERE servicerequest.UserId = $userid AND servicerequest.ServiceRequestId =  $serviceid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_serviceprovider_id($serviceid)
    {
        $sql = "SELECT * FROM servicerequest WHERE ServiceRequestId = $serviceid  ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_sp_detail($spid)
    {
        $sql = "SELECT * FROM user WHERE UserId = $spid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_sp_rating($id)
    {
        $sql = "SELECT * FROM rating WHERE RatingTo = $id";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array($result, $count);
    }

    public function apply_rating($array)
    {

        $sql = "INSERT INTO rating( ServiceRequestId, RatingFrom, RatingTo, Ratings, Comments, RatingDate, IsApproved, VisibleOnHomeScreen,OnTimeArrival,Friendly,QualityOfService) 
                VALUES (:serviceid,:ratingfrom,:ratingto,:rating,:comments,:ratingdt,:isapproved,:visiblehome,:timearrival,:friendlyval,:qualityval)";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($array);
        $count = $stmt->rowCount();
        return $count;
    }

    public function count_rating($id)
    {
        $sql = "SELECT * FROM rating WHERE ServiceRequestId = $id";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return  $count;
    }

    public function update_details($array)
    {
        $sql = "UPDATE user SET FirstName= :fistname,LastName=:lastname,Mobile=:mobile,DateOfBirth= :birthdate,LanguageId=:language,ModifiedDate=:modifieddate,ModifiedBy=:modifiedby WHERE UserId =:userid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($array);
        $count = $stmt->rowCount();
        return $count;
    }

    public function change_password($array)
    {
        $sql = "UPDATE user SET Password = :password , ModifiedDate = :updatedate , ModifiedBy = :modifiedby WHERE UserId = :userid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($array);
        $count = $stmt->rowCount();
        return $count;
    }

    public function get_address_value($addressid)
    {
        $sql = "SELECT * FROM useraddress WHERE AddressId = $addressid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return  $result;
    }

    public function update_address($array)
    {
        $sql = "UPDATE useraddress SET AddressLine1 = :streetname , AddressLine2 =  :housenumber ,  City = :location, State =:state,PostalCode =:pincode,  Mobile=:phonenumber WHERE AddressId = :addressid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($array);
        $count = $stmt->rowCount();
        return $count;
    }

    public function delete_address($array)
    {
        $sql = "UPDATE useraddress SET IsDeleted=:isdeleted WHERE AddressId=:addressid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($array);
        $count = $stmt->rowCount();
        return $count;
    }

    public function service_sp($userid)
    {
        $sql = "SELECT DISTINCT servicerequest.ServiceProviderId,user.FirstName,user.LastName FROM servicerequest  JOIN user
        ON servicerequest.ServiceProviderId = user.UserId  WHERE servicerequest.Status = 'completed' AND servicerequest.UserId = $userid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        return array($result, $count);
    }

    public function sp_details($userid, $spid)
    {
        $sql = "SELECT ServiceProviderId,COUNT(ServiceProviderId) FROM servicerequest WHERE UserId = $userid AND ServiceProviderId = $spid AND Status = 'completed'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function is_favourite($userid, $targetuserid)
    {
        $sql = "SELECT * FROM favoriteandblocked WHERE UserId= $userid AND TargetUserId = $targetuserid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        return array($count, $result);
    }

    public function check_fav_block($userid, $spid)
    {
        $sql = "SELECT * FROM favoriteandblocked WHERE UserId = $userid AND TargetUserId = $spid;
        ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        $block = "";
        $fav = "";
        if ($count == 1) {
            $result  = $stmt->fetch(PDO::FETCH_ASSOC);
            $block = $result['IsBlocked'];
            $fav = $result['IsFavorite'];
        }

        return array($count, $block, $fav);
    }

    public function insert_fav_block($array)
    {
        $sql = "INSERT INTO favoriteandblocked( UserId, TargetUserId, IsFavorite, IsBlocked) 
        VALUES (:userid,:targetuser,:isfav,:isblock)";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($array);
        $count = $stmt->rowCount();
        return $count;
    }

    public function update_fav_block($array)
    {
        $sql = "UPDATE favoriteandblocked SET IsFavorite=:isfav, IsBlocked=:isblock WHERE UserId = :userid AND TargetUserId=:targetuser";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($array);
        $count = $stmt->rowCount();
        return $count;
    }
}
