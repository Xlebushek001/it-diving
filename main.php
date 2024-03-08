<?php
require('C:\xampp\htdocs\vk\vendor\vkcom\vk-php-sdk\src\VK\Client\VKApiClient.php');
require('config.php');

function write_message($sender, $message) {
    $request_params = array(
        'user_id' => $sender,
        'message' => $message,
        'random_id' => $conf["random_id"],
        'access_token' => $conf["ac_token"],
        'v' => '5.131'
    );
    
    $get_params = http_build_query($request_params);
    file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);
}

$token = $conf["token"];


$event = json_decode(file_get_contents('php://input'), true);
echo($event);
if (isset($event['type']) && $event['type'] == 'message_new' && isset($event['object']['text'])) {
    $received_message = $event['object']['text'];
    $sender = $event['object']['user_id'];
    
    if ($received_message == "Привет") {
        write_message($sender, "ку");
    }
}
else{
    echo("Соси");
}

$events = $event; // Store the received data in the 'events' variable
