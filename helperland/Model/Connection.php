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
        $sql = "SELECT * FROM servicerequest WHERE UserId = $userid AND (Status ='completed' OR  Status ='cancelled')  LIMIT $start_from, $record_per_page";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function old_service($userid)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = $userid AND Status ='completed' OR Status ='cancelled' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function dashboard_data($userid, $start_from, $record_per_page)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = $userid AND Status ='pending' OR Status ='new'  LIMIT $start_from, $record_per_page";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function all_service($userid)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = $userid AND Status='pending' OR Status ='new'";
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
        $sql = "UPDATE servicerequest SET ServiceStartDate=:servicestartdate, 	ModifiedDate=:modifieddate, ModifiedBy=:modifiedby WHERE ServiceRequestId = :service_id";
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

    public function get_postal($userid)
    {
        $sql = "SELECT ZipCode FROM user WHERE 	UserId = $userid ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function new_service_data($zipcode, $pet, $start_from, $record_per_page)
    {
        $sql = "SELECT * FROM servicerequest  
        JOIN user ON servicerequest.UserId= user.UserId 
        JOIN servicerequestaddress ON servicerequestaddress.ServiceRequestId = servicerequest.ServiceRequestId   
        WHERE servicerequest.Status = 'new' AND servicerequest.ZipCode = $zipcode AND servicerequest.HasPets= $pet
        ORDER BY servicerequest.ServiceRequestId DESC
        LIMIT $start_from, $record_per_page";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function new_service_count($zipcode, $pet)
    {
        $sql = "SELECT * FROM servicerequest  
        JOIN user ON servicerequest.UserId= user.UserId 
        JOIN servicerequestaddress ON servicerequestaddress.ServiceRequestId = servicerequest.ServiceRequestId   
        WHERE servicerequest.Status = 'new' AND servicerequest.ZipCode = $zipcode AND servicerequest.HasPets= $pet";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function All_service_data($userid, $status, $start_from, $record_per_page)
    {
        $sql = "SELECT * FROM servicerequest  
        JOIN user ON servicerequest.UserId= user.UserId 
        JOIN servicerequestaddress ON servicerequestaddress.ServiceRequestId = servicerequest.ServiceRequestId   
        WHERE servicerequest.Status = '$status' AND servicerequest.ServiceProviderId = $userid
        ORDER BY servicerequest.ServiceRequestId DESC
        LIMIT $start_from, $record_per_page";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function All_service_count($userid, $status)
    {
        $sql = "SELECT * FROM servicerequest  
        JOIN user ON servicerequest.UserId= user.UserId 
        JOIN servicerequestaddress ON servicerequestaddress.ServiceRequestId = servicerequest.ServiceRequestId   
        WHERE servicerequest.Status = '$status' AND servicerequest.ServiceProviderId = $userid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function rating_data($userid, $start_from, $record_per_page)
    {
        $sql = "SELECT * FROM servicerequest  
        JOIN user ON servicerequest.UserId= user.UserId 
        JOIN rating ON rating.ServiceRequestId = servicerequest.ServiceRequestId   
        WHERE servicerequest.Status = 'completed' AND servicerequest.ServiceProviderId = $userid
        ORDER BY servicerequest.ServiceRequestId DESC
        LIMIT $start_from, $record_per_page";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function rating_count($userid)
    {
        $sql = "SELECT * FROM servicerequest  
        JOIN user ON servicerequest.UserId= user.UserId 
        JOIN rating ON rating.ServiceRequestId = servicerequest.ServiceRequestId   
        WHERE servicerequest.Status = 'completed' AND servicerequest.ServiceProviderId = $userid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function get_rating($serviceid)
    {
        $sql = "SELECT * FROM rating WHERE ServiceRequestId = $serviceid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function complete_sp_service($serviceid)
    {
        $sql = "UPDATE servicerequest SET Status='completed' WHERE ServiceRequestId =$serviceid";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function cancel_sp_service($serviceid)
    {
        $sql = "UPDATE servicerequest SET Status='new', ServiceProviderId = NULL WHERE ServiceRequestId =$serviceid";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function All_sp_service($userid, $servicedate)
    {
        $sql = "SELECT * FROM servicerequest WHERE ServiceProviderId = $userid AND ServiceStartDate BETWEEN '$servicedate 00:00:00' AND '$servicedate 23:00:00'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function is_service_accepted($serviceid)
    {
        $sql = "SELECT * FROM servicerequest WHERE ServiceRequestId =$serviceid AND Status = 'new'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function accept_service($array)
    {
        $sql = "UPDATE `servicerequest` SET `ModifiedDate`= :modifiedDate,`ModifiedBy`= :modifiedBy,`Status`=:status, `ServiceProviderId`=:spid ,`SPAcceptedDate`=:serviceAcceptDate WHERE `ServiceRequestId`=:serviceid";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        return $result;
    }

    public function get_sp_address($userid)
    {
        $sql = "SELECT * FROM useraddress WHERE UserId = $userid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return  $result;
    }

    public function update_sp_details($array)
    {
        $sql = "UPDATE user SET FirstName= :fistname,LastName=:lastname,Mobile=:mobile,DateOfBirth= :birthdate,NationalityId =:nationalityid, Gender = :gender, UserProfilePicture = :avtar, ModifiedDate=:modifieddate,ModifiedBy=:modifiedby WHERE UserId =:userid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($array);
        $count = $stmt->rowCount();
        return $count;
    }

    public function update_sp_address($array)
    {
        $sql = "UPDATE useraddress SET AddressLine1 = :streetname , AddressLine2 =  :housenumber ,  City = :location, State =:state,PostalCode =:pincode,  Mobile=:phonenumber WHERE UserId = :userid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($array);
        $count = $stmt->rowCount();
        return $count;
    }

    public function detail_of_all_service($service_id)
    {
        $sql = "SELECT *, servicerequest.Status FROM servicerequest
        JOIN servicerequestaddress
        ON servicerequest.ServiceRequestId = servicerequestaddress.ServiceRequestId 
        JOIN user
        ON user.UserId= servicerequest.UserId WHERE  servicerequest.ServiceRequestId = $service_id";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function users_name($usertypeid)
    {
        $sql = "SELECT DISTINCT CONCAT(`FirstName`,' ',`LastName`) AS UserName FROM `user` WHERE UserTypeId = $usertypeid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_search_services($value, $start_from, $record_per_page)
    {
        $sql = "SELECT servicerequest.`UserId`,servicerequest.`ServiceRequestId`,servicerequest.`ServiceStartDate`,servicerequest.Status,servicerequest.ServiceProviderId,servicerequest.SubTotal,servicerequestaddress.AddressLine1,servicerequestaddress.AddressLine2,servicerequestaddress.City,servicerequestaddress.State,servicerequestaddress.PostalCode,user.FirstName,user.LastName,user.UserProfilePicture FROM `servicerequest` 
        LEFT JOIN user ON servicerequest.`UserId` = user.UserId 
        JOIN servicerequestaddress ON servicerequestaddress.ServiceRequestId = servicerequest.ServiceRequestId $value  
        ORDER BY servicerequest.`ServiceRequestId` DESC
        LIMIT $start_from, $record_per_page";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_search_sp_services($value, $start_from, $record_per_page)
    {
        $sql = "SELECT servicerequest.`UserId`,servicerequest.`ServiceRequestId`,servicerequest.`ServiceStartDate`,servicerequest.Status,servicerequest.ServiceProviderId,servicerequest.SubTotal,servicerequestaddress.AddressLine1,servicerequestaddress.AddressLine2,servicerequestaddress.City,servicerequestaddress.State,servicerequestaddress.PostalCode,user.FirstName,user.LastName,user.UserProfilePicture FROM `servicerequest` 
        LEFT JOIN user ON servicerequest.`ServiceProviderId` = user.UserId 
        JOIN servicerequestaddress ON servicerequestaddress.ServiceRequestId = servicerequest.ServiceRequestId $value 
        ORDER BY servicerequest.`ServiceRequestId` DESC
        LIMIT $start_from, $record_per_page ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function all_service_detail($start_from, $record_per_page)
    {
        $sql = "SELECT servicerequest.`UserId`,servicerequest.`ServiceRequestId`,servicerequest.`ServiceStartDate`,servicerequest.Status,servicerequest.ServiceProviderId,servicerequest.SubTotal,servicerequestaddress.AddressLine1,servicerequestaddress.AddressLine2,servicerequestaddress.City,servicerequestaddress.State,servicerequestaddress.PostalCode,user.FirstName,user.LastName,user.UserProfilePicture FROM `servicerequest` 
        LEFT JOIN user ON servicerequest.`UserId` = user.UserId 
        JOIN servicerequestaddress ON servicerequestaddress.ServiceRequestId = servicerequest.ServiceRequestId  
        ORDER BY servicerequest.`ServiceRequestId` DESC
        LIMIT $start_from, $record_per_page";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function no_of_service($value)
    {
        $sql = "SELECT servicerequest.`UserId`,servicerequest.`ServiceRequestId`,servicerequest.`ServiceStartDate`,servicerequest.Status,servicerequest.ServiceProviderId,servicerequest.SubTotal,servicerequestaddress.AddressLine1,servicerequestaddress.AddressLine2,servicerequestaddress.City,servicerequestaddress.State,servicerequestaddress.PostalCode,user.FirstName,user.LastName,user.UserProfilePicture FROM `servicerequest` 
        LEFT JOIN user ON servicerequest.`UserId` = user.UserId 
        JOIN servicerequestaddress ON servicerequestaddress.ServiceRequestId = servicerequest.ServiceRequestId $value ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function no_of_search_service($value)
    {
        $sql = "SELECT servicerequest.`UserId`,servicerequest.`ServiceRequestId`,servicerequest.`ServiceStartDate`,servicerequest.Status,servicerequest.ServiceProviderId,servicerequest.SubTotal,servicerequestaddress.AddressLine1,servicerequestaddress.AddressLine2,servicerequestaddress.City,servicerequestaddress.State,servicerequestaddress.PostalCode,user.FirstName,user.LastName,user.UserProfilePicture FROM `servicerequest` 
        LEFT JOIN user ON servicerequest.`ServiceProviderId` = user.UserId 
        JOIN servicerequestaddress ON servicerequestaddress.ServiceRequestId = servicerequest.ServiceRequestId $value ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function user_name()
    {
        $sql = "SELECT DISTINCT CONCAT(`FirstName`,' ',`LastName`) AS UserName FROM `user`";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function all_user_detail($value, $start_from, $record_per_page)
    {
        $sql = "SELECT CONCAT(`user`.`FirstName`,' ',`user`.`LastName`) AS UserName, user.UserId, `user`.UserTypeId, `user`.ZipCode, user.IsActive, `user`.RoleId, city.CityName  FROM user 
        JOIN `zipcode` ON `zipcode`.ZipcodeValue= `user`.ZipCode
        JOIN `city` ON `city`.	Id= zipcode.CityId $value
        ORDER BY user.UserId DESC
        LIMIT $start_from, $record_per_page";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function no_of_user($value)
    {
        $sql = "SELECT CONCAT(`user`.`FirstName`,' ',`user`.`LastName`) AS UserName, user.UserId, user.UserTypeId ,user.ZipCode, user.IsActive, user.RoleId, city.CityName  FROM user 
        LEFT JOIN zipcode ON zipcode.ZipcodeValue= user.ZipCode
        JOIN `city` ON `city`.	Id= zipcode.CityId  $value ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function update_service_address($array)
    {
        $sql = "UPDATE servicerequestaddress SET AddressLine1 = :street , AddressLine2 =  :houseno ,  City = :city,PostalCode =:postalcode WHERE ServiceRequestId = :serviceid";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        return $result;
    }

    public function select_customer_email($serviceid)
    {
        $sql = "SELECT servicerequest.UserId, CONCAT(user.FirstName,' ',user.LastName) AS UserName, user.Email , servicerequest.ServiceStartDate, servicerequest.ServiceProviderId FROM servicerequest 
        JOIN user ON servicerequest.UserId = user.UserId  WHERE servicerequest.ServiceRequestId = $serviceid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function select_sp_email($sp)
    {
        $sql = "SELECT  CONCAT(FirstName,' ',LastName) AS UserName, Email FROM user WHERE UserId = $sp";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function detail_of_refund($serviceid)
    {
        $sql = "SELECT  *  FROM servicerequest WHERE ServiceRequestId = $serviceid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function refund($serviceid, $refund)
    {
        $sql = "UPDATE servicerequest SET RefundedAmount = $refund WHERE ServiceRequestId = $serviceid";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function change_user_status($array)
    {
        $sql = "UPDATE user SET IsActive =:status WHERE UserId =:userid";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        return $result;
    }
}
