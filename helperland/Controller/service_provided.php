<?php

$to_email = $email;
$subject = "New Service Booked!";

$body = "<h4 style='font-size:16px; '>This email is for your information that you have received service.</h6>
   <h5 style='font-size:20px; '>Please Check Booked Service and accept the request.</h5>
   <br>
  <h4 style='font-size:20px; '>Service Request Id : <span style='color:green;'>$servicerequestid</span></h4>
   <h4 style='font-size:20px;'>If want you to accept service request then confirm it after login.</h4>
    ";
// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to_email, $subject, $body, $headers);
