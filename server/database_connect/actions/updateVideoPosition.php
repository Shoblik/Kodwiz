<?php
/**
 * Created by PhpStorm.
 * User: SimonHoblik
 * Date: 7/15/19
 * Time: 10:49 AM
 */
$output['success'] = true;

if (is_numeric($post['position']) && is_numeric($post['videoId'])) {
    $sql = "UPDATE videos set position = '{$post['position']}' WHERE id = '{$post['videoId']}'";
    $result = mysqli_query($conn, $sql);

    $output['updated'] = $result;
} else {
    $output['errors'][] = 'Invalid info';
}

