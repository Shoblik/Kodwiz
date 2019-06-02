var timeout = null;
function moveLabel() {
  // event.target.nextElementSibling.classList.add('activateLabel');
}
function register() {
  loading = true;
  moveProgressBar(1);

  var errors = [];

  var activeErrors = document.getElementsByClassName('individualError');

  while(activeErrors[0]) {
    activeErrors[0].remove();
  }

  //check to make sure there is a value for all of these
  var name = document.querySelector('#name').value;
  var bussiness = document.querySelector('#bussiness').value;
  var email = document.querySelector('#email').value;
  var phone = document.querySelector('#phone').value;
  var password = document.querySelector('#pin').value;

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
      url: '../server/database_connect/server.php?action=post&resource=register',
      data: {
        name: name,
        bussiness: bussiness,
        email: email,
        phone: phone,
        password: password,
      }
    }).then(function(response) {
      console.log(response.data);
      loading = false;

      if (response.data.emailSent) {
          var column = document.querySelector('.left-col');
          var signUpBtn = document.querySelector('.signUpBtn');
          column.style.transition = '1s';
          column.style.backgroundColor = '#5cb85c';

          signUpBtn.style.backgroundColor = '#5cb85c';
          signUpBtn.style.backgroundColor = '#5cb85c';

          document.querySelector('.resetText').innerHTML = response.data.message;
          document.querySelector('.outerInputContainer.reg').classList.add('hideOuterInputContainer');
          document.querySelector('.otherLinks.reg').style.display = 'none';
          document.querySelector('#response').innerText = '';

      } else {
        document.querySelector('#response').style.color = 'white';
        document.querySelector('#response').innerText = response.data.message;

      }

      // console.log(response.data);
//       if (response.data.plan === 0701) {
//         document.querySelector('#response').innerText = response.data.message;
//       } else {
//         handler.open({
//         name: 'Kodwiz',
//         description: '2 widgets',
//         amount: Number(response.data.plan)
//       });
//       }
    });
  } else {
    loading = false;
    handleErrors(errors);
  }
}
function login() {

  document.querySelector('.feedbackContainer').classList.remove('showFeedback');
  clearTimeout(timeout);
  loading = true;
  moveProgressBar(0);

  axios({
    method: 'post',
    url: '../server/database_connect/server.php?action=post&resource=login',
    data: {
      email: document.getElementById('emailLogin').value,
      password: document.getElementById('pinLogin').value
    }
  }).then(function(response) {
    loading = false;
    console.log(response.data);
    if (response.data.success) {
      window.open('../dashboard', target="_self");
    } else {
      // document.getElementById('loginResponse').innerText = "Incorrect username or password";
      // document.getElementById('emailLogin').style.border = "1px solid #B23B3A";
      // document.getElementById('pinLogin').style.border = "1px solid #B23B3A";
      showFeedback('Incorrect email or password.');
    }
  });
}
function handleErrors(errors) {
  for (var i = 0; i < errors.length; i++) {
    var individualError = document.createElement('DIV');
    individualError.classList.add('individualError');
    var p = document.createElement('P');
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
  loading = true;
  moveProgressBar(2);

  var email = document.querySelector('#emailReset').value;
  axios({
    method: 'post',
    url: '../server/database_connect/server.php?action=post&resource=passwordreset',
    data: {
      email: email
    }
  }).then(function(response) {
    console.log(response.data);
    loading = false;
    if (response.data.emailSent) {
      document.querySelector('#resetSuccess').style.display = 'block';
    } else {
      document.querySelector('.resetText').innerText = 'Error. Please contact customer support at business@kodwiz.com';
      document.querySelector('.resetText').style.color = '#B23B3A';
      document.querySelector('.passwordResetFeedback').style.opacity = 1;
    }
  });
}
function showFeedback(text, color) {
  if (color === undefined) {
    color = 'rgba(178, 59, 58, 1)';
  }
  document.querySelector('.feedbackText').innerText = text;
  document.querySelector('.feedbackContainer').classList.add('showFeedback');
  document.querySelector('.feedbackContainer').style.background = color;

  timeout = setTimeout(function() {
    document.querySelector('.feedbackContainer').classList.remove('showFeedback');

  }, 6000);
}
var loading = false;
var expand = true;
var interval = null;

function moveProgressBar(index) {
  movement(index);
  interval = setInterval(function() {
    movement(index);
  }, 700);
}
function movement(index) {
  var progressBar = document.querySelectorAll('.progressBar')[index];
  if (loading) {
    if (expand) {
      progressBar.classList.add('expandProgressBar');
      progressBar.classList.remove('collapseProgressBar');
      expand = false;
    } else {
      progressBar.classList.add('collapseProgressBar');
      progressBar.classList.remove('expandProgressBar');
      expand = true;
    }
  } else {
    clearInterval(interval);
    loading = false;
    progressBar.classList.add('collapseProgressBar');
    progressBar.classList.remove('expandProgressBar');
    expand = true;
  }
}
function init() {
  // setInterval(function() {
    // var email = document.querySelector('#emailLogin');
    // var password = document.querySelector('#pinLogin');
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
