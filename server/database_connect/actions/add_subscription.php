<?php
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
$output['success'] = true;

// If you're using Composer, use Composer's autoload:

// Be sure to replace this with your actual test API key
// (switch to the live key later)
require_once('./stripe-php-6.19.1/init.php');

\Stripe\Stripe::setApiKey("sk_test_AJROI8uQWjtqax5K0wh2EnbI");

try
{
  $customer = \Stripe\Customer::create(array(
    'email' => $post['stripeEmail'],
    'source'  => $post['stripeToken'],
  ));

  $array_of_plans = array(
    '1000000' => 'prod_DiPLr0lNOAw1PU',
    '49000' => 'prod_DiPKcr7kTpNCMZ',
    '19900' => 'prod_DiPIPiTmwBqTUf',
    '9900' => 'prod_DiPFfklXrHy9v0',
  );



  $subscription = \Stripe\Subscription::create(array(
    'customer' => $customer->id,
    'items' => array(array('plan' => $array_of_plans[$_GET['target']])),
  ));

  $output['subscription_active'] = true;
}
catch(Exception $e)
{
  $output['errors'][] = $e->getMessage();
  $output['subscription_active'] = false;

}


// require_once('./stripe-php-6.19.1/init.php');
// \Stripe\Stripe::setApiKey("sk_test_4eC39HqLyjWDarjtT1zdp7dc");
//
// $charge = \Stripe\Charge::create([
//     'amount' => 999,
//     'currency' => 'usd',
//     'source' => 'tok_visa',
//     'receipt_email' => 'shoblik@yahoo.com',
// ]);
//
// $output['charge'] = $charge;

 ?>
