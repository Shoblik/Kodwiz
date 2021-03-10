
document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('newOffer').classList.add('showNewOffer');
});
function submitForm(e) {
  e.preventDefault();
  console.log('submit form');
  axios({
  method: 'post',
  url: './server/php_mailer/mail_handler.php',
  data: {
    message: document.getElementById('message').value,
    email: document.getElementById('email').value,
    phone: document.getElementById('phone').value,
    name: document.getElementById('name').value
  }
}).then(function(response) {
  var target = document.getElementById('feedbackMessage');
  if (response.data.emailSent) {
    target.innerHTML = 'Thank you for contacting us, we\'ll be reaching out to you soon.';
    target.style.display = 'inline-block';
} else  {
    target.innerHTML = 'Something went wrong please contact us at simonthehoblik@gmail.com or at 657-282-2679';
    target.style.display = 'inline-block';
  }
});
}
function showHeader() {
  document.getElementById('home').style.opacity = 1;
}
function smoothScroll(destination) {
  //element to scroll to
  var target = document.getElementById(destination);

  event.preventDefault();
  window.scrollTo({
    top: target.getBoundingClientRect().top + window.scrollY,
    behavior: "smooth"
  });
}

window.addEventListener('scroll', function() {
  var elementArr = ['.tutorialBtn', '#contactInstructions', '.formContainer'];
  function isScrolledIntoView() {
    var data = [];
    var offset = 100;
    for (i = 0; i < elementArr.length; i++) {
      var eleSelector = document.querySelector(elementArr[i]);
      if (eleSelector) {
        var rect = eleSelector.getBoundingClientRect();
        var elemTop = rect.top + offset;
        var elemBottom = rect.bottom + offset;

        isVisible = elemTop < window.innerHeight && elemBottom >= 0;
        var temp = {
          element: eleSelector,
          isVisible: isVisible,
          selector: elementArr[i],
        }
        data.push(temp);
      }
  }
  return data;
}

  (function() {
    var data = isScrolledIntoView();
    for (var i in data) {
      if (data[i].isVisible) {
        data[i].element.style.transform = 'none';
        data[i].element.style.opacity = 1;
      }
    }
  })();

});
