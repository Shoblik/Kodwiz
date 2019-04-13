<?php
require_once('email_config.php');
require_once('phpmailer/PHPMailer/PHPMailerAutoload.php');

$postJSON = file_get_contents('php://input');
$post = json_decode($postJSON, TRUE);

if (!isset($verifyAccount) && !isset($insertPasswordLink)) {
  $output = [
    'success' => false,
  ];
}
$mail = new PHPMailer;
$mail->SMTPDebug = 0;           // Enable verbose debug output. Change to 0 to disable debugging output.

$mail->isSMTP();                // Set mailer to use SMTP.
$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers.
$mail->SMTPAuth = true;         // Enable SMTP authentication


$mail->Username = EMAIL_USER;   // SMTP username
$mail->Password = EMAIL_PASS;   // SMTP password
$mail->SMTPSecure = 'tls';      // Enable TLS encryption, `ssl` also accepted, but TLS is a newer more-secure encryption
$mail->Port = 587;              // TCP port to connect to
$options = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->smtpConnect($options);


    if (isset($verifyAccount)) {
      $mail->From = 'business@kodwiz.com';  // sender's email address (shows in "From" field)
      $mail->FromName = 'KodWiz';   // sender's name (shows in "From" field)
      $mail->addAddress($post['email']);  // Add a recipient

      $mail->isHTML(true);

      $mail->Subject = 'Verify your Account';
      $mail->Body    = 'Thank you for signing up with Kod Wiz please follow the link to activate your account ' . $verifyLink;

    } else if ($insertPasswordLink) {
      $mail->From = 'business@kodwiz.com';  // sender's email address (shows in "From" field)
      $mail->FromName = 'KodWiz';   // sender's name (shows in "From" field)
      $mail->addAddress($post['email']);  // Add a recipient

      $mail->isHTML(true);

      $mail->Subject = 'Password reset';
      $mail->Body    = 'Please follow the link to reset your password ' . $verifyLink;

    } else {
      $mail->From = 'business@kodwiz.com';  // sender's email address (shows in "From" field)
      $mail->FromName = 'KodWiz';   // sender's name (shows in "From" field)
      $mail->addAddress('business@kodwiz.com');  // Add a recipient
      $mail->addAddress('jhoblik@yahoo.com');
      $mail->addAddress('shoblik@yahoo.com');

      $mail->addReplyTo($post['email']);
      $mail->isHTML(true);

      $mail->Subject = 'Kod Wiz Message';
      $mail->Body    = $post['message'];
    }
    $mail->AltBody = htmlentities('something went wrong');

    if(!$mail->send()) {
        $output['success'] = false;
        $output['message'] = $mail->ErrorInfo;
        if (isset($verifyAccount)) {
          $output['message'] = 'An error occured, please contact us at business@kodwiz.com.';
        }
    } else {
//    echo 'Message has been sent';
        $output['emailSent'] = true;
        $output['success'] = true;

        if (isset($verifyAccount)) {
          $output['message'] = 'Success! Thank you for registering, please check your email for an account confirmation link.';
        }
    }
    if (!isset($verifyAccount) && !isset($insertPasswordLink)) {
      $output = json_encode($output);
      print($output);
    }

?>
