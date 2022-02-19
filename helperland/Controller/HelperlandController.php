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
            } else {
                echo 0;
            }
        }
    }
}
