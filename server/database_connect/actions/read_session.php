<?php
session_start();

if (!isset($ACCESS_CONTROL) || $ACCESS_CONTROL === false) {
  die('no direct access allowed');
}

$auth = json_decode($_SESSION['kodWizAuth']);
$output['authorized'] = $auth->auth;
$output['id'] = $auth->id;
$output['success'] = true;

if (isset($_GET['customerInfo']) && $output['authorized']) {
  require('./actions/read_customer_info.php');
}

 ?>
