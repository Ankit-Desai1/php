<?php


$subject = "Service Accepted - Helperland";

$body = "<h6 style='font-size:18px; color:black;'>Hello, $cname</h6>
   <h5 style='font-size:17px; color:red;'>Your Service Request $serviceid is accepted by $username.</h5>
   <p>For More Deatils You Can Login...</p>
   </div>
    ";
// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($email, $subject, $body, $headers);
