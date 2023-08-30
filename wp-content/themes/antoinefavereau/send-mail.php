<?php
//user posted variables
$name = $_POST['name'];
$email = $_POST['mail'];
$subject = "SITE : " . $_POST['subject'];
$message = $_POST['message'];

//php mailer variables
$to = get_option('admin_email');
$headers = 'From: ' . $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

//Here put your Validation and send mail
$sent = wp_mail($to, $subject, strip_tags($message), $headers);

if ($sent) {
    echo "<script>
    alert('Message sent');
</script>";
} else {
    echo "<script>
    alert('Error');
</script>";
}
