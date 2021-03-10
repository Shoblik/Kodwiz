<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="shortcut icon" sizes="300x300" href="../images/kod_wiz_logo_org.png">
    <title>KodWiz Login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.5/bluebird.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel='stylesheet' href='./style.css' />
    <script src='./main.js'></script>
  </head>
  <body>
    <?php
        require('../header/header.php');
    ?>
    <content>
      <div class='left-col'>
        <div>
          <p id='response'></p>
        </div>
      </div>
      <div class='right-col'>
        <div id='login' class='loginInner'>
          <h2 class='loginTitle'>Log into your account</h2>
          <div class='login' style='height: initial;'>
            <div class='form'>
              <div class='progressBar'></div>
              <div class='outerInputContainer'>
                <div class='inputContainer'>
                  <input onfocus='moveLabel();' class='formInput' id='emailLogin' type='text' placeholder=''/>
                  <label class='activeLabel activateLabel'>Your e-mail address</label>
                </div>
                <div class='inputContainer'>
                  <input onfocus='moveLabel();' class='formInput' id='pinLogin' type='password' placeholder=''/>
                  <label class='activeLabel activateLabel'>Password</label>
                </div>
              </div>
              <p id='loginResponse'></p>
              <button onclick='login();' class='loginBtn'>Log in</button>
            </div>
            <div class='otherLinks'>
              <p onclick='showSignUp();'>Sign up</p>
              <p onclick='showForgotPassword();'>Forgot your password?</p>
            </div>
          </div>
        </div>

        <div class='loginInner register'>
          <h2 class='signUpTitle'>Get started with a free account</h2>
          <h3 class='registerLine'>No credit card needed.</h3>
          <div class='login' style='height: initial;'>
            <div class='errorContainer'></div>
            <div class='form'>
              <div class='passwordResetFeedback'>
                <p class='resetText'>Success! We've sent a link to reset your password to your inbox.</p>
              </div>
              <div class='progressBar'></div>
              <div class='outerInputContainer reg'>
                <div class='inputContainer'>
                  <input onfocus='moveLabel()' id='name' type='text'/>
                  <label class='activeLabel activateLabel'>What's your name?</label>
                </div>
                <div class='inputContainer'>
                  <input onfocus='moveLabel()' id='email' type='text'/>
                  <label class='activeLabel activateLabel'>Your email-address</label>
                </div>
                <div class='inputContainer'>
                  <input onfocus='moveLabel()' id='bussiness' type='text'/>
                  <label class='activeLabel activateLabel'>Your bussiness (optional)</label>
                </div>
                <div>
                  <input onfocus='moveLabel()' id='phone' type='text'/>
                  <label class='activeLabel activateLabel'>Your phone number (optional)</label>
                </div>
                <div class='inputContainer'>
                  <input onfocus='moveLabel()' id='pin' type='password'/>
                  <label class='activeLabel activateLabel'>Secure password</label>
                </div>
                <!-- <div>
                  <p id='response'></p>
                </div> -->
                <button onClick='register();' class='signUpBtn'>Sign Up</button>
              </div>
              <div class='otherLinks reg'>
                <p onclick='showLogIn();'>Log In</p>
              </div>
            </div>
          </div>
        </div>
        <div id='login' class='loginInner forgotPassword'>
          <h2 class='loginTitle'>Please enter your e-mail address.</h2>
          <div id='resetSuccess' class="loginTitle" style="display: none">
            <h2 class="resetText">Success!</h2>
            <br/>
            <h2 class="resetText">Check your inbox and spam folder for a reset link.</h2>
          </div>
          <div class='login' style='height: initial;'>
            <div class='form'>
              <div class='progressBar'></div>
              <div class='outerInputContainer'>
                <div class='inputContainer'>
                  <input onfocus='moveLabel();' class='formInput' id='emailReset' type='text' placeholder=''/>
                  <label class='activeLabel activateLabel'>Your e-mail address</label>
                </div>
              </div>
              <button onclick='resetPassword();'>Send</button>
              <div class='otherLinks'>
                <p onclick='showSignUp();'>Sign up</p>
                <p onclick='showLogIn();'>Log in</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </content>
    <div class='feedbackContainer'>
      <div class='feedbackInner'>
        <p class='feedbackText'></p>
      </div>
    </div>
    <script src="https://checkout.stripe.com/checkout.js"></script>

    <script>
    var handler = StripeCheckout.configure({
      key: 'pk_live_j5ScqAWuWDteX79DVwCa5zvg',
      image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
      locale: 'auto',
      token: function(token) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
        console.log(token);
        axios({
          method: 'post',
          url: '../server/database_connect/server.php?action=post&resource=add_subscription&target=' + target,
          data: {
            stripeEmail: token.email,
            stripeToken: token.id
          }
        })
      }
    });
    // Open Checkout with further options:

    // Close Checkout on page navigation:
    window.addEventListener('popstate', function() {
      handler.close();
    });
    </script>
  </body>
</html>
