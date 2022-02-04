<?php
class registrationController
{
    function __construct()
    {
        include('Model/registration.php');
        $this->model = new Helperland();
    }

    public function register(){
        session_start();
        $base_url = 'http://localhost/php/helperland/index.php#loginform';
        $base_url1 = 'http://localhost/php/helperland/?controller=Helperland&function=become_a_pro&status=alert';
        $base_url2 = 'http://localhost/php/helperland/?controller=Helperland&function=become_a_pro';
        if(isset($_POST)){
            $password = $_POST['password'];
            $confirmpassword= $_POST['confirmpassword'];
            $pass = password_hash($password, PASSWORD_BCRYPT);

            $array=[
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'phonenumber' => $_POST['phonenumber'],
            'password' => $pass,
            'usertypeid' => '1',
            'createdon'=> date('Y-m-d H:i:s')
            ];
            $count = $this-> model->check($array['email']);
            if($count == 1 ){
                $_SESSION['message'] = 'Email already exist.';
                header('Location: ' . $base_url1);
            }
            else {
                $user = $this->model->registration('user',$array);
                header('Location: ' . $base_url);
            } 
        }
        else{
            header('Location: ' . $base_url2);
        }
    }

    
    
    public function customer(){
        session_start();
        $base_url = 'http://localhost/php/helperland/index.php#loginform';
        $base_url1 = 'http://localhost/php/helperland/?controller=Helperland&function=customer_registration&status=alert';
        $base_url2 = 'http://localhost/php/helperland/?controller=Helperland&function=customer_registration';
        if(isset($_POST)){
            
            $password = $_POST['password'];
            $confirmpassword= $_POST['confirmpassword'];
            $pass = password_hash($password, PASSWORD_BCRYPT);

            $array=[
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'email' => $_POST['email'],
                'phonenumber' => $_POST['phonenumber'],
                'password' => $pass,
                'usertypeid' => '2',
                'createdon'=> date('Y-m-d H:i:s')
            ];
            $count = $this-> model->check($array['email']);
            if($count == 1 ){
                $_SESSION['message'] = 'Email already exist.';
                header('Location: ' . $base_url1);
            }
            else {
                $user = $this->model->registration('user',$array);
                header('Location: ' . $base_url);
            }          
        }
        else{
            header('Location: ' . $base_url2);
        }
    }

    public function forgot(){
        if(isset($_POST))
        {
            $email = $_POST['email'];
            
            $user = $this->model->select($email);
            // $username = $user['Firstname'];
            $username = $user[0];
            $id = $user[1];
            if($user){
                echo'check your mail';
                include('mailController.php');
                
            }
            else{
                echo'email not found';
            }
        }
    }



    public function resetpassword(){
            
        if(isset($_POST)){
            
            $id= $_GET['parameter'];
            $password= $_POST['password'];
            $confirmpassword= $_POST['confirmpassword'];
            
           

            if($password == $confirmpassword){
                $pass = password_hash($password, PASSWORD_BCRYPT);
                $array=[
                    'id'=> $id,
                    'password'=> $pass,
                    'modifiedby'=>0,
                    'modifieddate'=>date('Y-m-d H:i:s'),
                    ];

                $reset = $this->model->update($array);
            }
            else{              
                echo'password is not matching';
            }
            
        }
        else{
            echo'some error occur';
        }
        include('./View/forgot.php');
    }
}
?>