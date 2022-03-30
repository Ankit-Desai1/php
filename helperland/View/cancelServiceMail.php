<?php


$subject = "Cancel Service - Helperland";

$body = "<h6 style='font-size:18px; color:black;'>Hello, $spusername</h6>
   <h5 style='font-size:17px; color:red;'>The Service Request $service_id You Aceepted Is cancelled By Customer.</h5>
   </div>
    ";
// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($spemail, $subject, $body, $headers);
