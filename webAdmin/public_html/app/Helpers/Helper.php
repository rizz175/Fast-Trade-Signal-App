<?php

use App\Models\User;

function sendNotification($title)
{
    $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

    $SERVER_API_KEY = 'AAAA8DZObFA:APA91bGWa1MnWWJd7SSrqlruzgZjyu1mtXdFjSW1JOGLaO-qJAyiFrMjqtelHP9534Qzkoi0xfzi3cB036A26V4ruZ8FAR8Mx9rZ0z543nPDkTXvZC-sniqBhFnSvO0Tz2LAkR1yc51V';

    $data = [
        "registration_ids" => $firebaseToken,
        "notification" => [
            "title" => $title,
            // "body" => $body,
            "icon" => asset('assets/images/notification_icon.png'),
            "sound" => 'default',
        ],
    ];
    $dataString = json_encode($data);

    $headers = [
        'Authorization: key=' . $SERVER_API_KEY,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);
    info("Notification Response ".$response);

    return $response;
}
