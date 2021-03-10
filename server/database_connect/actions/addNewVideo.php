<?php
/**
 * Created by PhpStorm.
 * User: SimonHoblik
 * Date: 7/15/19
 * Time: 9:42 AM
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$ACCESS_CONTROL = TRUE;

require_once ('../connect.php');

if ($_POST['authorizedBySimon']) {
    if ($_POST['url'] && $_POST['position']) {
        $sql = "INSERT INTO videos (url, source, creation_date, active, position)
            VALUES('{$_POST['url']}', 'youtube', CURRENT_TIMESTAMP, 1, '{$_POST['position']}')";
        $result = mysqli_query($conn, $sql);

        header('Location: /admin');

    } else {
        die('Fill in position and url info');
    }

} else {
    die('not authorized');
}