<?php

if (!isset($ACCESS_CONTROL) || $ACCESS_CONTROL === false) {
  die('no direct access allowed');
}

  $password = SHA1("{$post['password']}");
  $query = "SELECT * FROM `customer` WHERE `email` = '{$post['email']}' AND `password` = '$password' AND `active` = 1";
  $result = mysqli_query($conn, $query);

  if ($result->num_rows > 0) {
    $output['success'] = true;

    $date = date('mdY');
    $email = $post['email'];

    $post['auth'] = true;
    $post['logout'] = false;
    $post['id'] = mysqli_fetch_assoc($result)['id'];

    require('./actions/update_session.php');
    // $token = generateToken($date, $email);
    //
    // $output['url'] = 'http://application.kodwiz.com?warp=' . $token . '&usr=' . $email;
  }



function generateToken($date, $emailUsername) {
  $letterArr = array(
    'a' => '01',
    'b' => '02',
    'c' => '03',
    'd' => '04',
    'e' => '05',
    'f' => '06',
    'g' => '07',
    'h' => '08',
    'i' => '09',
    'j' => '10',
    'k' => '11',
    'l' => '12',
    'm' => '13',
    'n' => '14',
    'o' => '15',
    'p' => '16',
    'q' => '17',
    'r' => '18',
    's' => '19',
    't' => '20',
    'u' => '21',
    'v' => '22',
    'w' => '23',
    'x' => '24',
    'y' => '25',
    'z' => '26',
    ' ' => '27',
    '.' => '28',
    '_' => '29',
    '@' => '30',
    '-' => '31',
    '1' => 'a',
    '2' => 'b',
    '3' => 'c',
    '4' => 'd',
    '5' => 'e',
    '6' => 'f',
    '7' => 'g',
    '8' => 'h',
    '9' => 'i',
    '0' => 'j',
    'user1' => '91',
    'user2' => '92',
    'user3' => '93',
    'user4' => '94',
    'user5' => '95',
    'user6' => '96',
    'user7' => '97',
    'user8' => '98',
    'user9' => '99',
    'user0' => '90',
  );

  //take date and emailusername and join them. figure out the limit; 8 is the max str length of date
  $token = '';

  $emailLength = strlen($emailUsername);
  if ($emailLength > 8) {
    $limit = $emailLength;
  } else {
    $limit = 8;
  }

  for ($i = 0; $i < $limit; $i++) {
    if (isset($date[$i])) {
        $token .= $letterArr[$date[$i]];
    }

    if (isset($emailUsername[$i]) && is_numeric($emailUsername[$i])) {
      $token .= $letterArr['user' . $emailUsername[$i]];
    }
    else if (isset($emailUsername[$i])) {
      $token .= $letterArr[$emailUsername[$i]];
    }

    if (strlen($token) === 26) {
      return $token;
    }
  }

  return $token;
}
