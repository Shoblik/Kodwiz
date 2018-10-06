<?php
session_start();

if (!isset($ACCESS_CONTROL) || $ACCESS_CONTROL === false) {
  die('no direct access allowed');
}

$auth = json_decode($_SESSION['kodWizAuth']);
$output['authorized'] = $auth->auth;
$output['id'] = $auth->id;
$output['success'] = true;

if (isset($_GET['customerInfo'])) {
  require('./actions/read_customer_info.php');

  $output['html'] = "<div class='planInformation'>
    <div class='currentPlan'>
      <div class='statusContainer'>
        <p>Your current plan:</p>
        <p class='statusValue' id='plan'>DEMO</p>
      </div>
    </div>
    <div class='remainingFreePrograms'>
      <div class='statusContainer'>
        <p>Remaining free programs:</p>
        <p class='statusValue'><span id='freePrograms'>5</span></p>
      </div>
    </div>
    <div class='atCostPrograms'>
      <div class='statusContainer'>
        <p>Programs this cycle billed at <span id='pricePerProgram'>$15.00</span></p>
        <p class='statusValue'><span id='atCostProgramCount'>0</span></p>
      </div>
    </div>
  </div>
  <div class='priceStructure'>
    <div class='innerPriceContainer'>
      <h2 class='upgradeNowText'>Upgrade Your Account Today</h2>
      <div onclick='addCustomerToSubscription(0);' class='individualOption basic'>
        <div>
          <div class='user'>
            <p>Basic</p>
          </div>
          <div class='feePer'>
            <div>
              <p class='text-highlight'>Fee / per Program:</p>
            </div>
            <p>$20 / per program</p>
          </div>
          <div class='monthFee'>
            <div>
              <p class='text-highlight'>Montly Fee:</p>
            </div>
            <p>$0</p>
          </div>
          <div class='notes'>
            <div>
              <p class='text-highlight'>Package Details:</p>
            </div>
            <p></p>
          </div>
        </div>
      </div>
      <div onclick='addCustomerToSubscription(9900);' class='individualOption silver'>
        <div>
          <div class='user'>
            <p>Silver</p>
          </div>
          <div class='feePer'>
            <div>
              <p class='text-highlight'>Fee / per Program:</p>
            </div>
            <p>$15 / per program</p>
          </div>
          <div class='monthFee'>
            <div>
              <p class='text-highlight'>Montly Fee:</p>
            </div>
            <p>$99</p>
          </div>
          <div class='notes'>
            <div>
              <p class='text-highlight'>Package Details:</p>
            </div>
            <p>10 programs/month generation included.</p>
          </div>
        </div>
        <!-- <button class='selectBtn'>Select</button> -->
      </div>
      <div onclick='addCustomerToSubscription(19900);' class='individualOption gold'>
        <div>
          <div class='user'>
            <p>Golden</p>
          </div>
          <div class='feePer'>
            <div>
              <p class='text-highlight'>Fee / per Program:</p>
            </div>
            <p>$15 / per program</p>
          </div>
          <div class='monthFee'>
            <div>
              <p class='text-highlight'>Monthly Fee:</p>
            </div>
            <p>$199</p>
          </div>
          <div class='notes'>
            <div>
              <p class='text-highlight'>Package Details:</p>
            </div>
            <p>30 program/month included in monthly fees.</p>
          </div>
        </div>
        <!-- <button class='selectBtn'>Select</button> -->
      </div>
      <div onclick='addCustomerToSubscription(49900);' class='individualOption platinum'>
        <div>
          <div class='user'>
            <p>Platinum</p>
          </div>
          <div class='feePer'>
            <div>
              <p class='text-highlight'>Fee / per Program:</p>
            </div>
            <p>$10 / per program</p>
          </div>
          <div class='monthFee'>
            <div>
              <p class='text-highlight'>Monthly Fee:</p>
            </div>
            <p>$499</p>
          </div>
          <div class='notes'>
            <div>
              <p class='text-highlight'>Package Details:</p>
            </div>
            <p>50 programs/month included in monthly fees.</p>
          </div>
        </div>
        <!-- <button class='selectBtn'>Select</button> -->
      </div>
      <div onclick='addCustomerToSubscription(1000000);' class='individualOption diamond'>
        <div>
          <div class='user'>
            <p>Diamond</p>
          </div>
          <div class='feePer'>
            <div>
              <p class='text-highlight'>Fee / per Program:</p>
            </div>
            <p>N/A</p>
          </div>
          <div class='monthFee'>
            <div>
              <p class='text-highlight'>Monthly Fee:</p>
            </div>
            <p>$10000</p>
          </div>
          <div class='notes'>
            <div>
              <p class='text-highlight'>Package Details:</p>
            </div>
            <p>Unlimited program generation.</p>
          </div>
        </div>
        <!-- <button class='selectBtn'>Select</button> -->
      </div>
    </div>
  </div>"
}

 ?>
