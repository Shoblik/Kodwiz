<?php

if (isset($ACCESS_CONTROL)) {

  $query = "SELECT * FROM `customer` WHERE `email` = '{$post['email']}' AND `pin` = '{$post['pin']}'";
  $result = mysqli_query($conn, $query);

  if ($result->num_rows > 0) {
    $output['success'] = true;
    $output['url'] = 'http://application.kodwiz.com';
  }

} else {
  die('No direct access allowed');
}
