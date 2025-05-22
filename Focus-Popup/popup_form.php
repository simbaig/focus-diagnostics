<?php
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

// Retrieve form data
$First_Name = $_POST['name'];
$Email = $_POST['email'];
$Mobile = $_POST['number'];
$SymptomTime = $_POST['symptomTime'];
$TreatmentsBefore = $_POST['treatmentsBefore'];
$ExistingHealthConditions = $_POST['existingHealthConditions'];
$StartTime = $_POST['startTime'];
$OtherHealthCondition = isset($_POST['otherHealthCondition']) ? $_POST['otherHealthCondition'] : ''; // Capture the "Other" condition

function smtpmailer($from, $from_name, $subject, $body)
{
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 465;
    $mail->Username = 'info@diagnosticsfocus.com';
    $mail->Password = 'Diagnosticsfocus@123'; // Replace with your email password
    $mail->isHTML(true);
    $mail->setFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->addAddress('drkarthikhegde@gmail.com');

    if (!$mail->send()) {
        return "Please try Later, Error Occurred: " . $mail->ErrorInfo;
    } else {
        return "Thank You! Your email has been sent.";
    }
}

// Construct email message
$from = 'info@diagnosticsfocus.com';
$name = 'Diagnostics Focus';
$subject = "New Inquiry Received From Popup Form";
$message = "<html><body>";
$message .= "Dear Sir/Madam,<br/><br/>";
$message .= "New Inquiry Received From Popup Form<br/><br/>";
$message .= "Name: $First_Name <br/>";
$message .= "Email: $Email <br/>";
$message .= "Phone Number: $Mobile <br/>";
$message .= "Symptom Time: $SymptomTime <br/>";
$message .= "Treatments Before: $TreatmentsBefore <br/>";
$message .= "Existing Health Conditions: $ExistingHealthConditions <br/>";
if ($ExistingHealthConditions == "Other (please specify)" && !empty($OtherHealthCondition)) {
    $message .= "Other Health Condition: $OtherHealthCondition <br/>";
}
$message .= "Start Time: $StartTime<br/><br/>";
$message .= "</body></html>";

$error = smtpmailer($from, $name, $subject, $message);

// Send response
if ($error) {
    echo $error;
} else {
    echo "Failed to send email. Please try again later.";
}
?>