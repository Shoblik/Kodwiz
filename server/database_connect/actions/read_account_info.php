<?php

if (!isset($ACCESS_CONTROL) || $ACCESS_CONTROL === false) {
  die('no direct access allowed');
}

require_once('./stripe-php-6.19.1/init.php');

\Stripe\Stripe::setApiKey("sk_test_AJROI8uQWjtqax5K0wh2EnbI");

$output['success'] = true;

require('./actions/read_session.php');

if (!isset($auth)) {
  require('./actions/read_session.php');
};

$id = $auth->id;


$query = "SELECT * FROM `customer` c
          LEFT JOIN `customer_billing` cb
          ON (c.id = cb.customer_id)
          LEFT JOIN `subscription_details` sd
          ON (cb.subscription_id = sd.subscription_id)
          WHERE c.id = '{$id}'";
$result = mysqli_query($conn, $query);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $output['data'] = $row;

  //get last 4 digits of customers card
  $customer = \Stripe\Customer::retrieve($row['billing_customer_id']);
  $output['last4'] = $customer['sources']['data'][0]['last4'];

}
