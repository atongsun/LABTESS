<?php
 header("Content-type:application/json; charset=UTF-8"); 
 header("Cache-Control: no-store, no-cache, must-revalidate"); 
 header("Cache-Control: post-check=0, pre-check=0", false); 
 require_once("config.php");
 require_once("process.php");
$result = genjson($pdo);
 $len = count($result); 
 for ($i=0; $i < $len; $i++) 
 {
$id = ($result[$i]->id);
 $humidity = ($result[$i]->humidity);
 $tempC = ($result[$i]->tempC);
 $tempF = ($result[$i]->tempF);
 $heatIndexC = ($result[$i]->heatIndexC);
 $heatIndexF = ($result[$i]->heatIndexF);
 $datetime = ($result[$i]->datetime);
$date = new DateTime($datetime);
 $newdate = $date->format('d-m-Y H:i:s');
 
 $data = [
"id" => $id,
 "humidity" => $humidity, 
 "tempC" => $tempC,
 "tempF" => $tempF, 
 "heatIndexC" => $heatIndexC, 
 "heatIndexF" => $heatIndexF,
 "datetime" => $newdate
 ];
 }
$data = json_encode($data);
 echo $data; 
 
?>
