<?php


$subject = "Edit& Reschedule - Helperland";

$body = "<h6 style='font-size:18px; color:black;'>Hello, $spusername</h6>
   <h5 style='font-size:17px; color:red;'>The Service Request $service_id You Aceepted. Details Of That Service are Changed By Admin.</h5>
   <p><h4>Reason Of Edit :</h4>$reason</p>
   <span><h4>NEW SERVICE DATE :</h4></span> <span> $servicestartdate</span>
   <span><h4>Address :</h4></span> <span> $street $houseno,$city - $postalcode </span>
   <p>For More Deatils You Can Login...</p>
   </div>
    ";
// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($spemail, $subject, $body, $headers);
