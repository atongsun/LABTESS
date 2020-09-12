<?php 
  $access_token = '/mTngjhSU2HvRPX7ahDdh2bUqXnrUQm8c0/7xqzHDyqqRvrcIz0FWw3DP45ZdDX1doo2duDWHHBlzDWX52IoDeG6hvOogLkdznP5pLUT7oRfy8XcCfkmvN7TSpV41xHsezQjdg8UVQrV4rgQJME3XAdB04t89/1O/w1cDnyilFU=';
  $url = 'https://api.line.me/v1/oauth/verify';
  $headers = array('Authorization: Bearer ' . $access_token);
  $ch = curl_init($url);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $result = curl_exec($ch);curl_close($ch);
  echo $result;
