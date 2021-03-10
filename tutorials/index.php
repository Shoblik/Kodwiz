<?php
$ACCESS_CONTROL = true;
require_once('../server/database_connect/connect.php');

$qry = "SELECT * FROM videos WHERE active = 1 ORDER BY position ASC";
$result = mysqli_query($conn, $qry);
$videos = mysqli_fetch_all($result,MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="shortcut icon" sizes="300x300" href="../images/kod_wiz_logo_org.png">
    <title>Tutorials</title>
    <link rel='stylesheet' href='./style.css' />
    <script src='./main.js'></script>
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
    <?php require('../header/header.php'); ?>
    <div>
        <div class="videoHeader">
            <h1>Learn Faster with our Video Tutorials</h1>
        </div>
        <div class="videoContainer">
            <div class="video">
                <iframe class='featuredVideo' width="100%" height="300px" src="https://www.youtube.com/embed/tenEhE8gESQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="video">
                <iframe class='featuredVideo' width="100%" height="300px" src="https://www.youtube.com/embed/e4BJHQq2vgg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="video">
                <iframe class='featuredVideo' width="100%" height="300px" src="https://www.youtube.com/embed/ocqQj5fnLis" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="video">
                <iframe class='featuredVideo' width="100%" height="300px" src="https://www.youtube.com/embed/eUP6hPNovtY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="video">
                <iframe class='featuredVideo' width="100%" height="300px" src="https://www.youtube.com/embed/ZCR4ptPIb4s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="video">
                <iframe class='featuredVideo' width="100%" height="300px" src="https://www.youtube.com/embed/N1cd97oAKns" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
  </body>
</html>
