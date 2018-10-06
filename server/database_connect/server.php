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
        $output['test'] = true;
        if (!empty($post)) {
          require('./actions/register.php');
          break;
        }
      }
      case 'login': {
        if (!empty($post)) {
          require('./actions/login.php');
          break;
        }
      }
      case 'passwordreset': {
        if (!empty($post)) {
          require('./actions/insert_password_code.php');
          break;
        }
      }
      case 'updatePassword': {
        if (!empty($post)) {
          require('./actions/reset_password.php');
          break;
        }
      }
      case 'add_subscription': {
        if (!empty($post)) {
          require('./actions/add_subscription.php');
          break;
        }
      }
    }
  case 'get':
    switch($_GET['resource']) {
      case 'verify': {
        if (!empty($_GET['code'])) {
          require('./actions/verify_customer.php');
          break;
        }
      }
      case 'test': {
        require('./actions/test.php');
        break;
      }
      case 'readSession': {
        require('./actions/read_session.php');
        break;
      }
      case 'launchApplication': {
        require('./actions/launch_application.php');
        break;
      }
    }
}

if (!isset($_GET['code'])) {
  $json_output = json_encode($output);
  print($json_output);
}
