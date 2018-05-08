<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$text = trim($text);
$text = strtolower($text);

header("Content-Type: application/json");

if($text == '/prima'){
  $parameters = array('chat_id' => $chatId, "text" => 'Primi quattro: ');
  $parameters["reply_markup"] = '{ "keyboard": [["uno"], ["due"], ["tre"], ["quattro"]], "one_time_keyboard": false}';

}else if($text=='/secondi'){
  $parameters = array('chat_id' => $chatId, "text" => 'Secondi quattro: ');
  $parameters["reply_markup"] = '{ "keyboard": [["cinque"], ["sei"], ["sette"], ["otto"]], "one_time_keyboard": false}';
}else if($text=='/inline'){
  $parameters = array('chat_id' => $chatId, "text" => $text);
  $keyboard = ['inline_keyboard' => [[['text' =>  'myText', 'callback_data' => 'myCallbackText']]]];
  $parameters["reply_markup"] = json_encode($keyboard, true);

}else{
  $parameters = array('chat_id' => $chatId, "text" => $text);
}
$parameters["method"] = "sendMessage";
echo json_encode($parameters);
