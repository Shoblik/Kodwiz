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
  console.log(response);
  let target = document.getElementById('feedbackMessage');
  if (response.data.emailSent) {
    target.innerHTML = 'Thank you for contacting us, we\'ll be reaching out to you soon.';
    target.style.display = 'inline-block';
} else  {
    target.innerHTML = 'Something went wrong please contact us at jhoblik@kod-wiz.com or at 714-608-7664';
    target.style.display = 'inline-block';
  }
});
}
function showHeader() {
  document.getElementById('home').style.opacity = 1;
}
function smoothScroll(destination) {
  //element to scroll to
  let target = document.getElementById(destination);

  event.preventDefault();
  window.scrollTo({
    top: target.getBoundingClientRect().top + window.scrollY,
    behavior: "smooth"
  });
}

window.addEventListener('scroll', function() {
  let elementArr = ['.singleAttribute', '.tutorialBtn', '#contactInstructions', '.formContainer'];
  function isScrolledIntoView() {
    let data = [];
    let offset = 100;
    for (i = 0; i < elementArr.length; i++) {
      let eleSelector = document.querySelector(elementArr[i]);
      if (eleSelector) {
        var rect = eleSelector.getBoundingClientRect();
        var elemTop = rect.top + offset;
        var elemBottom = rect.bottom + offset;

        isVisible = elemTop < window.innerHeight && elemBottom >= 0;
        let temp = {
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
    let data = isScrolledIntoView();
    for (let i in data) {
      if (data[i].isVisible && data[i].selector === '.singleAttribute') {
        let divs = document.querySelectorAll('.singleAttribute');
        let timeout = 0;
        for (let x = 0; x < divs.length; x++) {
          setTimeout(function() {
            divs[x].style.transform = 'none';
            divs[x].style.opacity = 1;
            console.log(timeout)
          }, timeout);
          timeout += 300;
        }
        return;
      } else if (data[i].isVisible) {
        data[i].element.style.transform = 'none';
        data[i].element.style.opacity = 1;
      }
    }
  })();

});
