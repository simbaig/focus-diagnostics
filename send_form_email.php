<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message']; // Added this line to retrieve the message field

    // Create a new PHPMailer instance for sending inquiry email
    $mail = new PHPMailer();

    // SMTP configuration (if required)
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0; // Change this to 0 to suppress debugging output
    $mail->Username = 'donotreply@diagnosticsfocus.com';
    $mail->Password = 'Wasim@123';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Set email parameters for inquiry email
    $mail->setFrom('donotreply@diagnosticsfocus.com', 'Diagnostics Focus');
    $mail->addAddress('drkarthikhegde@gmail.com'); // Add recipient
    $mail->Subject = 'New Inquiry Received';
    $mail->isHTML(true);
    $mail->Body = "<h2>New Inquiry Received</h2><br>Name: $name<br>Email: $email<br>Phone: $phone<br>Message: $message"; // Updated email body to include message field

    // Send the inquiry email
    if ($mail->send()) {
        // Send a thank you email to the customer
        $thankYouMail = new PHPMailer();
        $thankYouMail->isSMTP();
        $thankYouMail->Host = 'smtp.hostinger.com';
        $thankYouMail->SMTPAuth = true;
        $thankYouMail->SMTPDebug = 0; // Change this to 0 to suppress debugging output
        $thankYouMail->Username = 'donotreply@diagnosticsfocus.com';
        $thankYouMail->Password = 'Wasim@123';
        $thankYouMail->SMTPSecure = 'ssl';
        $thankYouMail->Port = 465;

        $thankYouMail->setFrom('donotreply@diagnosticsfocus.com', 'Diagnostics Focus');
        $thankYouMail->addAddress($email); // Add recipient (customer's email)
        $thankYouMail->Subject = 'Thank You for Your Interest in Focus Vascular Clinics!';
        $thankYouMail->isHTML(true);
        $thankYouMail->Body = "
        <h5>Dear $name,</h5><br>
        <p>Thank you for reaching out to Focus Vascular Clinics regarding our varicose veins and varicose ulcers treatment services. We appreciate your interest in finding lasting relief for these conditions.</p><br>
        <p>At Focus Vascular Clinics, we pride ourselves on offering advanced and effective treatments for varicose issues, including our renowned VenaSeal procedure. Our approach focuses on minimally invasive procedures that are ideal for high-risk or elderly patients, ensuring a swift recovery with same-day discharge and eliminating concerns about recurrence, burns, scars, or the need for stockings.</p><br>
        <p>As you've expressed interest in our services, we want to assure you that your inquiry is important to us. A member of our team will be reaching out to you shortly to discuss your specific needs and schedule a callback at a time convenient for you. We understand the importance of personalized care and look forward to assisting you on your journey to better vascular health.</p><br>
        <p>In the meantime, feel free to explore more about our treatments, our team of experienced Vascular Surgeons and Radiologists, and our accolades for excellence in varicose treatments on our website and YouTube channel.</p><br>
        <p>For more information, you can always reach us at 9845901793 or visit our website at <a href='https://diagnosticsfocus.com'>https://diagnosticsfocus.com</a>.</p><br>
        <p>Thank you once again for considering Focus Vascular Clinics for your healthcare needs. We look forward to speaking with you soon.</p><br>
        <p>Best regards,<br>Team Focus, Patient Coordinators</p>";

        if ($thankYouMail->send()) {
            // Redirect to thankyou page
            header('Location: thankyou.html');
            exit();
        }
    } else {
        echo 'Inquiry Email Error: ' . $mail->ErrorInfo;
    }
}
?>
