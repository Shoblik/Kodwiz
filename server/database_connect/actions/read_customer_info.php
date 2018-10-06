<?php

if (!isset($ACCESS_CONTROL) || $ACCESS_CONTROL === false) {
  die('no direct access allowed');
}
$id = $auth->id;


$query = "SELECT * FROM `customer` c
          LEFT JOIN `customer_billing` cb
          ON (c.id = cb.customer_id)
          LEFT JOIN `subscription_details` sd
          ON (cb.subscription_id = sd.subscription_id)
          WHERE c.id = '{$id}'";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_affected_rows($conn) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $output['fullName'] = $row['name'];
          $output['firstName'] = explode(' ', $row['name'])[0];
          if ($row['activeSubscription']) {
            $output['demo'] = false;
            $output['planName'] = $row['subscription_name'];
            if ($row['programs_per_month'] == 0) {
              $output['programs_left'] = 'Unlimited';
              $output['programs_billed'] = 0;
              $output['program_bill_rate'] = '$0.00';
            } else {
              $programsLeft = $row['programs_per_month'] - $row['billing_cycle_program_count'];
              $programBillRate = $row['per_program_fee'];
              $output['program_bill_rate'] = '$' . $programBillRate[0] . $programBillRate[1] . '.' . $programBillRate[2] . $programBillRate[3];
              if ($programsLeft < 0) {
                $output['programs_left'] = 0;
                $output['programs_billed'] = $programsLeft * -1;
              } else {
                $output['programs_left'] = $programsLeft;
                $output['programs_billed'] = 0;
              }
            }
          } else {
            //Demo account
            $output['demo'] = true;
            $output['planName'] = 'Demo';
            $output['programs_left'] = 5;
            $output['programs_billed'] = 'n/a';
            $output['program_bill_rate'] = 'n/a';
          }
        }
      } else {
        $output['errors'][] = 'No results from id';
    }
  } else {
    $output['errors'][] = 'Problem is sql statement';
}
