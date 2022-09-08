<?php

$content = array(
	"en" => 'English Message'
	);

$fields = array(
	'app_id' => "c0b40e7f-ae82-45cf-8469-77e7e051e25b",
	//'include_player_ids' => array("6392d91a-b206-4b7b-a620-cd68e32c3a76","76ece62b-bcfe-468c-8a78-839aeaa8c5fa","8e0f21fa-9a5a-4ae7-a9a6-ca1f24294b86"),
	'include_player_ids' => array("f6d50aba-8b5e-11ec-8735-b6fdf61b51b0"),
	'data' => array("foo" => "bar"),
	'contents' => $content
);

$fields = json_encode($fields);

print("\nJSON sent:\n");

print($fields);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

$response = curl_exec($ch);

curl_close($ch);

$return["allresponses"] = $response;

$return = json_encode( $return);

print("\n\nJSON received:\n");

print($return);

print("\n");

?>