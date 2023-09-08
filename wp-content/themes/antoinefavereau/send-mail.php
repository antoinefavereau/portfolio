<?php
require_once("../../../wp-load.php");

//user posted variables
if (!isset($_POST['name']) || !isset($_POST['mail']) || !isset($_POST['subject']) || !isset($_POST['message'])) {
    exit;
}

$name = $_POST['name'];
$email = $_POST['mail'];
$subject = "SITE : " . $_POST['subject'];
$message = $_POST['message'];

//php mailer variables
$to = "antoinefavereau45@gmail.com"; //get_option('admin_email');
$headers = 'From: ' . $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

//Here put your Validation and send mail
try {
    $sent = wp_mail($to, $subject, strip_tags($message), $headers);
} catch (\Throwable $th) {
    echo $th;
}

if ($sent) {
    echo "<script>
     alert('Message sent');
 </script>";
} else {
    echo "<script>
    alert('Error');
 </script>";
}
