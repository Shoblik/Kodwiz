let activeNum = null;

function checkSession() {
  axios({
    method: 'get',
    url: 'http://localhost/server/database_connect/server.php?action=get&resource=readSession&customerInfo=true',
  }).then(function(response) {
    console.log(response);
    if (!response.data.authorized) {
      window.open("http://localhost/login", target = "_self");
    }
  });
}
function launchApplication() {
  axios({
    method: 'get',
    url: 'http://localhost/server/database_connect/server.php?action=get&resource=launchApplication',
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
      url: 'http://localhost/server/database_connect/server.php?action=post&resource=add_subscription&target=' + activeNum,
      data: {
        stripeEmail: token.email,
        stripeToken: token.id
      }
    }).then(function(response) {
      console.log(response);
    })
  }
});
