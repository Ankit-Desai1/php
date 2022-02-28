<?php
class HelperlandController
{
    function __construct()
    {
        include('Model/Connection.php');
        $this->model = new Helperland();
    }

    public function HomePage()
    {
        include('./View/homepage.php');
    }

    public function login()
    {
        session_start();
        $base_url = 'http://localhost/php/helperland/index.php#loginform';
        $base_url2 = 'http://localhost/php/helperland/?controller=Helperland&function=book_service';

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
            $username = $_POST['username'];
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

            //echo "hilo";
            $userid = 17;
            // $userid = $_POST['userid'];
            // echo $userid;
            // $record_per_page = 5;
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

            //echo $record_per_page;

            $start_from = ($page - 1) * $record_per_page;


            $output .= '   <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Service Details <img src="../image/sort.png" alt="..."></th>
                            <th scope="col"> Service Provider<img src="../image/sort.png" alt="..."></th>
                            <th scope="col"> Payment <img src="../image/sort.png" alt="..."></th>
                            <th scope="col"> Status <img src="../image/sort.png" alt="..."></th>
                            <th scope="col"> Rate SP </th>
                        </tr>
                    </thead>
                    <tbody class="clearfix">
                    ';
            $get_address = $this->model->customer_data($userid, $start_from, $record_per_page);
            if ($get_address) {
                foreach ($get_address as $row) {
                    $output .= '  
                       
                        <tr class="show_all_detail">
                            <td data-label="Service Details">
                                <img src="../Asset/image/calendar.png" alt="calender"><span class="date">' . $row['ServiceStartDate'] . '</span>
                                <p>12:00-18:00</p>

                            </td>
                            <td data-label="Service Provider" class="clearfix">
                                <div class="cap-icon"><img src="../Asset/image/cap.png" alt=".."></div>Lyum Watson
                                <div>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span>4</span>
                                </div>
                            </td>
                            <td data-label="Payment">
                                <p class="price">€' . $row['TotalCost'] . '</p>
                            </td>
                            <td data-label="Status"> <button class="' . $row['Status'] . '">' . $row['Status'] . '</button></td>
                            <td data-label="Rate SP"><button class="rate" id="' . $row['ServiceRequestId'] . '">Rate SP</button></td>
                        </tr>  
                   ';
                }
                //echo $output;
                $output .= '</tbody>
                </table> 
                
                <div class="card mobileview clearfix" style="width: 100%;">
                   ';
                foreach ($get_address as $row) {
                    $output .= ' 
                    <div class="card-body">
                    <span><img src="../Asset/image/calendar.png" alt="calender"><span class="date">' . $row['ServiceStartDate'] . '</span> 
                        </span>
                        <hr>
                        <div class="cap-icon"><img src="../Asset/image/cap.png" alt=".."></div>Lyum Watson
                        <div>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span>4</span>
                        </div>
                        <hr>
                        <p class="price">€' . $row['TotalCost'] . '</p>
                        <hr>
                        <div class="text-center"><button class="' . $row['Status'] . '">' . $row['Status'] . '</button></div>
                        <hr>
                        <div class="text-center"><button class="rate" id="' . $row['ServiceRequestId'] . '">Rate SP</button></div>
                    </div>';
                }

                $total_record = $this->model->old_service();
                $total_pages = ceil($total_record / $record_per_page);
                $output .= '</div> <div class="pagenumber">
                <div class="pagenumber-left">
                    <span style="margin-right:5px;">Show</span>
                    <span class="ml-2"><select class="form-select" id="no_of_service">
                                        <option selected value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                    </select></span>
                    <span style="margin-left:5px;">entries Total Record: ' . $total_record . '</span>
                </div>
                <div class="pagenumber-right">';

                if ($page > 1) {
                    $previous = $page - 1;

                    $output .= '<div class="pagenumber-btn" id="1">
                    <img src="../Asset/image/first-page.png" alt="">
                </div>';

                    $output .= ' <div class="pagenumber-btn" id="' . $previous . '">
                    <img src="../Asset/image/keyboard-right-arrow-button-copy.png" alt="">
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
                    <img class="transform_btn" src="../Asset/image/keyboard-right-arrow-button-copy.png" alt="">
                </div>';

                    $output .= '<div class="pagenumber-btn" id="' . $total_pages . '">
                    <img class="transform_btn" src="../Asset/image/first-page.png" alt="">
                </div>';
                }
                $output .= ' </div>
                </div>
            </div>';
            } else {
                // echo "Data not Found";
            }

            echo $output;
        }
    }




    public function dashboard_data()
    {
        if (isset($_POST)) {

            //echo "hilo";
            $userid = 17;
            // $userid = $_POST['userid'];
            // echo $userid;
            // $record_per_page = 5;
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

            //echo $record_per_page;

            $start_from = ($page - 1) * $record_per_page;


            $output .= '   <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Service Id</th>
                            <th scope="col">Service Details <img src="../image/sort.png" alt="..."></th>
                            <th scope="col"> Service Provider<img src="../image/sort.png" alt="..."></th>
                            <th scope="col"> Payment <img src="../image/sort.png" alt="..."></th>
                            <th scope="col"> Action </th>
                        </tr>
                    </thead>
                    <tbody class="clearfix">
                    ';
            $get_request = $this->model->dashboard_data($userid, $start_from, $record_per_page);
            if ($get_request) {
                foreach ($get_request as $row) {
                    $output .= '  
                        <tr class="show_all_detail" id="' . $row['ServiceRequestId'] . '">
                            <td data-label="Service Id" >
                                <p>' . $row['ServiceRequestId'] . '</p>
                            </td>
                            <td data-label="Service Details" >
                                <img src="../Asset/image/calendar.png" alt="calender"><span class="date">' . $row['ServiceStartDate'] . '</span>
                                <p>12:00-18:00</p>
                            </td>
                            <td data-label="Service Provider" class=" clearfix">
                                <div class="cap-icon"><img src="../Asset/image/cap.png" alt=".."></div>Lyum Watson
                                <div>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span>4</span>
                                </div>
                            </td>
                            <td data-label="Payment" >
                                <p class="price">€' . $row['TotalCost'] . '</p>
                            </td>
                            <td data-label="Action"><button class="reschedule" id="' . $row['ServiceRequestId'] . '">Reschedule</button><button class="cancel" id="' . $row['ServiceRequestId'] . '">Cancel</button></td>
                        </tr>  
                   ';
                }
                //echo $output;
                $output .= '</tbody>
                </table> 
                
                <div class="card mobileview clearfix" style="width: 100%;">
                   ';
                foreach ($get_request as $row) {
                    $output .= ' 
                    <div class="card-body">
                    <p class="deletedid">' . $row['ServiceRequestId'] . '</p>
                    <hr>
                    <span><img src="../Asset/image/calendar.png" alt="calender"><span class="date">' . $row['ServiceStartDate'] . '</span> 
                        </span>
                        <hr>
                        <div class="cap-icon"><img src="../Asset/image/cap.png" alt=".."></div>Lyum Watson
                        <div>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span>4</span>
                        </div>
                        <hr>
                        <p class="price">€' . $row['TotalCost'] . '</p>
                        <hr>
                        
                        <div class="text-center"><button class="reschedule" id="' . $row['ServiceRequestId'] . '">Reschedule</button><button class="cancel" id="' . $row['ServiceRequestId'] . '">Cancel</button></div>
                    </div>';
                }


                $total_record = $this->model->all_service();
                $total_pages = ceil($total_record / $record_per_page);
                $output .= '</div> <div class="pagenumber">
                <div class="pagenumber-left">
                    <span style="margin-right:5px;">Show</span>
                    <span class="ml-2"><select class="form-select" id="no_of_service">
                                        <option selected value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                    </select></span>
                    <span style="margin-left:5px;">entries Total Record: ' . $total_record . '</span>
                </div>
                <div class="pagenumber-right">';

                if ($page > 1) {
                    $previous = $page - 1;

                    $output .= '<div class="pagenumber-btn" id="1">
                    <img src="../Asset/image/first-page.png" alt="">
                </div>';

                    $output .= ' <div class="pagenumber-btn" id="' . $previous . '">
                    <img src="../Asset/image/keyboard-right-arrow-button-copy.png" alt="">
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
                    <img class="transform_btn" src="../Asset/image/keyboard-right-arrow-button-copy.png" alt="">
                </div>';

                    $output .= '<div class="pagenumber-btn" id="' . $total_pages . '">
                    <img class="transform_btn" src="../Asset/image/first-page.png" alt="">
                </div>';
                }
                $output .= ' </div>
                </div>
                </div>';
            }
            echo $output;
        } else {
            // echo "Data not Found";
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
            //$service_id = $_POST['serviceid'];
            //$date = $_POST['date'];
            // $time = $_POST['time'];

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
            $service_id = $_POST['serviceid'];
            $result = $this->model->detail_of_service($service_id);
            if ($result) {

                foreach ($result as $row) {
                    $output .= '
                        <div class="modal" tabindex="-1" id="all_detail">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Service Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>start date: ' . $row['ServiceStartDate'] . '</p>
                                            <p>Duration: <span>' . $row['SubTotal'] . '</span> </p>
                                            <hr>
                                            <p>Service id: <span>' . $row['ServiceRequestId'] . '</span></p>
                                            <p>Extras: <span>' . $row['ExtraService'] . '</span> </p>
                                            <p>Net Amount: <span>' . $row['TotalCost'] . '</span> </p>
                                            <hr>
                                            <p>Service Address:</p>
                                            <p>Billing Address: same as cleaninng address</p>
                                            <p>phone:</p>
                                            <p>Email:</p>
                                            <hr>
                                            <p>Comments :' . $row['Comments'] . '</p>
                                            <hr>
                                            <div class="text-center">
                                                <button class="reschedule" id="' . $row['ServiceRequestId'] . '">Reschedule</button><button class="cancel" id="' . $row['ServiceRequestId'] . '">Cancel</button>
                                            </div> 
                                        </div>
                                </div>
                            </div>
                        </div>';
                }
            }

            echo $output;
        }
    }
}
