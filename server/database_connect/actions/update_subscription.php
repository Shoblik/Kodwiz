<?php
if (!isset($ACCESS_CONTROL) || $ACCESS_CONTROL === false) {
  die('No direct access allowed');
}

require_once('./stripe-php-6.19.1/init.php');
require_once('./stripe_creds.php');

\Stripe\Stripe::setApiKey($secretKey);

$output['success'] = true;

require('./actions/read_session.php');
$id = $output['id'];

//Production Version
// $array_of_plans = array(
//   '1000000' => 'plan_DiPME224KjlQjf',
//   '49900' => 'plan_DiPLwDoC5bTaIu',
//   '19900' => 'plan_DiPJbY7mL8vXEv',
//   '9900' => 'plan_DiPI2toee3aXq0',
// );

//Test Version
$array_of_plans = array(
  '1000000' => 'plan_DjVMQpwWm9SCsk',
  '49900' => 'prod_DiPKcr7kTpNCMZ',
  '19900' => 'prod_DiPIPiTmwBqTUf',
  '9900' => 'prod_DiPFfklXrHy9v0',
);
$array_of_plan_names = array(
  '1000000' => 'Diamond',
  '49900' => 'Platinum',
  '19900' => 'Golden',
  '9900' => 'Silver',
);


//get customer_id
$query = "SELECT `billing_customer_id` FROM `customer_billing` WHERE `customer_id` = '{$id}'";
$result = mysqli_query($conn, $query);
$billing_customer_id = mysqli_fetch_assoc($result)['billing_customer_id'];


if ($billing_customer_id) {
  //get the subscription id
  $customer = \Stripe\Customer::retrieve($billing_customer_id);
  $output['customer'][] = $customer;

  $subscription_id = $customer['subscriptions']['data'][0]['id'];

  //update the plan
  $subscription = \Stripe\Subscription::retrieve($subscription_id);
  \Stripe\Subscription::update($subscription_id, [
    'cancel_at_period_end' => false,
    'items' => [
          [
              'id' => $subscription->items->data[0]->id,
              'plan' => $array_of_plans[$_GET['target']],
          ],
      ],
  ]);
  $output['subscription_updated'] = true;

  // Charge the customer for the generated programs under the previous plan and reset all other values
  $query = "SELECT * FROM `customer_billing` cb
            LEFT JOIN `subscription_details` sd
            ON (sd.subscription_id = cb.subscription_id)
            WHERE cb.customer_id = '{$id}'";

  $result = mysqli_query($conn, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $billing_cycle_program_count = $row['billing_cycle_program_count'];
    $programs_per_month_limit = $row['programs_per_month'];
    $per_program_fee = $row['per_program_fee'];

    $programs_at_cost = $billing_cycle_program_count - $programs_per_month_limit;

    if ($programs_at_cost > 0) {
      $cost = intval($per_program_fee) * intval($programs_at_cost);

      $charge = \Stripe\Charge::create([
        'amount' => intval($cost),
        'currency' => 'usd',
        'description' => 'Remaining generated programs at cost under the old subscription plan',
        'customer' => $billing_customer_id,
      ]);
      $output['charge'] = $charge;
    } else {
      $output['charge'] = 'No charge';
    }

    // Update customer billing table to reflect new subscription
    $query = "UPDATE `customer_billing` SET `subscription_id` = '{$_GET['target']}', `billing_cycle_program_count` = 0 WHERE `customer_id` = '{$id}'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
      $output['errors'][] = 'unable to update customer_billing';
    }
  } else {
    $output['errors'][] = 'no subscription details';
  }


} else {
  $output['errors'][] = 'No customer information';
}
