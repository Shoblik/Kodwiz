let timeout = null;
function moveLabel() {
  // event.target.nextElementSibling.classList.add('activateLabel');
}
function register() {
  let activeErrors = document.getElementsByClassName('individualError');

  while(activeErrors[0]) {
    activeErrors[0].remove();
  }

  let errors = [];

  //check to make sure there is a value for all of these
  let name = document.querySelector('#name').value;
  let bussiness = document.querySelector('#bussiness').value;
  let email = document.querySelector('#email').value;
  let phone = document.querySelector('#phone').value;
  let password = document.querySelector('#pin').value;

  if (!name) {
    errors.push('Name can\'t be blank');
  }
  if (!email) {
    errors.push('Email can\'t be blank');
  }
  if (!password) {
    errors.push('Password can\'t be blank');
  }
  if (errors.length === 0) {
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
      console.log(response.data);

      if (response.data.emailSent) {
          let column = document.querySelector('.left-col');
          let signUpBtn = document.querySelector('.signUpBtn');
          column.style.transition = '1s';
          column.style.backgroundColor = '#5cb85c';

          signUpBtn.style.backgroundColor = '#5cb85c';
          signUpBtn.style.backgroundColor = '#5cb85c';

          document.querySelector('#response').style.color = 'initial';
      } else {
        document.querySelector('#response').style.color = 'white';
      }

      document.querySelector('#response').innerText = response.data.message;
    });
  } else {
    handleErrors(errors);
  }
}
function login() {
  document.querySelector('.feedbackContainer').classList.remove('showFeedback');
  clearTimeout(timeout);
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
      // document.getElementById('loginResponse').innerText = "Incorrect username or password";
      document.getElementById('emailLogin').style.border = "1px solid #B23B3A";
      document.getElementById('pinLogin').style.border = "1px solid #B23B3A";
      showFeedback('Incorrect email or password.');
    }
  });
}
function handleErrors(errors) {
  for (let i = 0; i < errors.length; i++) {
    let individualError = document.createElement('DIV');
    individualError.classList.add('individualError');
    let p = document.createElement('P');
    p.innerText = errors[i];

    individualError.appendChild(p);
    document.querySelector('.errorContainer').appendChild(individualError);
  }
}
function showSignUp() {
  document.querySelector('#login').style.display = 'none';
  document.querySelector('.register').style.display = 'block';
  document.querySelector('.forgotPassword').style.display = 'none';

}
function showLogIn() {
  document.querySelector('#login').style.display = 'block';
  document.querySelector('.register').style.display = 'none';
  document.querySelector('.forgotPassword').style.display = 'none';

}
function showForgotPassword() {
  document.querySelector('#login').style.display = 'none';
  document.querySelector('.register').style.display = 'none';
  document.querySelector('.forgotPassword').style.display = 'block';
}
function resetPassword() {
  let email = document.querySelector('#emailReset').value;
  axios({
    method: 'post',
    url: 'https://kodwiz.com/server/database_connect/server.php?action=post&resource=passwordreset',
    data: {
      email: email
    }
  }).then(function(response) {
    console.log(response.data);
    if (response.data.emailSent) {
      document.querySelector('.passwordResetFeedback').style.opacity = 1;
    } else {
      document.querySelector('.resetText').innerText = 'Error. Please contact customer support at 714-608-7664';
      document.querySelector('.resetText').style.color = '#B23B3A';
      document.querySelector('.passwordResetFeedback').style.opacity = 1;
    }
  });
}
function showFeedback(text, color = 'rgba(178, 59, 58, 1)') {
  document.querySelector('.feedbackText').innerText = text;
  document.querySelector('.feedbackContainer').classList.add('showFeedback');
  document.querySelector('.feedbackContainer').style.background = color;

  timeout = setTimeout(function() {
    document.querySelector('.feedbackContainer').classList.remove('showFeedback');

  }, 6000);
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
