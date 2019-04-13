<?php
if (isset($ACCESS_CONTROL)) {
  $output['success'] = true;
  $output['emailSent'] = false;

  if (isset($_GET['target'])) {
    $output['plan'] = $_GET['target'];
  }

  //check if the email is already in the system
  $duplicateQuery = "SELECT * FROM `customer` WHERE `email` = '{$post['email']}'";

  $duplicateResult = mysqli_query($conn, $duplicateQuery);

  $data['num_rows'] = $duplicateResult->num_rows;

  if ($duplicateResult->num_rows === 0) {
    $query = "INSERT INTO `customer` (`name`, `bussiness`, `email`, `phone`, `password`, `date_added`, `active`)
    VALUES ('{$post['name']}', '{$post['bussiness']}', '{$post['email']}', '{$post['phone']}', SHA1('{$post['password']}'), CURRENT_DATE, 0)";

    $result = mysqli_query($conn, $query);

    $output['customer_added'] = $result;

    // generate code in verify customer column
    $insert_id = $conn->insert_id;
    $code = random_str(15);

    $query = "INSERT INTO `verify_customer` (`customer_id`, `confirmation_code`) VALUES ('$insert_id', $code)";
    $result = mysqli_query($conn, $query);

    $output['customer_verification_added'] = true;

    //send email to customer with link to follow to verify account
    $verifyAccount = true;
    if ($_SERVER['HTTP_HOST'] === 'localhost') {
      $verifyLink = "<a href='http://localhost/server/database_connect/server.php?action=get&resource=verify&code=$code'>here</a>";
    } else {
      $verifyLink = "<a href='https://kodwiz.com/server/database_connect/server.php?action=get&resource=verify&code=$code'>here</a>";
    }
    $output['emailSent'] = true;
    require_once('../php_mailer/mail_handler.php');

  } else {
    $output['message'] = 'Error! This email is already in use';
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
