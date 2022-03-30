<?php


$subject = "Edit& Reschedule - Helperland";

$body = "<h6 style='font-size:18px; color:black;'>Hello, $username</h6>
   <h5 style='font-size:17px; color:red;'>The Service Request $serviceid is reschedule by $by.</h5>
   <span><h4>NEW SERVICE DATE :</h4></span> <span> $servicestartdate</span>
   <p>For More Deatils You Can Login...</p>
   </div>
    ";
// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($email, $subject, $body, $headers);
