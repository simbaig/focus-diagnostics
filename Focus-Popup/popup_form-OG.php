<?php
require "PHPMailer/PHPMailerAutoload.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Retrieve form data
$First_Name = $_POST['name'];
$Email = $_POST['email'];
$Mobile = $_POST['number'];
$SymptomTime = $_POST['symptomTime'];
$TreatmentsBefore = $_POST['treatmentsBefore'];
$ExistingHealthConditions = $_POST['existingHealthConditions'];
$StartTime = $_POST['startTime'];


function smtpmailer($from, $from_name, $subject, $body)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = false;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 465;
    $mail->Username = 'donotreply@ithink.co';
    $mail->IsHTML(true);
    $mail->From = "donotreply@ithink.co";
    $mail->FromName = "donotreply";
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress('marketingteam@ithink.co', 'Think Technology Services - Marketing Team');
    // $mail->AddAddress('sales@ithink.co', 'Think Technology Services - Sales Team');
    // $mail->AddAddress('devteam@ithink.co','Think Technology Services - Dev Team');
    if (!$mail->Send()) {
        $error = "Please try Later, Error Occured while Processing...";
        return $error;
    } else {
        $error = "Thanks You !! Your email is sent.";
        return $error;
    }
}

// Construct email message
$from = 'donotreply@ithink.co';
$name = 'Think Technology Services';
// $to = "devteam@ithink.co";
$subject = "Enquiry submitted on iThink.co for Google Workspace";
$message = "<html><body>";
$message .= "Dear Sir/Madam,<br/><br/>";
$message .= "Congratulations! An enquiry has been submitted from your Google Adwords Campaign on <a href='https://www.ithink.co/dm/google-workspace' target='_blank'>www.iThink.co</a> with the following information:<br/><br/>";
$message .= "Name: $First_Name <br/>";
$message .= "Email: $Email <br/>";
$message .= "Phone Number: $Mobile <br/>";
$message .= "Company Name: $Company <br/>";
$message .= "Email Provider: $EmailProvider <br/>";
$message .= "User Count: $No_of_Users <br/>";
$message .= "Start Time: $StartTime<br/><br/>";
$message .= "This form is powered by <a href='https://www.ithink.co' target='_blank'>www.iThink.co</a><br/>";
$message .= "</body></html>";

$error = smtpmailer($from, $name, $subject, $message);

// Send email
// $headers = "MIME-Version: 1.0\r\n";
// $headers .= "Content-type: text/html; charset=UTF-8\r\n";
// $headers .=  "From: donotreply@ithink.co\r\n";;
// $headers .= "Reply-To: devteam@ithink.co\r\n";

// $url = "https://script.google.com/macros/s/AKfycbzt1l_rxRzaQVpd5HS5VLmrHzRE2YagSGYJwHKGUjjFWmuJ0_IUiTh_rSiqTGZdq8V0/exec";
// $url = "https://script.google.com/macros/s/AKfycbwQGkU1O-UPCC0TrK6TE5Dq1AlLWuLbhoUwpMKiqAdlCqzwyxEIzBfl4Hg5S3edSp-S/exec";
// $url = "https://script.google.com/macros/s/AKfycbxL2cxIC1JeCgHkLNR6RVsAqkU6-7fzRtttEkXxdTujnKo810IUI3R9wdfSiZ7MYSOg/exec";
// $url = "https://script.google.com/macros/s/AKfycbzt1l_rxRzaQVpd5HS5VLmrHzRE2YagSGYJwHKGUjjFWmuJ0_IUiTh_rSiqTGZdq8V0/exec";
$url = "https://script.google.com/macros/s/AKfycbwoPOjg2L0I6DmzaK_103I0lo6-edlPbpuYY_ayU3pBpi3Go2L-R5vS3HsDA3XBLVjR/exec";

$ch = curl_init();

$post_data = array(
    'First_Name' => $_POST['name'],
    'Email' => $_POST['email'],
    'Mobile' => $_POST['number'],
    'Company' => $_POST['companyName'],
    'EmailProvider' => $_POST['emailProvider'],
    'No_of_Users' => $_POST['userCount'],
    'sourcepage' => $_POST['sourcepage'],
    'source' => $_POST['source'],
    'campaign_type' => $_POST['campaign_type'],
    'keyword' => $_POST['keyword'],
    'match_type' => $_POST['match_type'],
    'device' => $_POST['device'],
    'campaign_id' => $_POST['campaign_id'],
    'creative' => $_POST['creative'],
);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$info = curl_getinfo($ch);

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);



// if (mail($to, $subject, $message, $headers)) {
//     echo "Your inquiry has been submitted successfully!";
// } else {
//     echo "Failed to submit inquiry. Please try again later.";
// }
?>