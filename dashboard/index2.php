<?php
require_once('../server/database_connect/environment.php');

?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>KodWiz Dashboard</title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.5/bluebird.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel='stylesheet' href='./style.css' />
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src='./main.js'></script>
    <script>checkSession();</script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZNM6SHLE6Q"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ZNM6SHLE6Q');
</script>
</head>
    <body onload='init()' class="dashboardBody">
    <input type="hidden" id="stripeKey" value="<?php echo STRIPE_PUBLIC_KEY; ?>" >
      <div class='modal'>
        <div class='innerModalContainer update'>
          <div class='removeContainer'>
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
      <img id='spinner' src='../images/spinner.gif' />
      <nav>
        <div class='logo'>
          <img src='../images/kod_wiz_logo_org.png' />
        </div>
        <div class='navItemContainer'>
          <div class='navItem'>
            <p>Home</p>
          </div>
          <div onclick='getAccountDetails()' class='navItem'>
            <p>Account</p>
          </div>
          <div onclick='window.open("https://kodwiz.com/tutorials", target="_self")' class='navItem'>
            <p>Tutorials</p>
          </div>
          <div class='navItem'>
            <p>Contact</p>
          </div>
          <div onclick='launchApplication();' class='navItem'>
            <p class='launchHighlight'>Launch Application</p>
          </div>
        </div>
      </nav>
      <main>
        <div class='greeting'>
          <h3>Hello <span id='name'></span>, Welcome to your Dashboard</h3>
        </div>
        <div class='launchApplication'>
          <button onclick='launchApplication();' class='launchApplicationBtn'>Launch Applicaton</button>
        </div>
        <div class='accountIcon'>
          <div onclick='document.querySelector(".profilePopupContainer").classList.toggle("showProfile")' class='iconCircle'>
            <img src='../images/icon_user.png'/>
          </div>
          <div class='profilePopupContainer'>
            <div class='accountName'>
              <p id='profilefullName'></p>
            </div>
            <div class='profilePopup'>
              <div class='profileInfo'>
                <p class='profileLink'>Account</p>
              </div>
              <div class='profileLogout' onclick='logout();'>
                <p class='profileLink'>Logout</p>
              </div>
            </div>
          </div>
        </div>
        <div id='modifiable' class='modifiable'>
          <div class='planInformation'>
            <div class='currentPlan'>
              <div class='statusContainer'>
                <p>Your current plan:</p>
                <p class='statusValue' id='plan'></p>
              </div>
            </div>
            <div class='remainingFreePrograms'>
              <div class='statusContainer'>
                <p>Remaining free programs:</p>
                <p class='statusValue'><span id='freePrograms'></span></p>
              </div>
            </div>
            <div class='atCostPrograms'>
              <div class='statusContainer'>
                <p>Programs this cycle billed at <span id='pricePerProgram'></span></p>
                <p class='statusValue'><span id='atCostProgramCount'></span></p>
              </div>
            </div>
          </div>
          <div id='priceTable' class='priceStructure'>
            <div class='innerPriceContainer'>
              <h2 class='upgradeNowText'>Upgrade Your Account Today</h2>
              <div onclick='addCustomerToSubscription(0, "Save Payment Details");' class='individualOption basic'>
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
              </div>
              <div onclick='addCustomerToSubscription(19900);' class='individualOption gold'>
                <div>
                  <div class='user'>
                    <p>Gold</p>
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
              </div>
            </div>
          </div>
        </div>
      </main>
    </body>
  </html>
