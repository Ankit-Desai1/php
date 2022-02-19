<?php


$to_email = $email;
$subject = "Your Service Has Been Booked Succesfully!!";

$body = "<h3>Hello $username,</h3>
<h4>Your service booking has been completed successfully on below email</h4>
<h4><span style='font-weight: bold;'>Email :</span> $email</h4>

    <h6 style='font-weight: bold;' > Your Service ID is: <span style='color:red;'>$servicerequestid</span></h6>

    <table border='1'>
        <tr>
            <th> Booking Summary </th>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Service Request Id :</span> $servicerequestid </td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Email : </span> $email </td>
        </tr>

        <tr>
            <td><span style='font-weight: bold;'>ServiceStartDate : </span> $servicestartdate </td>
        </tr>

        <tr>
            <td><span style='font-weight: bold;'>Pincode : </span> $zipcode </td>
        </tr>

        <tr>
            <td><span style='font-weight: bold;'>ServiceHourlyRate : </span> $servicehourrate </td>
        </tr>

        <tr>
            <td><span style='font-weight: bold;'>Basic Hours : </span> $servicehours Hrs</td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Extra Hours : </span> $extrahour Hrs</td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Total Hours : </span> $subtotal </td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Total Cost : </span> $totalcost </td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Effective Cost : </span> $totalcost </td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Extra Services : </span> $extraservice</td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Comments : </span> $comments </td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Address : </span> $street , $houseno , $city , $pincode </td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Mobile Number :</span> $mobile </td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Has Pets : </span> $haspets</td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Payment Status :</span> Success </td>
        </tr>
        <tr>
            <td><span style='font-weight: bold;'>Payment Date :</span> $date </td>
        </tr>
    </table>
    <br>
    <p>Please Do Not Share This Details Anyone.</p>
    ";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to_email, $subject, $body, $headers);
