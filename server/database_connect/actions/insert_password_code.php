<?php

if (isset($ACCESS_CONTROL)) {
  $output['success'] = true;
  $email = $post['email'];
  $code = random_number(15);
  $insertPasswordLink = true;

  //get the customer's id
  $query = "SELECT * FROM `customer` WHERE `email` = '{$email}' AND `active` = 1";
  $result = mysqli_query($conn, $query);

  $id = mysqli_fetch_assoc($result)['id'];

  $query = "INSERT INTO `password_reset` (`code`, `customer_id`) VALUES ('$code', '$id')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    if ($_SERVER['HTTP_HOST'] === 'localhost') {
        $verifyLinkRaw = "http://localhost/amnesia?code=$code";
        $verifyLink = "<a href='$verifyLinkRaw'>here</a>";
    } else {
        $verifyLinkRaw = "https://kodwiz.com/amnesia?code=$code";
        $verifyLink = "<a href='$verifyLinkRaw'>here</a>";
    }

    require_once('../php_mailer/mail_handler.php');

  }
} else {
  die('no direct access allowed');
}

function random_number($length) {
    // Ensure the number doesn't start with 0 unless length is 1
    $min = ($length === 1) ? 0 : pow(10, $length - 1);
    $max = pow(10, $length) - 1;

    return random_int($min, $max);
}
