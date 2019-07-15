<?php
/**
 * Created by PhpStorm.
 * User: SimonHoblik
 * Date: 7/15/19
 * Time: 11:11 AM
 */

$output['success'] = true;

if (isset($post['id']) && is_numeric($post['id'])) {
    $qry = "DELETE FROM videos WHERE id = '{$post['id']}'";
    $result = mysqli_query($conn, $qry);

    $output['deleted'] = $result;
} else {
    $output['deleted'] = false;
    $output['error'] = 'id error';
}