<?php

if (!isset($ACCESS_CONTROL) || $ACCESS_CONTROL === false) {
  die('no direct access allowed');
}

  $password = SHA1("{$post['password']}");
  $query = "SELECT * FROM `user` WHERE `email` = '{$post['email']}' AND `password` = '$password'";
  $result = mysqli_query($conn, $query);

  if ($result->num_rows > 0) {
    $output['success'] = true;

    $date = date('mdY');
    $email = $post['email'];

    $post['auth'] = true;
    $post['logout'] = false;
    $post['id'] = mysqli_fetch_assoc($result)['id'];

    require('./actions/update_session.php');
    
  }
