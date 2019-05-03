var timeout = null;
function moveLabel() {
  // event.target.nextElementSibling.classList.add('activateLabel');
}
function register() {
  var errors = {};

  //get the target
  var url = window.location.href;
  var target = url.slice(url.indexOf('target=') + 7);

  //check to make sure there is a value for all of these
  var name = document.querySelector('#name').value;
  var bussiness = document.querySelector('#bussiness').value;
  var email = document.querySelector('#email').value;
  var phone = document.querySelector('#phone').value;
  var password = document.querySelector('#pin').value;

  if (!name) {
    errors['first_name_error'] = 'Name can\'t be blank';
  }
  if (!email) {
    errors['email_error'] = 'Email can\t be blank';
  }
  if (!pin) {
    errors['pin_error'] = 'Password can\'t be blank';
  }

  if (Object.keys(errors).length === 0 && errors.constructor === Object) {
    axios({
      method: 'post',
      url: '../server/database_connect/server.php?action=post&resource=register&target=' + target,
      data: {
        name: name,
        bussiness: bussiness,
        email: email,
        phone: phone,
        password: password,
      }
    }).then(function(response) {
      // console.log(response.data);
      if (response.data.plan === 0701) {
        document.querySelector('#response').innerText = response.data.message;
      } else {
        handler.open({
        name: 'Kodwiz',
        description: '2 widgets',
        amount: Number(response.data.plan)
      });
      }
    });
  } else {
    handleErrors(errors);
  }
}
function handleErrors(errors) {
  for (i in errors) {
    // document.querySelector('#' + i).innerText = errors[i];
    console.log(i);
  }
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
