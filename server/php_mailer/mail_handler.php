<?php
require_once('email_config.php');
//require_once('phpmailer/PHPMailer/PHPMailerAutoload.php');

$postJSON = file_get_contents('php://input');
$post = json_decode($postJSON, TRUE);

if (!isset($verifyAccount) && !isset($insertPasswordLink)) {
  $output = [
    'success' => false,
  ];
}
// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("./sendgrid-php.php");
// If not using Composer, uncomment the above line
$mail = new \SendGrid\Mail\Mail();

//$mail = new PHPMailer;
//$mail->SMTPDebug = 0;           // Enable verbose debug output. Change to 0 to disable debugging output.
//
//$mail->isSMTP();                // Set mailer to use SMTP.
//$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers.
//$mail->SMTPAuth = true;         // Enable SMTP authentication
//
//
//$mail->Username = EMAIL_USER;   // SMTP username
//$mail->Password = EMAIL_PASS;   // SMTP password
//$mail->SMTPSecure = 'tls';      // Enable TLS encryption, `ssl` also accepted, but TLS is a newer more-secure encryption
//$mail->Port = 587;              // TCP port to connect to
//$options = array(
//    'ssl' => array(
//        'verify_peer' => false,
//        'verify_peer_name' => false,
//        'allow_self_signed' => true
//    )
//);
//$mail->smtpConnect($options);


    if (isset($verifyAccount)) {
      $mail->setFrom('business@kodwiz.com', 'KodWiz');  // sender's email address (shows in "From" field)
      $mail->addTo($post['email']);  // Add a recipient

      $mail->setSubject('Verify your Account');
      $mail->addContent('text/html', 'Thank you for signing up with Kod Wiz please follow the link to activate your account ' . $verifyLink . '<br><br>Or paste this in you search bar<br><br>' . $verifyLinkRaw);

    } else if (isset($insertPasswordLink)) {
      $mail->setFrom('business@kodwiz.com', 'KodWiz');  // sender's email address (shows in "From" field)
      $mail->addTo($post['email']);  // Add a recipient

      $mail->setSubject('Password reset');
      $mail->addContent('Please follow the link to reset your password ' . $verifyLink . '<br><br>or paste this in your search bar<br><br>' . $verifyLinkRaw);

    } else {
      $mail->setFrom('business@kodwiz.com', 'KodWiz');  // sender's email address (shows in "From" field)
      $mail->addTo('business@kodwiz.com');  // Add a recipient
      $mail->addTo('otto.oficial@gmail.com');
      $mail->addTo('jhoblik@yahoo.com');
      $mail->addTo('shoblik@yahoo.com');

      $mail->setReplyTo($post['email']);

      $mail->setSubject('Kod Wiz Message');
      $mail->addContent($post['message'] . ' <br /><br /> From ' . $post['name'] . '<br/><br/> ' . $post['phone']);
    }

      $sendgrid = new \SendGrid(SENDGRID_API_KEY);

      $response = $sendgrid->send($mail);

    if($response->statusCode() != 202) {
        $output['success'] = false;
        $output['message'] = 'There was an error';
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
