function checkSession() {
  axios({
    method: 'get',
    url: 'http://localhost/server/database_connect/server.php?action=get&resource=readSession',
  }).then(function(response) {
    console.log(response);
    if (!response.data.authorized) {
      window.open("http://localhost/login");
    }
  });
}
function getUserInfo() {
  
}
