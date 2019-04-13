<?php

if (isset($ACCESS_CONTROL)) {
  $output['success'] = true;
  $email = $post['email'];
  $code = random_str(15);
  $insertPasswordLink = true;

  //get the customer's id
  $query = "SELECT * FROM `customer` WHERE `email` = '{$email}' AND `active` = 1";
  $result = mysqli_query($conn, $query);

  $id = mysqli_fetch_assoc($result)['id'];

  $query = "INSERT INTO `password_reset` (`code`, `customer_id`) VALUES ('$code', '$id')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    if ($_SERVER['HTTP_HOST'] === 'localhost') {
      $verifyLink = "<a href='http://localhost/amnesia?code=$code'>here</a>";
    } else {
      $verifyLink = "<a href='https://kodwiz.com/amnesia?code=$code'>here</a>";
    }

    require_once('../php_mailer/mail_handler.php');

  }
} else {
  die('no direct access allowed');
}

function random_str($length, $keyspace = '0123456789') {
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
