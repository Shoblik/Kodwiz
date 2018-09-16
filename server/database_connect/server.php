<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$ACCESS_CONTROL = TRUE;

$postJSON = file_get_contents('php://input');
$post = json_decode($postJSON, TRUE);

require_once ('./connect.php');

$output = [
    'success' => false,
    'data' => [],
    'errors' => [],
];

switch($_GET['action']) {
  case 'post':
    switch($_GET['resource']) {
      case 'register': {
        if (!empty($post)) {
          require('./actions/register.php');
        }
      }
      case 'login': {
        if (!empty($post)) {
          require('./actions/login.php');
        }
      }
    }
  case 'get':
    switch($_GET['resource']) {
      case 'verify': {
        if (!empty($_GET['code'])) {
          require('./actions/verify_customer.php');
        }
      }
    }
}

if (!isset($_GET['code'])) {
  $json_output = json_encode($output);
  print($json_output);
}
