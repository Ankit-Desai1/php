<?php



  
  $subject = "Forgot Password - Helperland";

  $body = "<h6 style='font-size:18px; color:black;'>Hello, $username</h6>
   <h5 style='font-size:17px; color:red;'> For reset your password click below link</h5>
   <br>
   <a href='http://localhost/php/helperland/?controller=Helperland&function=reset&parameter=$id'> http://localhost/php/helperland/forgot.php</a>
   </div>
    ";
  // Set content-type header for sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  mail($email, $subject, $body, $headers);


// echo'welcome'.$username .$id;
// echo'your email is:'.$email ;

?>