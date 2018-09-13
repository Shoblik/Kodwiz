<?php
$output['active'] = false;
// flip active
$query = "SELECT `customer_id` FROM `verify_customer` WHERE `confirmation_code` = '{$_GET['code']}'";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $customer_id = $row['customer_id'];
        }
    } else {$output['errors'][] = 'no data found';}
} else {$output['errors'][] = 'error in SQL query';}

$output['customer_id'] = $customer_id;

if ($customer_id) {
  // update active status in customer table to 1
  $query = 'UPDATE `customer`
            SET `active` = 1
            WHERE `id` = 31';
  $result = mysqli_query($conn, $query);
  $output['active'] = $result;
}
// print('<style>* {padding: 0; margin: 0;}body {text-align: center; font-family: "Lato", sans-serif;} h2 {padding: 30px 0; font-weight: 100;} button:hover {background-color: #B23B3A !important; color: white; border-color: transparent;} button {transition: .3s; padding: 10px 15px; background-color: white; border: 2px solid #B23B3A; font-size: 1.2rem; color: #B23B3A; border-radius: 5px; font-family: "Lato", sans-serif;} img {width: 15%;}</style><div style="text-align: center; padding: 25px; background-color: rgba(250,250,250, 1);"><img src="../../images/kod_wiz_logo_org.png"/></div><content><h2>Thank you for verifying your account, your account has been activated.</h2><button onclick="https://kodwiz.com">Login</button></content>');
//
$json_output = json_encode($output);
print($json_output);
?>
