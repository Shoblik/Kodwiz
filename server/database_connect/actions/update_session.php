<?php
session_start();

if (!isset($ACCESS_CONTROL) || $ACCESS_CONTROL === false) {
  die('no direct access allowed');
}

$auth = $post['auth'];
$logout = $post['logout'];
$output['logoutSuccess'] = false;

if ($logout) {
  // destroy the session
  session_destroy();
  $output['success'] = true;
  $output['logoutSuccess'] = true;
  $output['authorized'] = false;

} else if (isset($post['id'])) {
  $authObj = [
    'auth' => $auth,
    'id'   => $post['id'],
  ];
  $output['id'] = $post['id'];
  $_SESSION['kodWizAuth'] = json_encode($authObj);
} else {
  die('test');
}
 ?>
