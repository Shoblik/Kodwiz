let activeNum = null;

function checkSession() {
  axios({
    method: 'get',
    url: 'https://kodwiz.com/server/database_connect/server.php?action=get&resource=readSession&customerInfo=true',
  }).then(function(response) {
    console.log(response);
    if (!response.data.authorized) {
      window.open("https://kodwiz.com/login", target = "_self");
    } else {
      // Put dynamic content here
      document.getElementById('name').innerText = response.data.firstName;
      document.getElementById('profilefullName').innerText = response.data.fullName;
      document.getElementById('plan').innerText = response.data.planName;
      document.getElementById('freePrograms').innerText = response.data.programs_left;
      document.getElementById('pricePerProgram').innerText = response.data.program_bill_rate;
      document.getElementById('pricePerProgram').innerText = response.data.program_bill_rate;
      document.getElementById('atCostProgramCount').innerText = response.data.programs_billed;

      if (!response.data.demo) {
        document.getElementById('priceTable').style.display = 'none';
      }
      document.getElementById('spinner').style.display = 'none';
      document.querySelector('nav').style.display = 'inline-block';
      document.querySelector('main').style.display = 'inline-block';
    }
  });
}
function launchApplication() {
  axios({
    method: 'get',
    url: 'https://kodwiz.com/server/database_connect/server.php?action=get&resource=launchApplication',
  }).then(function(response) {
    console.log(response);
    if (response.data.url) {
      window.open(response.data.url, target="_self");
    } else {
      window.open("https://kodwiz.com/login");
    }
  });
}
function addCustomerToSubscription(price) {
  activeNum = price;
  // Open Checkout with further options:
  handler.open({
    name: 'Kodwiz',
    // description: 'Monthly charge',
    amount: price
  });
}

// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
  handler.close();
});

var handler = StripeCheckout.configure({
  key: 'pk_test_hJDzvApd3S2zpLvqgOJHwISa',
  image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
  locale: 'auto',
  token: function(token) {
    console.log(token);
    axios({
      method: 'post',
      url: 'https://kodwiz.com/server/database_connect/server.php?action=post&resource=add_subscription&target=' + activeNum,
      data: {
        stripeEmail: token.email,
        stripeToken: token.id
      }
    }).then(function(response) {
      console.log(response);
      if (response.data.subscription_active) {
        location.reload();
      }
    })
  }
});
