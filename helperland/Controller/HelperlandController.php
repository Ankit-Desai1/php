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
        include('View/homepage.php');
        // header("location:View/homepage.php");
       
    }

    public function contact(){
        include('View/contact.php');
    }


    // public function login()
    // {
    //     $base_url = 'http://localhost/helperland/?controller=Helperland&function=login';
    //     if (isset($_POST)) {
    //         $array = [
    //             'email' => $_POST['email'],
    //             'pswd' => $_POST['pswd']
    //         ];
    //         $last_id = $this->model->insert('form', $array);
    //         // header('Location: ' . $base_url);
    //         echo'yupppppp';
    //     } else {
    //         echo 'Error Occured Try Again';
    //     }
    // }
}
?>