<?php
$ACCESS_CONTROL = true;
$getCustomerInfo = true;
$serverRequest = true;
require_once('../server/database_connect/connect.php');
require_once('../server/database_connect/actions/read_session.php');
require_once('../server/database_connect/environment.php');

if ($output['authorized'] !== true) header("Location: ../login");

require_once('../server/database_connect/actions/launch_application.php');


$query = 'SELECT * FROM subscription_details';
$result = mysqli_query($conn, $query);
$plans = mysqli_fetch_all($result,MYSQLI_ASSOC);

function formatPrice($price) {

    $arr = str_split($price);

    array_splice($arr, -2, 2);

    $result = implode($arr);

    if (strlen($result)) {
        return '$' . $result;
    } else {
        return '$0';
    }

}

?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" sizes="500x500" href="../images/kod_wiz_logo_org.png">
    <title>KodWiz Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.5/bluebird.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel='stylesheet' href='./style2.css' />
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src='./main.js'></script>
</head>
<body>
    <?php require('../header/header.php'); ?>
    <div class='innerModalContainer account'>
        <div class='removeContainer'>
            <img class='removeBtn' src='../images/remove.png' />
        </div>
        <h3 class='updateTitle'>Update Account Details</h3>
        <div class='accountContainer'>
            <div class='updateBilling'>
                <p>Last four digits of current card: <span id='cardNums'></span></p>
                <button class=''>Change billing method</button>
            </div>
            <div class='cancelSub'>
                <p onclick='cancelSubscription();'>Cancel subscription</p>
            </div>
        </div>
    </div>
    <div class='modal'>
        <div class='innerModalContainer update'>
            <div onclick="closeModal();" class='removeContainer'>
                <img class='removeBtn' src='../images/remove.png' />
            </div>
            <h3 class='updateTitle'>Change plan subscription to <span id='planName'>Diamond</span></h3>
            <div class='planDetails'>
                <div class='monthlyCharge'>
                    <p class='green-text'>Monthly price of <span id='monthlyCharge'>$499.00</span></p>
                </div>
                <div class='programsIncluded'>
                    <p class='green-text'><span id='freeProgramsOnModal'>50</span> free programs per month</p>
                </div>
                <div class='feePerProgram'>
                    <p class='green-text'><span id='additionalPrice'>$10.00</span> per additional program</p>
                </div>
                <div class='updateDisclaimer'>
                    <p><span>Disclaimer</span>: You will be charged today for programs generated in excess of your previous plan's progam per month limit and receive a prorated charge at the beginning of your next billing cycle.</p>
                </div>
                <div class='btnContainer'>
                    <img id='updatePlanSpinner' src='../images/spinner.gif' />
                    <button class='updateSubscription'>Update Subscription</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="stripeKey" value="<?php echo STRIPE_PUBLIC_KEY; ?>" >
    <?php if (isset($output['demo'])  && $output['demo']) { ?>
        <input type="hidden" id="plan" value="Demo" />
    <?php } else { ?>
        <input type="hidden" id="plan" value="<?php echo $output['planName']; ?>" />
    <?php } ?>
    <div class="spacer">
<!--        <img src="../images/kod_wiz_logo.png" />-->
        <h1>Welcome <?php echo $output['firstName']; ?></h1>
        <button onclick="window.open('<?php echo $output['url']; ?>')" class="launch">Launch Application</button>
    </div>
    <div class="main-container">
        <div class="main-head">
            <h1><?php echo $output['planName']; ?> Plan Dashboard</h1>
            <a href="#plans">
                <h3 class="changePlan">Change my plan</h3>
            </a>

            <div class="details">
                <div>
                    <h3><?php echo $output['programs_left']; ?></h3>
                    <h3>Free programs remaining</h3>
                </div>
                <div>
                    <h3><?php echo $output['programs_billed']; ?></h3>
                    <h3>Programs billed this month</h3>
                </div>
            </div>
        </div>
        <div id="plans" class="plans">
            <h1>KodWiz Plans</h1>
            <div class="planContainer">
            <?php foreach ($plans as $plan) {
                $currentPlan = ($plan['subscription_name'] === $output['planName']) ? true : false;

                ?>
                <?php if (!$currentPlan) { ?>
                <div onclick='addCustomerToSubscription(<?php echo $plan['monthly_fee'] !== '0' ? $plan['monthly_fee'] : '0, "Save Payment Details"' ?>)' class="individualPlan">
                <?php } else { ?>
                    <div class="individualPlan currentPlan">
                    <?php } ?>
                    <h3><?php echo $plan['subscription_name']; ?></h3>
                    <h3>
                        <?php
                            if ($plan['programs_per_month'] == 0 && $plan['subscription_id'] == 1000000) {
                                echo '<span class="redify">Unlimited Program Generation</span>';
                            } else {
                                echo '<span class="redify"> ' . $plan['programs_per_month'] . ' free programs</span> per month';
                            }
                        ?>
                    </h3>
                    <?php
                    if ($plan['programs_per_month'] == 0 && $plan['subscription_id'] == 1000000) {?>
                        <h3>Then $0 / Program</h3>
                    <?php } else {?>
                        <h3>Then <?php echo formatPrice($plan['per_program_fee']); ?> / Program</h3>
                    <?php } ?>
                    <h3 class="pricePerMonth">
                        <?php echo formatPrice($plan['monthly_fee']); ?>
                        <span class="perMonth">/month</span>
                    </h3>
                    <?php if ($currentPlan) {?>
                        <div class="overlay">
                            <h3>Current</h3>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>