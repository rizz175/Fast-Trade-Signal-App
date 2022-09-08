<?php
$url = 'https://fcm.googleapis.com/fcm/send';
$api_key = 'AAAAowVsC00:APA91bFmI1EcZqmTCKOeF56CmCtGbuvVL-rOtMtDS13tn1txtANSG9qY1__k_veF2XLuaHQuOcRuPMm9U1O8KpqMRxOmF8jqh2I2E6F8iYTYeu5vWBAvY6FZs2EASWcQfzBA-BhlRPWs';
$fields = array(
      'notification' => array(
          'title' => 'Test Title',
           'body' => 'This is just a test for FCM.'
       ),
       "to" => "fYVK9nnXRfCAEaYftl1jf7:APA91bGdlBZ6EyrsQabmXBSROvfnwk-OyZkc9OuF3fpsQczOovb8ZZXH49xgdMX3X-sAn5pshF-yC67BNLC-eH6UI-9mMtZelioQBjAKxTATFumrpvV-9atAfmRUUpblnODf7EICie4p" //users are subscribed to topic all at startup
);
$headers = array(
     'Content-Type:application/json',
      'Authorization:key=' . $api_key
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
curl_close($ch);
if ($result === FALSE) {
     die(curl_error($ch));
}

echo 'Notification Sent !';