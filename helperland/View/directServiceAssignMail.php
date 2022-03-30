<?php


$subject = "New Service - Helperland";

$body = "<h6 style='font-size:18px; color:black;'>Hello, $spusername</h6>
   <h5 style='font-size:17px; color:red;'>The Service Request $servicerequestid Is Directly Assigned To You By $username.</h5>
   <p>For More Deatils You Can Login...</p>
   </div>
    ";
// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($spemail, $subject, $body, $headers);
