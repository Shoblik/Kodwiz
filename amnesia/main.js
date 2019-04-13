function moveLabel() {
  // event.target.nextElementSibling.classList.add('activateLabel');
}
function updatePassword() {
  let url = window.location.href;
  let code = url.slice(url.indexOf('code=') + 5);

  axios({
    method: 'post',
    url: 'https://kodwiz.com/server/database_connect/server.php?action=post&resource=updatePassword',
    data: {
      password: document.getElementById('password').value,
      code: code
    }
  }).then(function(response) {
    console.log(response.data);
    window.open('https://kodwiz.com/login', target='_self');
  })
}
