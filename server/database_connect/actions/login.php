<?php

if (isset($ACCESS_CONTROL)) {

  $password = SHA1("{$post['password']}");
  $query = "SELECT * FROM `customer` WHERE `email` = '{$post['email']}' AND `password` = '$password' AND `active` = 1";
  $result = mysqli_query($conn, $query);

  if ($result->num_rows > 0) {
    $output['success'] = true;
    $output['url'] = 'http://application.kodwiz.com';
  }

} else {
  die('No direct access allowed');
}
