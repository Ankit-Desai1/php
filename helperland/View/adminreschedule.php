<?php


$subject = "Edit& Reschedule - Helperland";

$body = "<h6 style='font-size:18px; color:black;'>Hello, $username</h6>
   <h5 style='font-size:17px; color:red;'>Your Service Request $service_id Details Are Changed By Admin.</h5>
   <span><h4>Reason Of Edit :</h4></span><span> $reason</span>
   <span><h4>NEW SERVICE DATE :</h4></span> <span> $servicestartdate</span>
   <span><h4>Address :</h4></span> <span> $street $houseno,$city - $postalcode </span>
   <p>For More Deatils You Can Login...</p>
   </div>
    ";
// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($email, $subject, $body, $headers);
