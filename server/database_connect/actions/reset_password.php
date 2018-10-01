<?php

if (isset($ACCESS_CONTROL)) {
  $code = $post['code'];
  $password = SHA1("{$post['password']}");

  //get customer id via code
  $query = "SELECT * FROM `password_reset` WHERE `code` = '{$code}'";
  $result = mysqli_query($conn, $query);

  if ($result->num_rows) {

    $id = mysqli_fetch_assoc($result)['customer_id'];
    $output['id'] = $id;

    $query = "UPDATE `customer` SET `password` = '$password' WHERE `id` = '$id'";
    $output['query'] = $query;
    $result = mysqli_query($conn, $query);

    if ($result) {
      $output['password_updated'] = true;
    }
  }
} else {
  die('no direct access allowed');
}
?>
