<?php
session_start();

if (!isset($ACCESS_CONTROL) || $ACCESS_CONTROL === false) {
    die('no direct access allowed');
}

$auth = json_decode($_SESSION['kodWizAuth']);
$output['authorized'] = $auth->auth;
$output['id'] = $auth->id;
$output['success'] = true;

if ($output['authorized'] && isset($_GET['customerInfo']) || $output['authorized'] && isset($getCustomerInfo)) {
    if (isset($serverRequest)) {
        require('../server/database_connect/actions/read_customer_info.php');
    } else {
        require('./actions/read_customer_info.php');
    }
}

 ?>
