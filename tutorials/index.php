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
  </head>
  <body>
    <?php require('../header/header.php'); ?>
    <div>
        <div class="videoHeader">
            <h1>Learn Faster with our Video Tutorials</h1>
        </div>
        <div class="videoContainer">
            <?php foreach ($videos as $video) { ?>
                <div class="video">
                    <iframe class='featuredVideo' width="100%" height="300px" src="<?php echo $video['url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            <?php } ?>
        </div>
    </div>
  </body>
</html>
