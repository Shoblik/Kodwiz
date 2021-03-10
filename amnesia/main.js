function moveLabel() {
  // event.target.nextElementSibling.classList.add('activateLabel');
}
function updatePassword() {
  var url = window.location.href;
  var code = url.slice(url.indexOf('code=') + 5);

  axios({
    method: 'post',
    url: '../server/database_connect/server.php?action=post&resource=updatePassword',
    data: {
      password: document.getElementById('password').value,
      code: code
    }
  }).then(function(response) {
    console.log(response.data);
    window.open('https://kodwiz.com/login', target='_self');
  })
}
