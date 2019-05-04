var activeNum = null;


var handler = null;

function init() {
  var ele = document.querySelectorAll('.removeContainer');
  for (var i=0; i < ele.length; i++) {
    ele[i].addEventListener('click', function() {
      console.log('click');
      document.querySelector('.modal').classList.remove('showModal');
    });
  }
}
function checkSession() {
  axios({
    method: 'get',
    url: '../server/database_connect/server.php?action=get&resource=readSession&customerInfo=true',
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

      // if (!response.data.demo) {
      //   document.getElementById('priceTable').style.display = 'none';
      // }
      document.getElementById('spinner').style.display = 'none';
      document.querySelector('nav').style.display = 'inline-block';
      document.querySelector('main').style.display = 'inline-block';
    }
  });
}
function logout() {
  axios({
    method: 'post',
    url: '../server/database_connect/server.php?action=post&resource=logout',
    data: {
      'auth': false,
      'logout': true,
    }
  }).then(function(response) {
    console.log(response);
  });
  window.open("https://kodwiz.com/login", target='_self');
}
function launchApplication() {
  axios({
    method: 'get',
    url: '../server/database_connect/server.php?action=get&resource=launchApplication',
  }).then(function(response) {
    console.log(response);
    if (response.data.url) {
      window.open(response.data.url, target="_self");
    } else {
      window.open("https://kodwiz.com/login");
    }
  });
}
function addCustomerToSubscription(price, label) {
  if (label === undefined) {
    label = null;
  }

  activeNum = price;

  // New Subscription
  if (document.querySelector('#plan').innerText === 'Demo') {
    // Open Checkout with further options:
    handler = StripeCheckout.configure({
        key: document.getElementById('stripeKey').value,
        image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
        locale: 'auto',
        token: function(token) {
            axios({
                method: 'post',
                url: "../server/database_connect/server.php?action=post&resource=add_subscription&target=" + activeNum,
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
    handler.open({
      name: 'Kodwiz',
      // description: 'Monthly charge',
      amount: price,
      panelLabel: label
    });
  } else {
     openSubscriptionModal(activeNum);
  }
}
function openSubscriptionModal(activeNum) {
  document.querySelector('.innerModalContainer.account').style.display = 'none';
  document.querySelector('.innerModalContainer.update').style.display = 'block';
  var planObj = {
    '0' : {
      'planName': 'Basic',
      'monthlyCharge': '$0.00',
      'freeProgramsOnModal': '0',
      'additionalPrice': '$20.00',
    },
    '9900' : {
      'planName': 'Silver',
      'monthlyCharge': '$99.00',
      'freeProgramsOnModal': '10',
      'additionalPrice': '$15.00',
    },
    '19900' : {
      'planName': 'Gold',
      'monthlyCharge': '$199.00',
      'freeProgramsOnModal': '30',
      'additionalPrice': '$15.00',
    },
    '49900' : {
      'planName': 'Platinum',
      'monthlyCharge': '$499.00',
      'freeProgramsOnModal': '50',
      'additionalPrice': '$10.00',
    },
    '1000000' : {
      'planName': 'Diamond',
      'monthlyCharge': '$10,000.00',
      'freeProgramsOnModal': 'Unlimited',
      'additionalPrice': '$0.00',
    }
  }

  if (document.querySelector('#plan').innerText === planObj[activeNum]['planName']) {
    return;
  }

  for (i in planObj[activeNum]) {
    document.querySelector('#' + i).innerText = planObj[activeNum][i];
  }

  document.querySelector('.updateSubscription').setAttribute('onclick', 'updateSubscription('+activeNum+')')
  document.querySelector('.modal').classList.add('showModal');

}
function updateSubscription(activeNum) {
  document.querySelector('.updateSubscription').classList.add('updateSubscriptionLoading');
  document.querySelector('#updatePlanSpinner').classList.add('showUpdatePlanSpinner');

  // update subscription
  axios({
    method: 'get',
    url: "../server/database_connect/server.php?action=get&resource=update_subscription&target=" + activeNum,
  }).then(function(response) {
    console.log(response);
    if (response.data.subscription_success) {
      location.reload();
    }
  })
}
// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
  handler.close();
});

function getAccountDetails() {
  //close inner modal
  document.querySelector('.innerModalContainer.update').style.display = 'none';
  document.querySelector('.innerModalContainer.account').style.display = 'block';

  //gather account info
  axios({
    method: 'get',
    url: "../server/database_connect/server.php?action=get&resource=getCustomerInfo",
  }).then(function(response) {
    console.log(response);
    document.querySelector('#cardNums').innerText = response.data.last4;
    document.querySelector('.modal').classList.add('showModal');
  });
}
