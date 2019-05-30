function checkSession() {
    axios({
        method: 'get',
        url: '../server/database_connect/server.php?action=get&resource=readSession&customerInfo=true',
    }).then(function(response) {
        if (!response.data.authorized) {
            window.open("https://kodwiz.com/login", target = "_self");
        } else {
            // verified
        }
    });
}