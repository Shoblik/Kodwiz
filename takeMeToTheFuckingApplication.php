<?php

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

$token = generateToken(date('mdY'), 'shoblik@yahoo.com');

$headers = array(
	'host' => 'eccides7.domain.com',
	//'Location' => " http://199.243.91.7:8000/sap/bc/bsp/sap/yhh_app/yhh_app.do/?warp=' . $token . '&usr=' . 'shoblik@yahoo.com'" 
	'Location' => " http://199.243.91.7:8000/sap/bc/bsp/sap/yhh_app/yhh_app.do?host=localhost"
);

foreach ($headers as $headerType => $headerValue) {
	header($headerType . ': ' . $headerValue);
}

//header("host: localhost");
//header("location: http://199.243.91.7:8000/sap/bc/bsp/sap/yhh_app/yhh_app.do/?warp=' . $token . '&usr=' . 'shoblik@yahoo.com'");

 ?>

