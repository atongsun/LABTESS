<?php
$access_token = 'YNaUBbZTQCWSKVdEX6h++Ra6Crk88ARJAkcG7aIbIbGzHEXW4kueP66l774Ce9ONGl/V2JefnJ3+kxD95ZeWeNPUxhGbb4Z+sd7MyMwNlOrqRO7nd7fs1m1Umct4GXFaCrna3nHu02PDpmrbclCg8AdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
$datas = file_get_contents('php://input');
$deCode = json_decode($datas,true);
function getFormatTextMessage($text)
{
   $datas = [];
   $datas['type'] = 'text';
   $datas['text'] = $text;
   return $datas;
}
function sentMessage($encodeJson,$datas)
{
    $datasReturn = [];
    $curl = curl_init();
    curl_setopt_array($curl, array(
          CURLOPT_URL => $datas['url'],
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $encodeJson,
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$datas['token'],
            "cache-control: no-cache",
            "content-type: application/json; charset=UTF-8",
          ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        $datasReturn['result'] = 'E';
        $datasReturn['message'] = $err;
    } else {
        if($response == "{}"){
           $datasReturn['result'] = 'S';
           $datasReturn['message'] = 'Success';
        }else{
           $datasReturn['result'] = 'E';
           $datasReturn['message'] = $response;
        }
    }
    return $datasReturn;
}

$messages = [];
$messages['replyToken'] = $replyToken;
$messages['messages'][0] = getFormatTextMessage("เอ้ย ถามอะไรก็ตอบได้");
$encodeJson = json_encode($messages);
$LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
$LINEDatas['token'] = "YNaUBbZTQCWSKVdEX6h++Ra6Crk88ARJAkcG7aIbIbGzHEXW4kueP66l774Ce9ONGl/V2JefnJ3+kxD95ZeWeNPUxhGbb4Z+sd7MyMwNlOrqRO7nd7fs1m1Umct4GXFaCrna3nHu02PDpmrbclCg8AdB04t89/1O/w1cDnyilFU=";
$results = sentMessage($encodeJson,$LINEDatas);

// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // Get text sent
            $text = $event['message']['text'];
            // Get replyToken
            $replyToken = $event['replyToken'];
            // Build message to reply back
            $messages = [
                'type' => 'text',
                'text' => $text,
            ];
            // Make a POST Request to Messaging API to reply to sender
            $url = 'https://api.line.me/v2/bot/message/reply';
            $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages]
            ];
            $post = json_encode($data);
            
            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            echo $result . "";
        }
    }
}
echo "OK";
