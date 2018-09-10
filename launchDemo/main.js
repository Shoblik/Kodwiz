function transition(destination) {
  document.getElementsByClassName('login')[0].style.height = '0';
  document.getElementsByClassName('signUp')[0].style.height = '0';
  document.getElementsByClassName('loginBtn')[0].classList.remove('activeBtn');
  document.getElementsByClassName('signUpBtn')[0].classList.remove('activeBtn');
  document.getElementsByClassName(destination)[0].style.height = 'initial';
  document.getElementsByClassName(destination + 'Btn')[0].classList.add('activeBtn');
}
