<?php
$output['success'] = true;
$output['username'] = 'test@yahoo.com';
$output['token'] = 'testtoken';
$url = "http://application.kodwiz.com?username=test@yahoo.com&token=testtoken";
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_VERBOSE, 0);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
 curl_setopt($ch, CURLOPT_URL, $url);
 $response = curl_exec($ch);
 curl_close($ch);

 $myfile = fopen("test.txt", "w") or die("Unable to open file!");
 $txt = $response;
 fwrite($myfile, $txt);
