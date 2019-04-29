<?php
if (!isset($ACCESS_CONTROL) || $ACCESS_CONTROL === false) {
  die('No direct access allowed');
}

require_once('./stripe-php-6.19.1/init.php');
require_once('./environment.php');

\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

$output['success'] = true;

require('./actions/read_session.php');
$id = $output['id'];

if (DEV) {
    $array_of_plans = array(
        '1000000' => 'plan_DjVMQpwWm9SCsk',
        '49900' => 'prod_DiPKcr7kTpNCMZ',
        '19900' => 'prod_DiPIPiTmwBqTUf',
        '9900' => 'prod_DiPFfklXrHy9v0',
        '0' => 'plan_EyH6St1NjCIUFM'
    );
} else {
    //Production Version
    $array_of_plans = array(
        '1000000' => 'plan_DiPME224KjlQjf',
        '49900' => 'plan_DiPLwDoC5bTaIu',
        '19900' => 'plan_DiPJbY7mL8vXEv',
        '9900' => 'plan_DiPI2toee3aXq0',
        '0' => 'plan_EyK8cpD85WaPmp'
    );
}

$array_of_plan_names = array(
  '1000000' => 'Diamond',
  '49900' => 'Platinum',
  '19900' => 'Golden',
  '9900' => 'Silver',
  '0' => 'Basic'
);


//get customer_id
$query = "SELECT cb.billing_customer_id, sd.subscription_name FROM customer_billing cb
            LEFT JOIN subscription_details sd 
            ON sd.subscription_id = cb.subscription_id
            WHERE cb.customer_id = '{$id}'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$billing_customer_id = $row['billing_customer_id'];
$current_sub_name = $row['subscription_name'];

if ($billing_customer_id) {
  //get the subscription id
  $customer = \Stripe\Customer::retrieve($billing_customer_id);
  $output['customer'][] = $customer;

  if ($current_sub_name === 'Basic') {

      // cancel
      $subscription = \Stripe\Subscription::retrieve($customer['subscriptions']['data'][0]['id']);
      $newSub = $subscription->cancel();

      // create new subscription
      $newSub = \Stripe\Subscription::create(array(
          'customer' => $billing_customer_id,
          'items' => array(array('plan' => $array_of_plans[$_GET['target']])),
      ));

  } else if ($_GET['target'] == 0) {
      // update from a monthly subscription to a metered subscription
      \Stripe\Subscription::update(
          $customer['subscriptions']['data'][0]['id'],
          [
              'cancel_at_period_end' => true,
          ]
      );

      $newSub = \Stripe\Subscription::create(array(
          'customer' => $billing_customer_id,
          'items' => array(array('plan' => $array_of_plans[$_GET['target']])),
      ));

  } else {

      // monthly subscription plan update
      $subscription_id = $customer['subscriptions']['data'][0]['id'];

      $subscription = \Stripe\Subscription::retrieve($subscription_id);

      $newSub = \Stripe\Subscription::update($subscription_id, [
          'cancel_at_period_end' => false,
          'items' => [
              [
                  'id' => $subscription->items->data[0]->id,
                  'plan' => $array_of_plans[$_GET['target']],
              ],
          ],
      ]);
  }








//  if ($customer['subscriptions']['data'][0]['plan']['usage_type'] !== 'metered') {
//      // Basic user, upgrading to a monthly subscription plan.
//
//      $newSub = \Stripe\Subscription::create(array(
//          'customer' => $billing_customer_id,
//          'items' => array(array('plan' => $array_of_plans[$_GET['target']])),
//      ));
//
//  } else if ($_GET['target'] == 0 || $customer['subscriptions']['data'][0]['plan']['usage_type'] == 'metered') {
//      // Moving from a subscription plan to the basic plan
//
//      // cancel subscription, add to metered billing plan
//      \Stripe\Subscription::update(
//          $customer['subscriptions']['data'][0]['id'],
//          [
//              'cancel_at_period_end' => true,
//          ]
//      );
//
//      $newSub = \Stripe\Subscription::create(array(
//          'customer' => $billing_customer_id,
//          'items' => array(array('plan' => $array_of_plans[$_GET['target']])),
//      ));
//
//  } else {
//      $subscription_id = $customer['subscriptions']['data'][0]['id'];
//
//      //update the plan
//      $subscription = \Stripe\Subscription::retrieve($subscription_id);
//
//      $newSub = \Stripe\Subscription::update($subscription_id, [
//          'cancel_at_period_end' => false,
//          'items' => [
//              [
//                  'id' => $subscription->items->data[0]->id,
//                  'plan' => $array_of_plans[$_GET['target']],
//              ],
//          ],
//      ]);
//
//
//  }

  $output['subscription_success'] = true;

  $output['subscription'] = $newSub;


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
