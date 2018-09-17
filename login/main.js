function register() {
  let errors = {};

  //check to make sure there is a value for all of these
  let first_name = document.querySelector('#first_name').value;
  let last_name = document.querySelector('#last_name').value;
  let bussiness = document.querySelector('#bussiness').value;
  let email = document.querySelector('#email').value;
  let phone = document.querySelector('#phone').value;
  let pin = document.querySelector('#pin').value;

  if (!first_name) {
    errors['first_name_error'] = 'Please enter a first name';
  }
  if (!last_name) {
    errors['last_name_error'] = 'Please enter a last name';
  }
  if (!bussiness) {
    errors['bussiness_error'] = 'Please enter a bussiness name';
  }
  if (!email) {
    errors['email_error'] = 'Please enter a valid email address';
  }
  if (!phone) {
    errors['phone_error'] = 'Please enter a valid phone number';
  }
  if (!pin) {
    errors['pin_error'] = 'Please enter a pin';
  }
  if (pin !== document.querySelector('#confirmPin').value) {
    errors['pin_error'] = 'Please enter pins that match';
  }
  if (pin.length !== 6) {
    errors['pin_error'] = 'Please enter a 6 digit pin';
  }

  if (Object.keys(errors).length === 0 && errors.constructor === Object) {
    axios({
      method: 'post',
      url: 'https://kodwiz.com/server/database_connect/server.php?action=post&resource=register',
      data: {
        first_name: first_name,
        last_name: last_name,
        bussiness: bussiness,
        email: email,
        phone: phone,
        pin: pin,
      }
    }).then(function(response) {
      console.log(response);
      if (response.data.customer_verification_added) {
        document.querySelector('#response').innerText = 'Thank you for registering, please check your email for an account confirmation link';
      }
    });
  } else {
    handleErrors(errors);
  }
}
function login() {
  axios({
    method: 'post',
    url: 'https://kodwiz.com/server/database_connect/server.php?action=post&resource=login',
    data: {
      email: document.getElementById('emailLogin').value,
      pin: document.getElementById('pinLogin').value
    }
  }).then(function(response) {
    console.log(response);
    if (response.data.success) {
      window.open(response.data.url, target="_self");
    } else {
      document.getElementById('loginResponse').innerText = "Incorrect username or password";
      document.getElementById('emailLogin').style.border = "1px solid #B23B3A";
      document.getElementById('pinLogin').style.border = "1px solid #B23B3A";
    }
  });
}
function handleErrors(errors) {
  for (i in errors) {
    document.querySelector('#' + i).innerText = errors[i];
  }
}
