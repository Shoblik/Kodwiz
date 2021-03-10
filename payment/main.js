function processPayment() {
  console.log('load');
  axios({
    method: 'post',
    url: '../server/database_connect/server.php?action=post&resource=payment',
    data: {
      test: true,
    }
  }).then(function(response) {
    console.log(response);
  });
}
