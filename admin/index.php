<?php

$ACCESS_CONTROL = true;
$getCustomerInfo = true;
$serverRequest = true;
require_once('../server/database_connect/connect.php');
require_once('../server/database_connect/actions/read_session.php');
require_once('../server/database_connect/environment.php');

if ($output['authorized'] !== true) header("Location: ../login");

$user_id = $output['id'];

$qry = "SELECT * FROM admin WHERE user_id = '$user_id'";

$result = mysqli_query($conn, $qry);

if (!$result->num_rows) header("Location: ../login");

// TUTORIAL VIDEOS ADMIN
$qry = "SELECT * FROM videos WHERE active = 1 ORDER BY position ASC";
$result = mysqli_query($conn, $qry);
$videos = mysqli_fetch_all($result,MYSQLI_ASSOC);


?>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" sizes="500x500" href="../images/kod_wiz_logo_org.png">
    <title>KodWiz Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.5/bluebird.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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
<div style="display: inline-block; padding: 15px; border: 1px solid #CCC; margin-bottom: 10px;">
    <h3>Add new video to /tutorials page</h3>
    <form action="../server/database_connect/actions/addNewVideo.php" method="POST">
        <input type="hidden" name="authorizedBySimon" value="true" />
        <h3>Sort Order:</h3>
        <input name="position" type="text" />
        <h3>Url:</h3>
        <input name="url" type="text" />
        <button>Submit</button>
    </form>
</div>
<div>
    <table>
        <tr>
            <th>Position</th>
            <th>URL</th>
        </tr>
        <?php foreach ($videos as $video) { ?>
            <tr>
                <td id="cell<?php echo $video['id']; ?>">
                    <input id="<?php echo $video['id']; ?>" type="text" value="<?php echo $video['position']; ?>" />
                    <div>
                        <button onclick="videoAdmin.updatePosition('<?php echo $video['id']; ?>')">Update Position</button>
                        <button onclick="videoAdmin.delete('<?php echo $video['id']; ?>')">Delete Video</button>
                    </div>
                </td>
                <td>
                    <iframe class='featuredVideo' width="100%" height="300px" src="<?php echo $video['url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<script>
    var videoAdmin = {
        updatePosition: function(id) {
            var position = $('#' + id).val();
            axios({
                method: 'POST',
                url: '../server/database_connect/server.php?action=post&resource=updateVideoPosition',
                dataType: 'JSON',
                data: {
                    'videoId': id,
                    'position': position
                }
            }).then(function(response) {
                response = response.data;
                var text = null;
                if (response.updated) {
                    text = $('<p>').text('Updated');
                } else {
                    text = $('<p>').text('Error');
                }
                $('#cell' + id).append(text);
            });
        },
        delete: function(id) {
            axios({
                method: 'POST',
                url: '../server/database_connect/server.php?action=post&resource=deleteVideo',
                dataType: 'JSON',
                data: {
                    'id': id
                }
            }).then(function(response) {
                response = response.data;
                var text = null;
                if (response.deleted) {
                    text = $('<p>').text('Deleted');
                } else {
                    text = $('<p>').text('Error');
                }
                $('#cell' + id).append(text);
            });
        }
    }
</script>
<style>
    * {
        font-family: helvetica;
    }
    table td {
        border: 1px solid #CCC;
        margin: 0;
    }
    table th {
        background-color: #CCC;
        color: #000;
    }
    table {
        width: 825px;
    }
</style>

