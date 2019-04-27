let timeout = null;
function moveLabel() {
  // event.target.nextElementSibling.classList.add('activateLabel');
}
function register() {
  loading = true;
  moveProgressBar(1);

  let errors = [];

  let activeErrors = document.getElementsByClassName('individualError');

  while(activeErrors[0]) {
    activeErrors[0].remove();
  }

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
      loading = false;

      if (response.data.emailSent) {
          let column = document.querySelector('.left-col');
          let signUpBtn = document.querySelector('.signUpBtn');
          column.style.transition = '1s';
          column.style.backgroundColor = '#5cb85c';

          signUpBtn.style.backgroundColor = '#5cb85c';
          signUpBtn.style.backgroundColor = '#5cb85c';

          document.querySelector('.resetText').innerText = response.data.message;
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
    url: 'https://kodwiz.com/server/database_connect/server.php?action=post&resource=login',
    data: {
      email: document.getElementById('emailLogin').value,
      password: document.getElementById('pinLogin').value
    }
  }).then(function(response) {
    loading = false;
    console.log(response.data);
    if (response.data.success) {
      window.open('https://kodwiz.com/dashboard', target="_self");
    } else {
      // document.getElementById('loginResponse').innerText = "Incorrect username or password";
      // document.getElementById('emailLogin').style.border = "1px solid #B23B3A";
      // document.getElementById('pinLogin').style.border = "1px solid #B23B3A";
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
  loading = true;
  moveProgressBar(2);

  let email = document.querySelector('#emailReset').value;
  axios({
    method: 'post',
    url: 'https://kodwiz.com/server/database_connect/server.php?action=post&resource=passwordreset',
    data: {
      email: email
    }
  }).then(function(response) {
    console.log(response.data);
    loading = false;
    if (response.data.emailSent) {
      document.querySelector('#resetSuccess').style.display = 'block !important';
    } else {
      document.querySelector('.resetText').innerText = 'Error. Please contact customer support at business@kodwiz.com';
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
let loading = false;
let expand = true;
let interval = null;

function moveProgressBar(index) {
  movement(index);
  interval = setInterval(function() {
    movement(index);
  }, 700);
}
function movement(index) {
  let progressBar = document.querySelectorAll('.progressBar')[index];
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
