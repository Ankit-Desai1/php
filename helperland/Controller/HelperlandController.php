<?php
class HelperlandController
{
    function __construct()
    {
        include('Model/Connection.php');
        $this->model = new Helperland();
        session_start();
    }

    public function HomePage()
    {
        include('./View/homepage.php');
    }

    public function login()
    {

        $base_url = 'http://localhost/php/helperland/index.php#loginform';
        $base_url2 = 'http://localhost/php/helperland/?controller=Helperland&function=service_history';

        if (isset($_POST)) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->model->check($email);

            if ($user['Email'] !== $email) {
                $_SESSION['message'] = 'Email is not exist.';
                header('Location: ' . $base_url);
            } elseif (!password_verify($password, $user['Password'])) {
                $_SESSION['msg'] = 'Email & Password not match';
                header('Location: ' . $base_url);
            } else {
                $_SESSION['username'] = $user['FirstName'];
                $_SESSION['userid'] = $user['UserId'];
                if (isset($_POST['remember'])) {
                    setcookie('emailcookie', $email, time() + 86400, '/');
                    setcookie('passwordcookie', $password, time() + 86400, '/');

                    if ($user['UserTypeId'] == 1) {
                        echo 'service provider';
                    } elseif ($user['UserTypeId'] == 2) {
                        header('Location: ' . $base_url2);
                    } else {
                        //echo"admin";
                    }
                }
            }
        } else {
            echo 'Error Occured Try Again';
        }
    }

    public function contact_us()
    {
        $base_url = 'http://localhost/php/helperland/?controller=Helperland&function=contact';
        if (isset($_POST)) {
            $array = [
                'firstname' => $_POST['firstname'] . ' ' . $_POST['lastname'],
                'phonenumber' => $_POST['phonenumber'],
                'email' => $_POST['email'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message'],
                'createdon' => date('Y-m-d')
            ];
            $contact = $this->model->contact('contactus', $array);
            header('Location: ' . $base_url);
        } else {
            header('Location: ' . $base_url);
        }
    }

    public function contact()
    {
        include('./View/contact.php');
    }

    public function become_a_pro()
    {
        include('./View/become-a-pro.php');
    }

    public function customer_registration()
    {
        include('./View/customer_registration.php');
    }

    public function reset()
    {
        $id = $_GET['parameter'];
        include('./View/forgot.php');
    }

    public function book_service()
    {
        include('./View/book_service.php');
    }

    public function about()
    {
        include('./View/about.php');
    }

    public function faq()
    {
        include('./View/FAQ.php');
    }

    public function prices()
    {
        include('./View/prices.php');
    }

    public function service_history()
    {
        include('./View/service_history.php');
    }

    public function logout()
    {
        $base_url = 'http://localhost/php/helperland/?controller=Helperland&function=HomePage';
        unset($_SESSION['username']);
        unset($_SESSION['userid']);
        header('Location: ' . $base_url);
    }

    public function check_postalcode()
    {
        if (isset($_POST)) {
            $postal = $_POST['postal'];
            $count = $this->model->PostalExists($postal);
            if ($count > 0) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function city()
    {
        if (isset($_POST)) {
            $pincode = $_POST['postalcode'];
            $result = $this->model->Location($pincode);
            $city = $result[0];
            $state = $result[1];
            $return = [$city, $state];
            echo json_encode($return);
        }
    }


    public function insert_address()
    {
        if (isset($_POST)) {
            $userid = $_POST['userid'];
            $streetname = $_POST['streetname'];
            $housenumber = $_POST['housenumber'];
            $pincode = $_POST['pincode'];
            $location = $_POST['location'];
            $phonenumber = $_POST['phonenumber'];
            $type = 2;
            $res = $this->model->Get_email($userid);
            $email = $res[0];
            $state = $this->model->Location($pincode);
            $state = $state[1];

            $array = [
                'userid' => $userid,
                'streetname' => $streetname,
                'housenumber' => $housenumber,
                'location' => $location,
                'state' => $state,
                'pincode' => $pincode,
                'phonenumber' => $phonenumber,
                'email' => $email,
                'type' => $type,
            ];
            $result = $this->model->Insert_address($array);
            echo $result;
        }
    }

    public function Get_address()
    {
        if (isset($_POST)) {
            $userid = $_POST['userid'];
            $result = $this->model->Get_address($userid);

            if (count($result)) {
                foreach ($result as $row) {
                    $street = $row['AddressLine1'];
                    $houseno = $row['AddressLine2'];
                    $city = $row['City'];
                    $pincode = $row['PostalCode'];
                    $mobile = $row['Mobile'];
                    $isdefault = $row['IsDefault'];
                    $isdeleted = $row['IsDeleted'];
                    $addressid = $row['AddressId'];
                    if ($isdefault == 1) {
                        $isdefault =  'checked';
                    } else {
                        $isdefault = '';
                    }
                    if ($isdeleted == 0) {
                        $output = '<div class="radiobutton">
                                <input type="radio" id="address' . $addressid . '" name="address" value="' . $addressid . '" class="address-radio" ' . $isdefault . '>     
                                <label for="address1"><span>ADDRESS:</span><span>' . $street . '  ' . $houseno . ' , ' . $city . ' ' . $pincode . '</span> <br />
                                <span>PHONE NUMBER:</span> <span>' . $mobile . '</span></label>
                            
                        </div>';
                        echo $output;
                    }
                }
            }
        } else {
            echo ('something went wrong');
        }
    }


    public function Service_request()
    {

        if (isset($_POST)) {
            $username = $_POST['username'];
            $userid  = $_POST['userid'];
            $servicestartdate = $_POST['servicestartdate'];
            $zipcode = $_POST['zipcode'];
            $servicehourrate = $_POST['servicehourrate'];
            $servicehours = $_POST['servicehours'];
            $extrahour = $_POST['extrahour'];
            $subtotal = $_POST['subtotal'];
            $discount = $_POST['discount'];
            $totalcost = $_POST['totalcost'];
            $extraservice = $_POST['extraservice'];
            $comments = $_POST['comments'];
            $addressid = $_POST['addressid'];
            $haspets = $_POST['haspets'];
            $status = 'Pending';
            $date = date('Y-m-d H:i:s');
            $paymentdone = 1;
            $recordversion = 1;



            $array = [
                'userid' => $userid,
                'servicestartdate' => $servicestartdate,
                'zipcode'   => $zipcode,
                'servicehourrate' => $servicehourrate,
                'servicehours' => $servicehours,
                'extrahour' => $extrahour,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'totalcost' => $totalcost,
                'extraservice' => $extraservice,
                'comments' => $comments,
                'pets' => $haspets,
                'status' => $status,
                'createddate' => $date,
                'paymentdone' => $paymentdone,
                'recordversion' => $recordversion,
            ];
            $get_address = $this->model->get_selected_address($addressid);
            $result = $this->model->ADD_Service_request($array);
            $serviceprovider = $this->model->Service_provider($zipcode);
            if ($result) {
                $servicerequestid = $result;


                foreach ($get_address as $row) {
                    $street = $row['AddressLine1'];
                    $houseno = $row['AddressLine2'];
                    $city = $row['City'];
                    $pincode = $row['PostalCode'];
                    $mobile = $row['Mobile'];
                    $email = $row['Email'];
                    $state = $row['State'];
                    $type = $row['Type'];
                }
                include('services_booked.php');
                echo $result;
                $address = [
                    'servicerequestid' => $servicerequestid,
                    'street' => $street,
                    'houseno' => $houseno,
                    'city' => $city,
                    'pincode' => $pincode,
                    'mobile' => $mobile,
                    'email' => $email,
                    'state' => $state,
                    'type' => $type,
                ];
                $service_address = $this->model->service_address($address);

                if (count($serviceprovider)) {
                    foreach ($serviceprovider as $row) {
                        $email = $row['Email'];
                        include('service_provided.php');
                    }
                }
            } else {
                echo 0;
            }
        }
    }


    public function customer_data()
    {
        if (isset($_POST)) {

            switch ($_POST["no"]) {
                case 5:
                    $s1 = 'selected';
                    $s2 = '';
                    $s3 = '';
                    $s4 = '';
                    break;
                case 10:
                    $s1 = '';
                    $s2 = 'selected';
                    $s3 = '';
                    $s4 = '';
                    break;
                case 20:
                    $s1 = '';
                    $s2 = '';
                    $s3 = 'selected';
                    $s4 = '';
                    break;
                case 30:
                    $s1 = '';
                    $s2 = '';
                    $s3 = '';
                    $s4 = 'selected';
                    break;
            }

            $userid = $_POST['userid'];
            $output = '';
            if (isset($_POST["page"])) {
                $page = $_POST["page"];
            } else {
                $page = 1;
            }
            if (isset($_POST["no"])) {
                $record_per_page = $_POST["no"];
            } else {
                $record_per_page = 5;
            }

            $start_from = ($page - 1) * $record_per_page;


            $output .= '   <table class="table tableinfo" id="service_history_table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Service Details <img src="./Asset/image/sort.png" alt="..."></th>
                            <th scope="col"> Service Provider<img src="./Asset/image/sort.png" alt="..."></th>
                            <th scope="col"> Payment <img src="./Asset/image/sort.png" alt="..."></th>
                            <th scope="col"> Status <img src="./Asset/image/sort.png" alt="..."></th>
                            <th scope="col"> Rate SP </th>
                        </tr>
                    </thead>
                    <tbody class="clearfix">
                    ';
            $get_address = $this->model->customer_data($userid, $start_from, $record_per_page);
            if ($get_address) {
                foreach ($get_address as $row) {
                    $spid =  $row['ServiceProviderId'];
                    if (!empty($spid)) {
                        $spalldetails = $this->model->get_sp_detail($spid);
                        if (count($spalldetails)) {
                            foreach ($spalldetails as $sp) {
                                $spfirstname = $sp['FirstName'];
                                $splastname = $sp['LastName'];
                                $serviceproviderid = $spid;
                                $spratings = $this->model->get_sp_rating($spid);
                                if (count($spratings[0])) {
                                    $sprate = 0;
                                    $count = $spratings[1];
                                    foreach ($spratings[0] as $sprating) {
                                        $sprate = ($sprate + $sprating['Ratings']);
                                    }

                                    $sprate = round(($sprate / $count), 2);
                                    $spratings = round($sprate);
                                    $valu = $spratings;
                                    if ($valu != 0) {
                                        $values = '';
                                        for ($i = 1; $i <= $valu; $i++) {
                                            $values = $values .  '<i class="fa fa-star " style="color:rgb(236, 185, 28);"></i>';
                                        }
                                        if ($valu <= 5) {
                                            for ($count = ($spratings + 1); $count <= 5; $count++) {
                                                $values = $values . '<i class="fa fa-star "></i>';
                                            }
                                        }
                                    }
                                    if ($valu = 0) {
                                        $values = '';
                                        for ($i = 1; $i <= 5; $i++) {
                                            $values = $values .  '<i class="fa fa-star " "></i>';
                                        }
                                    }

                                    $serviceproviderrating = '
                                                <div class="row ml-1">
                                                    <div class="col-2 cap-icon" ><img src="./Asset/image/cap.png" alt=".."></div>
                                                    <div class="col ml-3" >
                                                        <div class="service-provider ml-3" id="' . $serviceproviderid . '">' . $spfirstname . ' ' . $splastname . '</div>
                                                        <span class="star">
                                        
                                                        ' . $values . '
                                                        </span>
                                                        <span class="spratings ml-3">' . $sprate . '</span>
                                        
                                            
                                                    </div>
                                                </div>';
                                } else {
                                    $values = "";
                                    for ($i = 1; $i <= 5; $i++) {
                                        $values = $values .  '<i class="fa fa-star"></i>';
                                    }
                                    $serviceproviderrating = '
                                                                                        <div class="row ml-1">
                                                                                            <div class="col-2 cap-icon" ><img src="./Asset/image/cap.png" alt=".."></div>
                                                                                            <div class="col ml-3" >
                                                                                                <div class=" service-provider" style="width: 200px;" id="' . $serviceproviderid . '">' . $spfirstname . ' ' . $splastname . '</div>
                                                                                                    <span class=" star">
                                                                                                        ' . $values . '
                                                                                            
                                                                                                    </span>
                                                                                                    <span class="spratings ml-3"> 0 </span>
                                                                            
                                                                                                </div>
                                                                                            </div>
                                                                                        ';
                                }
                                $valu = $spratings;
                            }
                        }
                    } else {
                        $serviceproviderrating = '';
                    }

                    $disable = '';
                    $rateclass = '';
                    if ($row['Status'] == 'cancelled') {
                        $disable = 'disabled';
                        $rateclass = 'rateactive';
                    } else {
                        $disable = '';
                        $rateclass = 'rate';
                    }

                    $servicestartdate = $row['ServiceStartDate'];
                    $servicedate = date('d-m-Y', strtotime($servicestartdate));
                    $servicetime = date('H:i', strtotime($servicestartdate));
                    $subtotal = $row['SubTotal'];
                    $subtotal = $subtotal * 10;
                    $min = 0;
                    $min = $subtotal % 10;
                    $subtotal = $subtotal / 10;
                    $hours = (int)$subtotal;
                    if ($min == 5) {
                        $minute = 30;
                    } else {
                        $minute = 00;
                    }
                    $endtime = date('H:i', strtotime('+' . $hours . ' hour +' . $minute . ' minutes', strtotime($servicestartdate)));

                    $output .= '  
                    
                        <tr class="show_all_detail" id="' . $row['ServiceRequestId'] . '">
                            <td data-label="Service Details">
                                <img src="./Asset/image/calendar2.png" alt="calender"><span class="date">' . $servicedate . '</span> <br>
                                <img src="./Asset/image/layer-14.png" alt="calender"><span class="date">' . $servicetime . ' - ' . $endtime . '</span>
                            </td>
                            <td data-label="Service Provider" class="clearfix">
                                ' . $serviceproviderrating . '
                            </td>
                            <td data-label="Payment">
                                <p class="price">€' . $row['TotalCost'] . '</p>
                            </td>
                            <td data-label="Status"> <button class="' . $row['Status'] . '">' . $row['Status'] . '</button></td>
                            <td data-label="Rate SP"><button class="' . $rateclass . '"' . $disable . ' id="' . $row['ServiceRequestId'] . '">Rate</button></td>
                        </tr>  
                   ';
                }
                $output .= '</tbody>
                </table> 
                
                <div class="card mobileview clearfix" style="width: 100%;">
                   ';
                foreach ($get_address as $row) {
                    $spid =  $row['ServiceProviderId'];
                    if (!empty($spid)) {
                        $spalldetails = $this->model->get_sp_detail($spid);
                        if (count($spalldetails)) {
                            foreach ($spalldetails as $sp) {
                                $spfirstname = $sp['FirstName'];
                                $splastname = $sp['LastName'];
                                $serviceproviderid = $spid;
                                $spratings = $this->model->get_sp_rating($spid);
                                if (count($spratings[0])) {
                                    $sprate = 0;
                                    $count = $spratings[1];
                                    foreach ($spratings[0] as $sprating) {
                                        $sprate = ($sprate + $sprating['Ratings']);
                                    }

                                    $sprate = round(($sprate / $count), 2);
                                    $spratings = round($sprate);
                                    $valu = $spratings;
                                    if ($valu != 0) {
                                        $values = '';
                                        for ($i = 1; $i <= $valu; $i++) {
                                            $values = $values .  '<i class="fa fa-star " style="color:rgb(236, 185, 28);"></i>';
                                        }
                                        if ($valu <= 5) {
                                            for ($count = ($spratings + 1); $count <= 5; $count++) {
                                                $values = $values . '<i class="fa fa-star "></i>';
                                            }
                                        }
                                    }
                                    if ($valu = 0) {
                                        $values = '';
                                        for ($i = 1; $i <= 5; $i++) {
                                            $values = $values .  '<i class="fa fa-star " "></i>';
                                        }
                                    }

                                    $serviceproviderrating = '<hr>
                                                <div class="row ml-1">
                                                    <div class="col-2 cap-icon" ><img src="./Asset/image/cap.png" alt=".."></div>
                                                    <div class="col ml-3" >
                                                        <div class="service-provider ml-3" id="' . $serviceproviderid . '">' . $spfirstname . ' ' . $splastname . '</div>
                                                        <span class="star">
                                        
                                                        ' . $values . '
                                                        </span>
                                                        <span class="spratings ml-3">' . $sprate . '</span>
                                        
                                            
                                                    </div>
                                                </div>';
                                } else {
                                    $values = "";
                                    for ($i = 1; $i <= 5; $i++) {
                                        $values = $values .  '<i class="fa fa-star"></i>';
                                    }
                                    $serviceproviderrating = '<hr>
                                                                                        <div class="row ml-1">
                                                                                            <div class="col-2 cap-icon" ><img src="./Asset/image/cap.png" alt=".."></div>
                                                                                            <div class="col ml-3" >
                                                                                                <div class=" service-provider" style="width: 200px;" id="' . $serviceproviderid . '">' . $spfirstname . ' ' . $splastname . '</div>
                                                                                                    <span class=" star">
                                                                                                        ' . $values . '
                                                                                            
                                                                                                    </span>
                                                                                                    <span class="spratings ml-3"> 0 </span>
                                                                            
                                                                                                </div>
                                                                                            </div>
                                                                                        ';
                                }
                                $valu = $spratings;
                            }
                        }
                    } else {
                        $serviceproviderrating = '';
                    }

                    $servicestartdate = $row['ServiceStartDate'];
                    $servicedate = date('d-m-Y', strtotime($servicestartdate));
                    $servicetime = date('H:i', strtotime($servicestartdate));
                    $subtotal = $row['SubTotal'];
                    $subtotal = $subtotal * 10;
                    $min = 0;
                    $min = $subtotal % 10;
                    $subtotal = $subtotal / 10;
                    $hours = (int)$subtotal;
                    if ($min == 5) {
                        $minute = 30;
                    } else {
                        $minute = 00;
                    }
                    $endtime = date('H:i', strtotime('+' . $hours . ' hour +' . $minute . ' minutes', strtotime($servicestartdate)));

                    $output .= ' 
                    
                    <div class="card-body" id="' . $row['ServiceRequestId'] . '">
                    <span><img src="./Asset/image/calendar2.png" alt="calender"><span class="date">' . $servicedate . '</span> 
                    <br>
                    <img src="./Asset/image/layer-14.png" alt="calender"><span class="date">' . $servicetime . '-' . $endtime . '</span>
                        
                       ' . $serviceproviderrating . '
                        <hr>
                        <p class="price">€' . $row['TotalCost'] . '</p>
                        <hr>
                        <div class="text-center"><button class="' . $row['Status'] . '">' . $row['Status'] . '</button></div>
                        <hr>
                        <div class="text-center"><button class="rate" id="' . $row['ServiceRequestId'] . '">Rate SP</button></div>
                    </div>';
                }

                $total_record = $this->model->old_service($userid);
                $total_pages = ceil($total_record / $record_per_page);
                $output .= '</div> <div class="pagenumber">
                <div class="pagenumber-left">
                    <span style="margin-right:5px;">Show</span>
                    <span class="ml-2"><select class="form-select" id="serviceNo">
                                        <option ' . $s1 . ' value="5">5</option>
                                        <option ' . $s2 . ' value="10">10</option>
                                        <option ' . $s3 . ' value="20">20</option>
                                        <option ' . $s4 . ' value="30">30</option>
                                    </select></span>
                    <span style="margin-left:5px;">entries Total Record: ' . $total_record . '</span>
                </div>
                <div class="pagenumber-right">';

                if ($page > 1) {
                    $previous = $page - 1;

                    $output .= '<div class="pagenumber-btn" id="1">
                    <img src="./Asset/image/first-page.png" alt="">
                </div>';

                    $output .= ' <div class="pagenumber-btn" id="' . $previous . '">
                    <img src="./Asset/image/keyboard-right-arrow-button-copy.png" alt="">
                </div>';
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active_class = "";
                    if ($i == $page) {
                        $active_class = "active";
                    }
                    $output .= ' <div class="pagenumber-btn ' . $active_class . '" id="' . $i . '">
                    ' . $i . '
                    </div>';
                }

                if ($page < $total_pages) {
                    $page++;

                    $output .= '<div class="pagenumber-btn" id="' . $page . '">
                    <img class="transform_btn" src="./Asset/image/keyboard-right-arrow-button-copy.png" alt="">
                </div>';

                    $output .= '<div class="pagenumber-btn" id="' . $total_pages . '">
                    <img class="transform_btn" src="./Asset/image/first-page.png" alt="">
                </div>';
                }
                $output .= ' </div>
                </div>
            </div>';
            } else {
                $output = '   <table class="table tableinfo" id="service_history_table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Service Id</th>
                                <th scope="col">Service Details <img src="./Asset/image/sort.png" alt="..."></th>
                                <th scope="col"> Service Provider<img src="./Asset/image/sort.png" alt="..."></th>
                                <th scope="col"> Payment <img src="./Asset/image/sort.png" alt="..."></th>
                                <th scope="col"> Action </th>
                            </tr>
                        </thead>
                        <tbody class="clearfix">
                        <tr><td colspan=5> No data inserted</td></tr>
                        </tbody>
                        </table>
                        ';
            }

            echo $output;
        }
    }




    public function dashboard_data()
    {
        if (isset($_POST)) {

            switch ($_POST["no"]) {
                case 5:
                    $s1 = 'selected';
                    $s2 = '';
                    $s3 = '';
                    $s4 = '';
                    break;
                case 10:
                    $s1 = '';
                    $s2 = 'selected';
                    $s3 = '';
                    $s4 = '';
                    break;
                case 20:
                    $s1 = '';
                    $s2 = '';
                    $s3 = 'selected';
                    $s4 = '';
                    break;
                case 30:
                    $s1 = '';
                    $s2 = '';
                    $s3 = '';
                    $s4 = 'selected';
                    break;
            }

            $userid = $_POST['userid'];
            $output = '';
            if (isset($_POST["page"])) {
                $page = $_POST["page"];
            } else {
                $page = 1;
            }
            if (isset($_POST["no"])) {
                $record_per_page = $_POST["no"];
            } else {
                $record_per_page = 5;
            }

            $start_from = ($page - 1) * $record_per_page;


            $output .= '   <table class="table tableinfo" id="dashboard_data_table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Service Id</th>
                            <th scope="col">Service Details <img src="./Asset/image/sort.png" alt="..."></th>
                            <th scope="col"> Service Provider<img src="./Asset/image/sort.png" alt="..."></th>
                            <th scope="col"> Payment <img src="./Asset/image/sort.png" alt="..."></th>
                            <th scope="col"> Action </th>
                        </tr>
                    </thead>
                    <tbody class="clearfix">
                    ';
            $get_request = $this->model->dashboard_data($userid, $start_from, $record_per_page);
            if ($get_request) {
                foreach ($get_request as $row) {
                    $spid =  $row['ServiceProviderId'];
                    if (!empty($spid)) {
                        $spalldetails = $this->model->get_sp_detail($spid);
                        if (count($spalldetails)) {
                            foreach ($spalldetails as $sp) {
                                $spfirstname = $sp['FirstName'];
                                $splastname = $sp['LastName'];
                                $serviceproviderid = $spid;
                                $spratings = $this->model->get_sp_rating($spid);
                                if (count($spratings[0])) {
                                    $sprate = 0;
                                    $count = $spratings[1];
                                    foreach ($spratings[0] as $sprating) {
                                        $sprate = ($sprate + $sprating['Ratings']);
                                    }

                                    $sprate = round(($sprate / $count), 2);
                                    $spratings = round($sprate);
                                    $valu = $spratings;
                                    if ($valu != 0) {
                                        $values = '';
                                        for ($i = 1; $i <= $valu; $i++) {
                                            $values = $values .  '<i class="fa fa-star " style="color:rgb(236, 185, 28);"></i>';
                                        }
                                        if ($valu <= 5) {
                                            for ($count = ($spratings + 1); $count <= 5; $count++) {
                                                $values = $values . '<i class="fa fa-star "></i>';
                                            }
                                        }
                                    }
                                    if ($valu = 0) {
                                        $values = '';
                                        for ($i = 1; $i <= 5; $i++) {
                                            $values = $values .  '<i class="fa fa-star " "></i>';
                                        }
                                    }

                                    $serviceproviderrating = '
                                                    <div class="row ml-1">
                                                        <div class="col-2 cap-icon" ><img src="./Asset/image/cap.png" alt=".."></div>
                                                        <div class="col ml-3" >
                                                            <div class="service-provider ml-3" id="' . $serviceproviderid . '">' . $spfirstname . ' ' . $splastname . '</div>
                                                            <span class="star">
                                            
                                                            ' . $values . '
                                                            </span>
                                                            <span class="spratings ml-3">' . $sprate . '</span>
                                            
                                                
                                                        </div>
                                                    </div>';
                                } else {
                                    $values = "";
                                    for ($i = 1; $i <= 5; $i++) {
                                        $values = $values .  '<i class="fa fa-star"></i>';
                                    }
                                    $serviceproviderrating = '
                                                                                            <div class="row ml-1">
                                                                                                <div class="col-2 cap-icon" ><img src="./Asset/image/cap.png" alt=".."></div>
                                                                                                <div class="col ml-3" >
                                                                                                    <div class=" service-provider" style="width: 200px;" id="' . $serviceproviderid . '">' . $spfirstname . ' ' . $splastname . '</div>
                                                                                                        <span class=" star">
                                                                                                            ' . $values . '
                                                                                                
                                                                                                        </span>
                                                                                                        <span class="spratings ml-3"> 0 </span>
                                                                                
                                                                                                    </div>
                                                                                                </div>
                                                                                            ';
                                }
                                $valu = $spratings;
                            }
                        }
                    } else {
                        $serviceproviderrating = '';
                    }
                    $servicestartdate = $row['ServiceStartDate'];
                    $servicedate = date('d-m-Y', strtotime($servicestartdate));
                    $servicetime = date('H:i', strtotime($servicestartdate));
                    $subtotal = $row['SubTotal'];
                    $subtotal = $subtotal * 10;
                    $min = 0;
                    $min = $subtotal % 10;
                    $subtotal = $subtotal / 10;
                    $hours = (int)$subtotal;
                    if ($min == 5) {
                        $minute = 30;
                    } else {
                        $minute = 00;
                    }
                    $endtime = date('H:i', strtotime('+' . $hours . ' hour +' . $minute . ' minutes', strtotime($servicestartdate)));

                    $output .= '  
                        <tr class="show_all_detail" id="' . $row['ServiceRequestId'] . '" data-value="' . $row['ServiceRequestId'] . '">
                            <td data-label="Service Id" >
                                <p>' . $row['ServiceRequestId'] . '</p>
                            </td>
                            <td data-label="Service Details" >
                                <img src="./Asset/image/calendar2.png" alt="calender"><span class="date">' . $servicedate . '</span>
                                <br>
                                <img src="./Asset/image/layer-14.png" alt="calender"><span class="date">' . $servicetime . '-' . $endtime . '</span>
                            </td>
                            <td data-label="Service Provider" class=" clearfix">
                                ' . $serviceproviderrating . '
                            </td>
                            <td data-label="Payment" >
                                <p class="price">€' . $row['TotalCost'] . '</p>
                            </td>
                            <td data-label="Action"><button class="reschedule" id="' . $row['ServiceRequestId'] . '">Reschedule</button><button class="cancel" id="' . $row['ServiceRequestId'] . '">Cancel</button></td>
                        </tr>  
                   ';
                }
                $output .= '</tbody>
                </table> 
                
                <div class="card mobileview clearfix" style="width: 100%;">
                   ';
                foreach ($get_request as $row) {
                    $spid =  $row['ServiceProviderId'];
                    if (!empty($spid)) {
                        $spalldetails = $this->model->get_sp_detail($spid);
                        if (count($spalldetails)) {
                            foreach ($spalldetails as $sp) {
                                $spfirstname = $sp['FirstName'];
                                $splastname = $sp['LastName'];
                                $serviceproviderid = $spid;
                                $spratings = $this->model->get_sp_rating($spid);
                                if (count($spratings[0])) {
                                    $sprate = 0;
                                    $count = $spratings[1];
                                    foreach ($spratings[0] as $sprating) {
                                        $sprate = ($sprate + $sprating['Ratings']);
                                    }

                                    $sprate = round(($sprate / $count), 2);
                                    $spratings = round($sprate);
                                    $valu = $spratings;
                                    if ($valu != 0) {
                                        $val = '';
                                        $values = '';
                                        for ($i = 1; $i <= $valu; $i++) {
                                            $values = $values .  '<i class="fa fa-star " style="color:rgb(236, 185, 28);"></i>';
                                        }
                                        if ($valu <= 5) {
                                            for ($count = ($spratings + 1); $count <= 5; $count++) {
                                                $values = $values . '<i class="fa fa-star "></i>';
                                            }
                                        }
                                    }
                                    if ($valu = 0) {
                                        $values = '';
                                        for ($i = 1; $i <= 5; $i++) {
                                            $values = $values .  '<i class="fa fa-star " "></i>';
                                        }
                                    }

                                    $serviceproviderrating = '<hr>
                                                <div class="row ml-1">
                                                    <div class="col-2 cap-icon" ><img src="./Asset/image/cap.png" alt=".."></div>
                                                    <div class="col ml-3" >
                                                        <div class="service-provider ml-3" id="' . $serviceproviderid . '">' . $spfirstname . ' ' . $splastname . '</div>
                                                        <span class="star">
                                        
                                                        ' . $values . '
                                                        </span>
                                                        <span class="spratings ml-3">' . $sprate . '</span>
                                        
                                            
                                                    </div>
                                                </div>';
                                } else {
                                    $values = "";
                                    for ($i = 1; $i <= 5; $i++) {
                                        $values = $values .  '<i class="fa fa-star"></i>';
                                    }
                                    $serviceproviderrating = '<hr>
                                                                                        <div class="row ml-1">
                                                                                            <div class="col-2 cap-icon" ><img src="./Asset/image/cap.png" alt=".."></div>
                                                                                            <div class="col ml-3" >
                                                                                                <div class=" service-provider" style="width: 200px;" id="' . $serviceproviderid . '">' . $spfirstname . ' ' . $splastname . '</div>
                                                                                                    <span class=" star">
                                                                                                        ' . $values . '
                                                                                            
                                                                                                    </span>
                                                                                                    <span class="spratings ml-3"> 0 </span>
                                                                            
                                                                                                </div>
                                                                                            </div>
                                                                                        ';
                                }
                                $valu = $spratings;
                            }
                        }
                    } else {
                        $serviceproviderrating = '';
                    }

                    $servicestartdate = $row['ServiceStartDate'];
                    $servicedate = date('d-m-Y', strtotime($servicestartdate));
                    $servicetime = date('H:i', strtotime($servicestartdate));
                    $subtotal = $row['SubTotal'];
                    $subtotal = $subtotal * 10;
                    $min = 0;
                    $min = $subtotal % 10;
                    $subtotal = $subtotal / 10;
                    $hours = (int)$subtotal;
                    if ($min == 5) {
                        $minute = 30;
                    } else {
                        $minute = 00;
                    }
                    $endtime = date('H:i', strtotime('+' . $hours . ' hour +' . $minute . ' minutes', strtotime($servicestartdate)));


                    $output .= ' 
                    <div class="card-body" data-value="' . $row['ServiceRequestId'] . '">
                    <p class="deletedid">' . $row['ServiceRequestId'] . '</p>
                    <hr>
                    <span><img src="./Asset/image/calendar2.png" alt="calender"><span class="date">' . $servicedate . '</span>
                    <br>
                                <img src="./Asset/image/layer-14.png" alt="calender"><span class="date">' . $servicetime . '-' . $endtime . '</span> 
                        </span>
                       ' . $serviceproviderrating . '
                        <hr>
                        <p class="price">€' . $row['TotalCost'] . '</p>
                        <hr>
                        
                        <div class="text-center"><button class="reschedule" id="' . $row['ServiceRequestId'] . '">Reschedule</button><button class="cancel" id="' . $row['ServiceRequestId'] . '">Cancel</button></div>
                    </div>';
                }


                $total_record = $this->model->all_service($userid);
                $total_pages = ceil($total_record / $record_per_page);
                $output .= '</div> <div class="pagenumber">
                <div class="pagenumber-left">
                    <span style="margin-right:5px;">Show</span>
                    <span class="ml-2"><select class="form-select" id="serviceNo">
                                        <option ' . $s1 . ' value="5">5</option>
                                        <option ' . $s2 . ' value="10">10</option>
                                        <option ' . $s3 . ' value="20">20</option>
                                        <option ' . $s4 . ' value="30">30</option>
                                    </select></span>
                    <span style="margin-left:5px;">entries Total Record: ' . $total_record . '</span>
                </div>
                <div class="pagenumber-right">';

                if ($page > 1) {
                    $previous = $page - 1;

                    $output .= '<div class="pagenumber-btn dashboard-btn" id="1">
                    <img src="./Asset/image/first-page.png" alt="">
                </div>';

                    $output .= ' <div class="pagenumber-btn dashboard-btn" id="' . $previous . '">
                    <img src="./Asset/image/keyboard-right-arrow-button-copy.png" alt="">
                </div>';
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active_class = "";
                    if ($i == $page) {
                        $active_class = "active";
                    }
                    $output .= ' <div class="pagenumber-btn dashboard-btn ' . $active_class . '" id="' . $i . '">
                    ' . $i . '
                    </div>';
                }

                if ($page < $total_pages) {
                    $page++;

                    $output .= '<div class="pagenumber-btn dashboard-btn" id="' . $page . '">
                    <img class="transform_btn" src="./Asset/image/keyboard-right-arrow-button-copy.png" alt="">
                </div>';

                    $output .= '<div class="pagenumber-btn dashboard-btn" id="' . $total_pages . '">
                    <img class="transform_btn" src="./Asset/image/first-page.png" alt="">
                </div>';
                }
                $output .= ' </div>
                </div>
                </div>';
            } else {
                $output = '   <table class="table tableinfo" id="dashboard_data_table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Service Id</th>
                                <th scope="col">Service Details <img src="./Asset/image/sort.png" alt="..."></th>
                                <th scope="col"> Service Provider<img src="./Asset/image/sort.png" alt="..."></th>
                                <th scope="col"> Payment <img src="./Asset/image/sort.png" alt="..."></th>
                                <th scope="col"> Action </th>
                            </tr>
                        </thead>
                        <tbody class="clearfix">
                        <tr><td colspan=5> No data inserted</td></tr>
                        </tbody>
                        </table>
                        ';
            }
            echo $output;
        }
    }


    public function cancel_service()
    {
        if (isset($_POST)) {
            $service_id = $_POST['serviceid'];
            $result = $this->model->cancel_service($service_id);
        }
    }

    public function reschedule_service()
    {
        if (isset($_POST)) {
            $array = [
                'service_id' => $_POST['serviceid'],
                'servicestartdate' => $_POST['servicestartdate'],
            ];
            $result = $this->model->reschedule_service($array);
        }
    }

    public function detail_of_service()
    {
        if (isset($_POST)) {
            $output = '';
            $userid = $_POST['userid'];
            $service_id = $_POST['serviceid'];
            $result = $this->model->detail_of_service($userid, $service_id);

            if ($result) {
                foreach ($result as $row) {
                    switch ($row['Status']) {
                        case 'pending':
                            $status = '<hr>
                            <div class="text-center">
                                <button class="reschedule" id="' . $row['ServiceRequestId'] . '">Reschedule</button><button class="cancel" id="' . $row['ServiceRequestId'] . '">Cancel</button>
                            </div>';
                            break;
                        case 'completed':
                            $status = '<hr>
                            <div class="text-center">
                                <button class="rate" id="' . $row['ServiceRequestId'] . '">Rate SP</button>
                            </div>';
                            break;
                        case 'cancelled':
                            $status = '';
                            break;
                    }

                    $servicestartdate = $row['ServiceStartDate'];
                    $servicedate = date('d-m-Y', strtotime($servicestartdate));
                    $output .= '

                        <div class="modal" tabindex="-1" id="all_detail">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Service Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Start Date :<span> ' . $servicedate . '</span></p>
                                            <p>Duration : <span>' . $row['SubTotal'] . '</span> </p>
                                            <hr>
                                            <p>Service Id : <span>' . $row['ServiceRequestId'] . '</span></p>
                                            <p>Extras : <span>' . $row['ExtraService'] . '</span> </p>
                                            <p>Net Amount : <span class="model_price">' . $row['TotalCost'] . '$</span> </p>
                                            <hr>
                                            <p>Service Address :<span>' . $row['AddressLine1'] . ',' . $row['AddressLine2'] . ',' . $row['City'] . ',' . $row['PostalCode'] . '</span></p>
                                            <p>Billing Address :<span> same as cleaninng address<span></p>
                                            <p>phone :<span>' . $row['Mobile'] . '<span></p>
                                            <p>Email :<span>' . $row['Email'] . '<span></p>
                                            <hr>
                                            <p>Comments :<span>' . $row['Comments'] . '</p>
                                             ' . $status . '
                                        </div>
                                </div>
                            </div>
                        </div>';
                }
            }

            echo $output;
        }
    }


    public function get_rating()
    {
        if (isset($_POST)) {
            $output = '';
            $serviceid = $_POST['serviceid'];
            $result = $this->model->get_serviceprovider_id($serviceid);

            if (count($result)) {
                foreach ($result as $row) {
                    $spid =  $row['ServiceProviderId'];
                    if (!empty($spid)) {
                        $spalldetails = $this->model->get_sp_detail($spid);
                        if (count($spalldetails)) {
                            foreach ($spalldetails as $sp) {

                                $spfirstname = $sp['FirstName'];
                                $splastname = $sp['LastName'];
                                $serviceproviderid = $spid;
                                $spratings = $this->model->get_sp_rating($spid);
                                if (count($spratings[0])) {
                                    $sprate = 0;
                                    $count = $spratings[1];
                                    foreach ($spratings[0] as $sprating) {
                                        $sprate = ($sprate + $sprating['Ratings']);
                                    }
                                    $sprate = round(($sprate / $count), 2);
                                    $spratings = round($sprate);
                                    $valu = $spratings;
                                    if ($valu != 0) {
                                        $values = '';

                                        for ($i = 1; $i <= $valu; $i++) {
                                            $values = $values .  '<i class="fa fa-star " style="color:rgb(236, 185, 28);"></i>';
                                        }
                                        if ($valu <= 5) {
                                            for ($count = ($spratings + 1); $count <= 5; $count++) {
                                                $values = $values . '<i class="fa fa-star "></i>';
                                            }
                                        }
                                    }
                                    if ($valu = 0) {
                                        $values = '';
                                        for ($i = 1; $i <= 5; $i++) {
                                            $values = $values .  '<i class="fa fa-star " "></i>';
                                        }
                                    }
                                    $values = $values;
                                    $output = '
                                    <div class="row ml-1">
                                        <div class="col cap-icon" ><img src="./Asset/image/cap.png" alt=".."></div>
                                        <div class="col ml-3" >
                                            <div class="row service-provider" style="width: 200px;" id="' . $serviceproviderid . '" name="' . $serviceid . '">' . $spfirstname . ' ' . $splastname . '</div>
                                            <span class="star">
                            
                                            ' . $values . '
                                            </span>
                                            <span class="spratings ml-3">' . $sprate . '</span>
                            
                                
                                        </div>
                                    </div>';
                                } else {
                                    $values = "";
                                    for ($i = 1; $i <= 5; $i++) {
                                        $values = $values .  '<i class="fa fa-star "  style="margin-right:4px;"></i>';
                                    }
                                    $output = '
                                                                            <div class="row ml-1">
                                                                                <div class="col cap-icon" ><img src="./Asset/image/cap.png" alt=".."></div>
                                                                                <div class="col ml-3" >
                                                                                    <div class="row service-provider" style="width: 200px;" id="' . $serviceproviderid . '" name="' . $serviceid . '">' . $spfirstname . ' ' . $splastname . '</div>
                                                                                        <div class="row star">
                                                                                            ' . $values . '
                                                                                
                                                                                        </div>
                                                                                        <span class="spratings ml-3"> 0 </span>
                                                                
                                                                                    </div>
                                                                                </div>
                                                                            ';
                                }
                                $valu = $spratings;
                            }
                        }
                    }
                }
            }
            echo $output;
        }
    }

    public function apply_rating()
    {
        if (isset($_POST)) {
            $serviceid = $_POST['serviceid'];
            $averagerating = $_POST['rating'];
            $timearrival = $_POST['timearrival'];
            $friendlyval = $_POST['friendlyval'];
            $qualityval = $_POST['qualityval'];
            $ratingfrom = $_POST['ratingfrom'];
            $ratingto = $_POST['ratingto'];
            $comment = $_POST['comment'];
            $rating =  round(($averagerating), 1);
            $countrating =  $this->model->count_rating($serviceid);
            $array = [
                'serviceid' => $serviceid,
                'ratingfrom' => $ratingfrom,
                'ratingto' => $ratingto,
                'rating' => $rating,
                'timearrival' => $timearrival,
                'friendlyval' => $friendlyval,
                'qualityval' => $qualityval,
                'comments' => $comment,
                'ratingdt' => date('Y-m-d H:i:s'),
                'isapproved' => 1,
                'visiblehome' => 0,
            ];
            if ($countrating > 0) {
                echo 2;
            } else {
                $results = $this->model->apply_rating($array);
                if ($results == 1) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        }
    }

    public function customer_details()
    {
        if (isset($_POST)) {
            $userid = $_POST['userid'];
            $result = $this->model->get_sp_detail($userid);
            if (count($result)) {
                foreach ($result as $row) {
                    $firstname = $row['FirstName'];
                    $lastname = $row['LastName'];
                    $email = $row['Email'];
                    $mobile = $row['Mobile'];
                    $date = $row['DateOfBirth'];
                    $languageid = $row['LanguageId'];
                    if (!empty($date)) {
                        list($year, $month, $day) = explode("-", $date);
                    } else {
                        $year = "Year";
                        $month = "Month";
                        $day = "Day";
                    }
                    $final_result = [$firstname, $lastname, $email, $mobile, $day, $month, $year, $languageid];

                    echo json_encode($final_result);
                }
            }
        }
    }

    public function update_details()
    {
        if (isset($_POST)) {
            $userid = $_POST['userid'];
            $firstname =   $_POST['firstname'];
            $lastname =   $_POST['lastname'];
            $mobile =   $_POST['phonenumber'];
            $dateofbirth = $_POST['dateofbirth'];
            $monthofbirth = $_POST['monthofbirth'];
            $yearofbirth = $_POST['yearofbirth'];
            $birthdate =  $yearofbirth . '-' . $monthofbirth . '-' . $dateofbirth;
            $language =   $_POST['language'];
            $modifiedby = $firstname . " " . $lastname;
            $modifieddate = date('Y-m-d H:i:s');

            $array = [
                'userid' => $userid,
                'fistname' => $firstname,
                'lastname' => $lastname,
                'mobile' => $mobile,
                'birthdate' => $birthdate,
                'language' => $language,
                'modifieddate' => $modifieddate,
                'modifiedby' => $modifiedby,

            ];
            $result = $this->model->update_details($array);

            if ($result == 1) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function change_password()
    {
        if (isset($_POST)) {
            $userid = $_POST['userid'];
            $oldpassword = $_POST['oldpassword'];
            $newpassword = $_POST['newpassword'];
            $modifiedby = $_POST['modifiedby'];
            $password = $this->model->get_sp_detail($userid);
            if (count($password)) {
                foreach ($password as $pass) {
                    $dbpassword = $pass['Password'];
                    if (password_verify($oldpassword, $dbpassword)) {

                        $update_date = date('Y-m-d H:i:s');
                        $newpass = password_hash($newpassword, PASSWORD_BCRYPT);
                        $array = [
                            'userid' => $userid,
                            'password' => $newpass,
                            'updatedate' => $update_date,
                            'modifiedby' => $modifiedby,
                        ];
                        $result = $this->model->change_password($array);
                        if ($result == 1) {
                            echo 1;
                        } else {
                            echo 2;
                        }
                    } else {
                        echo 0;
                    }
                }
            }
        }
    }

    public function get_all_address()
    {
        if (isset($_POST)) {
            $userid = $_POST['userid'];
            $result = $this->model->Get_address($userid);
            $output = '';
            if (count($result)) {
                foreach ($result as $row) {
                    $street = $row['AddressLine1'];
                    $houseno = $row['AddressLine2'];
                    $city = $row['City'];
                    $pincode = $row['PostalCode'];
                    $mobile = $row['Mobile'];
                    $isdeleted = $row['IsDeleted'];
                    $addressid = $row['AddressId'];
                    if ($isdeleted == 0) {
                        $output .= '     <tr>
                                            <td data-label="Addresses">
                                                <p>Address: <span>' . $street . '  ' . $houseno . ' , ' . $city . ' ' . $pincode . '</span></p>
                                                <p>Mobile: <span> ' . $mobile . '</span></p>
                                            </td>
                                            <td data-label="Actions">
                                            <button type="button" class="edit_address"  id="' . $addressid . '"><img src="./Asset/image/edit.jpg" alt="edit"></button>
                                            <button type="button" class="delete_address" id="' . $addressid . '"><img src="./Asset/image/deleteicon.png" alt="delete"></button>
                                            </td>
                                        </tr>';
                    }
                }
            } else {
                $output = '     <tr>
                                            <td colspan=2>No Address Found</td>
                                        </tr>';
            }
            echo $output;
        } else {
            echo ('something went wrong');
        }
    }
    public function get_address_value()
    {
        if (isset($_POST)) {

            $addressid = $_POST['addressid'];
            $result = $this->model->get_address_value($addressid);

            foreach ($result as $row) {
                $AddressLine1 = $row['AddressLine1'];
                $AddressLine2 = $row['AddressLine2'];
                $PostalCode = $row['PostalCode'];
                $mobile = $row['Mobile'];
                $City = $row['City'];
                $final_result = [$AddressLine1, $AddressLine2, $PostalCode, $City, $mobile];

                echo json_encode($final_result);
            }
        } else {
            echo ('something went wrong');
        }
    }


    public function update_address()
    {
        if (isset($_POST)) {
            $addressid = $_POST['addressid'];
            $streetname = $_POST['streetname'];
            $housenumber = $_POST['housenumber'];
            $pincode = $_POST['pincode'];
            $location = $_POST['location'];
            $phonenumber = $_POST['phonenumber'];
            $state = $this->model->Location($pincode);
            $state = $state[1];

            $array = [
                'addressid' => $addressid,
                'streetname' => $streetname,
                'housenumber' => $housenumber,
                'location' => $location,
                'state' => $state,
                'pincode' => $pincode,
                'phonenumber' => $phonenumber,
            ];
            $result = $this->model->update_address($array);
            echo $result;
        } else {
            echo ('something is wrong');
        }
    }

    public function delete_address()
    {
        if (isset($_POST)) {
            $addressid = $_POST['addressid'];
            $isdeleted = 1;

            $array = [
                'addressid' => $addressid,
                'isdeleted' => $isdeleted,
            ];
            $result = $this->model->delete_address($array);
            echo $result;
        }
    }


    public function get_fav_sp()
    {

        if (isset($_POST)) {
            $userid =  $_POST['userid'];
            $service_sp = $this->model->service_sp($userid);
            $output = '';
            if (count($service_sp[0])) {
                foreach ($service_sp[0] as $row) {
                    $fname =   $row['FirstName'];
                    $lname =   $row['LastName'];
                    $spid = $row['ServiceProviderId'];
                    $count = $this->model->sp_details($userid, $spid);

                    if (count($count)) {
                        foreach ($count as $spcount) {
                            $sp_id = $spcount['ServiceProviderId'];
                            $counts =  $spcount['COUNT(ServiceProviderId)'];
                            $spratings = $this->model->get_sp_rating($sp_id);

                            if ($spid ==  $sp_id) {
                                if (count($spratings[0])) {
                                    $sprate = 0;
                                    $count = $spratings[1];
                                    foreach ($spratings[0] as $sprating) {
                                        $sprate = ($sprate + $sprating['Ratings']);
                                    }
                                    $sprate = round(($sprate / $count), 2);
                                    $spratings = round($sprate);
                                    $valu = $spratings;
                                    if ($valu != 0) {
                                        $val = '';
                                        $values = '';
                                        for ($i = 1; $i <= $valu; $i++) {

                                            $values = $values .  '<i class="fa fa-star " style="color:rgb(236, 185, 28);"></i>';
                                        }
                                        if ($valu <= 5) {
                                            for ($count = ($spratings + 1); $count <= 5; $count++) {
                                                $values = $values . '<i class="fa fa-star "></i>';
                                            }
                                        }
                                    }
                                    if ($valu = 0) {
                                        $values = '';
                                        for ($i = 1; $i <= 5; $i++) {
                                            $values = $values .  '<i class="fa fa-star " "></i>';
                                        }
                                    }

                                    $values = $values;
                                    $is_favourite =  $this->model->is_favourite($userid, $spid);

                                    if (count($is_favourite[1])) {
                                        foreach ($is_favourite[1] as $fav) {
                                            $isfav = $fav['IsFavorite'];
                                            $isblock = $fav['IsBlocked'];
                                            if ($isfav == 1) {
                                                $favouritebutton = '
                                                        <button type="button" class="btn favourite_btn mr-4" id="' . $spid . '" >UnFavourite</button>';
                                            } else {
                                                $favouritebutton = '
                                                        <button type="button" class="btn favourite_btn mr-4" id="' . $spid . '">Favourite</button>';
                                            }

                                            if ($isblock == 1) {
                                                $blockbtn = '<button type="button" class="btn block_btn " id="' . $spid . '">UnBlock</button>';
                                            } else {
                                                $blockbtn = '<button type="button" class="btn block_btn " id="' . $spid . '">Block</button>';
                                            }
                                        }
                                    } else {
                                        $favouritebutton = '
                                            <button type="button" class="btn favourite_btn mr-4" id="' . $spid . '">Favourite</button>';
                                        $blockbtn = '<button type="button" class="btn block_btn " id="' . $spid . '">Block</button>';
                                    }

                                    $output .= '  <td>
                                        <div class="border fav_msg text-center">
                                            <div class="row text-center">
                                            <div class=" cap-icon ml-5" ><img src="./Asset/image/cap.png" alt=".."></div>
                                             </div>  
                                            
                                                <div class="">' . $fname . '   ' . $lname . '</div>
                                                <div class=" ">
                                                    ' . $values . '
                                                    <span>' . $sprate . '</span>
                                                </div>
                                                <div class=" ">
                                                    ' . $counts . ' Cleanings
                                                </div>
                                           
                                            
                                                <div class=" text-center">   
                                                ' . $favouritebutton . '
                                                    ' . $blockbtn . '
                                                </div>
                                                </div>
                              
                                    </td>';
                                } else {
                                    $is_favourite =  $this->model->is_favourite($userid, $spid);

                                    if (count($is_favourite[1])) {
                                        foreach ($is_favourite[1] as $fav) {
                                            $isfav = $fav['IsFavorite'];
                                            $isblock = $fav['IsBlocked'];
                                            if ($isfav == 1) {
                                                $favouritebutton = '
                                                              <button type="button" class="btn favourite_btn mr-4" id="' . $spid . '">UnFavourite</button>';
                                            } else {
                                                $favouritebutton = '
                                                              <button type="button" class="btn favourite_btn mr-4" id="' . $spid . '">Favourite</button>';
                                            }

                                            if ($isblock == 1) {
                                                $blockbtn = '<button type="button" class="btn block_btn " id="' . $spid . '">UnBlock</button>';
                                            } else {
                                                $blockbtn = '<button type="button" class="btn block_btn " id="' . $spid . '">Block</button>';
                                            }
                                        }
                                    } else {
                                        $favouritebutton = '
                                                <button type="button" class="btn favourite_btn mr-4" id="' . $spid . '">Favourite</button>';
                                        $blockbtn = '<button type="button" class="btn block_btn " id="' . $spid . '">Block</button>';
                                    }
                                    $values = "";
                                    for ($i = 1; $i <= 5; $i++) {
                                        $values = $values .  '<i class="fa fa-star " ></i>';
                                    }
                                    $output .= '  <td>

                                            <div class="border fav_msg text-center">
                                            
                                            <div class="col-3 cap-icon ml-5" ><img src="./Asset/image/cap.png" alt=".."></div>
                                               
                                            
                                                <div>' . $fname . '   ' . $lname . '</div>
                                                <div>
                                                <span >
                                                    ' . $values . '
                                                    <span >0</span>
                                                </span>
                                                </div>
                                                <div >
                                                    ' . $counts . ' Cleanings
                                                </div>
                                            
                                                <div class="text-center">   
                                                ' . $favouritebutton . '
                                                    ' . $blockbtn . '
                                                </div>
                                        </div>
                              
                                    </td>';
                                }
                            }
                        }
                    }
                }
            }

            echo $output;
        }
    }

    public function favourite()
    {
        if (isset($_POST)) {
            $userid = $_POST['userid'];
            $spid = $_POST['spid'];
            $isfav = $_POST['isfav'];

            $checked = $this->model->check_fav_block($userid, $spid);
            if ($checked[0] == 0) {
                $array = [
                    'userid' => $userid,
                    'targetuser' => $spid,
                    'isfav' => $isfav,
                    'isblock' => 0,
                ];
                $insert = $this->model->insert_fav_block($array);
                if ($insert == 1) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                $array = [
                    'userid' => $userid,
                    'targetuser' => $spid,
                    'isfav' => $isfav,
                    'isblock' => $checked[1],
                ];
                $update = $this->model->update_fav_block($array);
                if ($update == 1) {
                    echo 1;
                } else {
                    echo 2;
                }
            }
        }
    }

    public function block()
    {
        if (isset($_POST)) {
            $userid = $_POST['userid'];
            $spid = $_POST['spid'];
            $isblock = $_POST['isblock'];

            $checked = $this->model->check_fav_block($userid, $spid);
            if ($checked[0] == 0) {
                $array = [
                    'userid' => $userid,
                    'targetuser' => $spid,
                    'isfav' => 0,
                    'isblock' => $isblock,
                ];
                $insert = $this->model->insert_fav_block($array);
                if ($insert == 1) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                $array = [
                    'userid' => $userid,
                    'targetuser' => $spid,
                    'isblock' => $isblock,
                    'isfav' => $checked[2],
                ];
                $update = $this->model->update_fav_block($array);
                if ($update == 1) {
                    echo 1;
                } else {
                    echo 2;
                }
            }
        }
    }
}
