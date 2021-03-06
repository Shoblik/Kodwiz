<?php
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
$output['success'] = true;

//customer billing get customer ID
require('./actions/read_session.php');

// If you're using Composer, use Composer's autoload:


// Be sure to replace this with your actual test API key
// (switch to the live key later)
require_once('./stripe-php-6.19.1/init.php');
require_once('./environment.php');

\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

try
{
  $customer = \Stripe\Customer::create(array(
    'email' => $post['stripeEmail'],
    'source'  => $post['stripeToken'],
  ));

  $output['customer'] = $customer;

  if (DEV) {
       $array_of_plans = array(
         '1000000' => 'plan_DjVMQpwWm9SCsk',
         '49900' => 'prod_DiPKcr7kTpNCMZ',
         '19900' => 'prod_DiPIPiTmwBqTUf',
         '9900' => 'prod_DiPFfklXrHy9v0',
         '0'    => 'plan_EyH6St1NjCIUFM'
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

  // if its a subscription add them to the subscription
  if ($_GET['target'] != 0) {
    $subscription = \Stripe\Subscription::create(array(
      'customer' => $customer->id,
      'items' => array(array('plan' => $array_of_plans[$_GET['target']])),
    ));
  }

  //store relevant info in our db

  if ($output['authorized']) {
    $id = $output['id'];
    $billing_token = $customer['id'];
    $billing_email = $post['stripeEmail'];
    $sub_id = $_GET['target'];
    $programCount = 0;

    $query = "INSERT INTO `customer_billing` (`customer_id`, `billing_customer_id`, `billing_email`, `subscription_id`, `billing_cycle_program_count`, `date`) VALUES ('{$id}', '{$billing_token}', '{$billing_email}', '{$sub_id}', '{$programCount}', CURRENT_DATE)";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $query = "UPDATE `customer` SET `activeSubscription` = 1 WHERE `id` = '{$id}'";
      $result = mysqli_query($conn, $query);

      if (!$result) {
        $output['errors'] = 'Failed to update customer table';
      }
    } else {
      $output['errors'] = 'Failed to add customer to customer_billing';
    }


  } else {
    $output['errors'][] = 'not authorized';
  }

  $output['subscription_active'] = true;
}
catch(Exception $e)
{
  $output['errors'][] = $e->getMessage();
  $output['subscription_active'] = false;

}


 ?>
