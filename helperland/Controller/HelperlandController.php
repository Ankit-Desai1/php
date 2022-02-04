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
           
            if($user['Email'] !== $email ){
                $_SESSION['message'] = 'Email is not exist.';
                header('Location: ' . $base_url);
            }
            elseif(!password_verify($password,$user['Password'])){
                $_SESSION['msg'] = 'Email & Password not match';
                header('Location: ' . $base_url);
                }
            else{ 
                $_SESSION['username']=$user['FirstName']; 
                if (isset($_POST['remember'])) {
                    setcookie('emailcookie', $email, time() + 86400, '/');
                    setcookie('passwordcookie', $password, time() + 86400, '/');

                    if($user['UserTypeId']==1){
                        echo'service provider';
                    }
                    elseif($user['UserTypeId']==2){
                        header('Location: ' . $base_url2);   
                    }
                    else{
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
        if(isset($_POST)){
            $array=[
            'firstname' => $_POST['firstname'].' ' .$_POST['lastname'] ,
            'phonenumber' => $_POST['phonenumber'],
            'email' => $_POST['email'],
            'subject' => $_POST['subject'],
            'message' => $_POST['message'],
            'createdon'=> date('Y-m-d')
        ];
        $contact = $this->model->contact('contactus',$array);
        header('Location: ' . $base_url);
        }
        else{
            header('Location: ' . $base_url);
        }
        
    }

    public function contact(){
        include('./View/contact.php');
    }

   public function become_a_pro(){
       include('./View/become-a-pro.php');
   }

    public function customer_registration(){
        include('./View/customer_registration.php');
    }

    public function reset(){
        $id= $_GET['parameter'];
        include('./View/forgot.php');
    }

    public function book_service(){
        include('./View/book_service.php');
    }

    public function about(){
        include('./View/about.php');
    }

    public function faq(){
        include('./View/FAQ.php');
    }

    public function prices(){
        include('./View/prices.php');
    }
}
?>