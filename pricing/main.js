function register() {
  var errors = {};

  //check to make sure there is a value for all of these
  var first_name = document.querySelector('#first_name').value;
  var last_name = document.querySelector('#last_name').value;
  var bussiness = document.querySelector('#bussiness').value;
  var email = document.querySelector('#email').value;
  var phone = document.querySelector('#phone').value;
  var pin = document.querySelector('#pin').value;

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
      url: '../server/database_connect/server.php?action=post&resource=register',
      data: {
        first_name: first_name,
        last_name: last_name,
        bussiness: bussiness,
        email: email,
        phone: phone,
        pin: pin,
      }
    });
  } else {
    handleErrors(errors);
  }
}
function login() {

}
function handleErrors(errors) {
  console.log(errors);
  for (i in errors) {
    console.log(i);
    console.log(errors[i]);
    document.querySelector('#' + i).innerText = errors[i];
  }
}
function initTransition() {
  var pills = document.querySelectorAll('.individualOption');

  for (var i = 0; i < pills.length; i++) {
    pills[i].addEventListener('mouseover', function() {
      this.classList.add('hover');
    });
    pills[i].addEventListener('mouseout', function() {
      this.classList.remove('hover');
    })
  }
}
