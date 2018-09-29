function moveLabel() {
  // event.target.nextElementSibling.classList.add('activateLabel');
}
function register() {
  let errors = {};

  //check to make sure there is a value for all of these
  let name = document.querySelector('#name').value;
  let bussiness = document.querySelector('#bussiness').value;
  let email = document.querySelector('#email').value;
  let phone = document.querySelector('#phone').value;
  let password = document.querySelector('#pin').value;

  if (!name) {
    errors['first_name_error'] = 'Name can\'t be blank';
  }
  if (!email) {
    errors['email_error'] = 'Email can\t be blank';
  }
  if (!phone) {
    errors['phone_error'] = 'Phone can\'t be blank';
  }
  if (!pin) {
    errors['pin_error'] = 'Password can\'t be blank';
  }

  if (Object.keys(errors).length === 0 && errors.constructor === Object) {
    axios({
      method: 'post',
      url: 'https://kodwiz.com/server/database_connect/server.php?action=post&resource=register',
      data: {
        name: name,
        bussiness: bussiness,
        email: email,
        phone: phone,
        password: password,
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
      password: document.getElementById('pinLogin').value
    }
  }).then(function(response) {
    console.log(response.data);
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
function showSignUp() {
  document.querySelector('#login').style.display = 'none';
  document.querySelector('.register').style.display = 'block';
}
function showLogIn() {
  document.querySelector('#login').style.display = 'block';
  document.querySelector('.register').style.display = 'none';
}
function init() {
  // setInterval(function() {
    // let email = document.querySelector('#emailLogin');
    // let password = document.querySelector('#pinLogin');
    // console.log(email.value, password.value);
    // if (email.value !== '') {
    //   email.nextElementSibling.classList.add('activateLabel');
    // }
    // if (password.value !== '') {
    //   password.nextElementSibling.classList.add('activateLabel');
    // }
    document.querySelector('body').click();
  // }, 100);
}
