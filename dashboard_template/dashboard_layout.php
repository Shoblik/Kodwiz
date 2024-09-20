<html>
<head>
    <meta charset="UTF-8">
    <title>KodWiz Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.5/bluebird.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <?php

    if (isset($links_and_scripts) && !empty($links_and_scripts)) {
        foreach ($links_and_scripts as $item) {
            echo $item;
        }
    }

    ?>
    <link rel='stylesheet' href='./css/dashboard_global.css' />
    <link rel='stylesheet' href='./style.css' />
    <script src="./js/dashboard_global.js"></script>
    <script src='./main.js?ver=1.2'></script>
    <script>checkSession();</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZNM6SHLE6Q"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ZNM6SHLE6Q');
</script>
</head>
<body>
<?php

require_once('./main_content.php');

?>
</body>
</html>