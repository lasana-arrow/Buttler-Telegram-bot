<?php
include('vendor/autoload.php'); //Подключаем библиотеку
use Telegram\Bot\Api;

$telegram = new Api('2028998180:AAEzLdA4U6tNxdvSbhCR9nGbV2czNNG1tQo'); //Устанавливаем токен, полученный у BotFather
$result = $telegram->getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя

$text = $result["message"]["text"]; //Текст сообщения
$chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя
echo "chat_id=".$chat_id;
$name = $result["message"]["from"]["username"]; //Юзернейм пользователя
$mainmenu = [["Что это?"], ["Какая погода в Кейптауне?"], ["Хочу порадовать хозяйку"]];//Клавиатура
$about = [["Что такое виртуальная кофейня?"], ["Почему Лавка Странных Вещей?"], ["Тут что-то продаётся?"], ["Какой столик свободный?"]];//Клавиатура
$weird = [["Давай сначала"]];
$mistress = [["А кто эта хозяйка?"],["Хочу порадовать хозяйку!"]];
$after_mistress =[["Какой столик свободный?"],["Хочу порадовать хозяйку"]];
$first_time =[["Впервые тут!"],["Лавка мне уже знакома"]];


$privet=Array('ривет');
$zdorova=Array('дравствуй','дорова',' дратути');
$dobry=Array('обрый');
$dobroe=Array('оброе');
$welcome='Добро пожаловать в вирутальную кофейню Лавка Странных вещей. Чего изволите?';

function something_like($needle, $heap)
{   if (in_array($needle, $heap)) return true;

    for ($i=0; $i<sizeof($heap); $i++)
        if ((strpos($needle, $heap[$i])!=false)||(strpos($heap[$i],$needle)!=false)) return true;
    return false;
}

if ($text) {
    if (something_like($text, $privet))
    {
        $reply="И тебе привет, человек добрый!... ".$welcome;
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $mainmenu, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    }
    elseif (something_like($text, $zdorova))
    {
        $reply="И Вам не хворать!... ".$welcome;
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $mainmenu, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    }

    elseif (something_like($text, $dobry))
    {
        $reply="Добрый!... ".$welcome;
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $mainmenu, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    }
    elseif (something_like($text, $dobroe))
    {
        $reply="Ох... Доброе :) ".$welcome;
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $mainmenu, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    }

    elseif ($text == "/start") {
        $reply = $welcome;
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $mainmenu, 'resize_keyboard' => false, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    } elseif ($text == "Что это?") {
        $reply = "Вы разговариваете с дворецким виртуальной кофейни. Да, я виртуальный. Но симпатичный.";
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
        $url = "https://lasana.ru/buttler.jpg";
        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $url, 'caption' => "Правда же?"]);
        $add_reply="Я могу Вам рассказать о Лавке Странных Вещей или проводить к вашему столику";
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $about, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $add_reply, 'reply_markup' => $reply_markup]);


    }
    elseif ($text == "Что такое виртуальная кофейня?") {
        $reply = "Виртуальная кофейня - это такое место в сети, где можно посидеть и почитать/посмотреть/послушать что-нибудь интересное, пока вы пьёте кофе. Интересно с точки зрения нашей хозяйки, конечно.";
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $mistress, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    }
    elseif ($text == "А кто эта хозяйка?") {
        $reply = "А вот она какая!";
        $url = "https://lasana.ru/mistress.jpg";
        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $url, 'caption' => "Строгая, правда?"]);
        $add_reply="Интересы нашей хозяйки практически полностью совпадают с меню кофейни";
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $after_mistress, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $add_reply, 'reply_markup' => $reply_markup]);
    }
    elseif ($text == "Почему Лавка Странных Вещей?") {
        $reply = "Хозяйка представляет себе эту кофейню, как одновременно и место, где собраны разные странные вещи. Ну, то есть, обычно для людей они странные. А для хозяйки интересные. И она надеется поделиться ими с вами";
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $about+$mistress, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    }
    elseif ($text == "Тут что-то продаётся?") {
        $reply = "Нет. Всё даром! Но при желании можно порадовать хозяйку";
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $weird+$mistress, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    }
    elseif ($text == "Хочу порадовать хозяйку") {
        $reply = "Порадуйте. https://yoomoney.ru/to/410013242510181";
        $url = "https://lasana.ru/happy.jpg";
        $telegram->sendPhoto(['chat_id' => $chat_id, 'photo' => $url, 'caption' => "Она уже радуется заранее"]);
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $about, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    }
    elseif ($text == "Какой столик свободный?") {
        $reply = "Сейчас посмотрим... Вы впервые в нашей кофейне?";
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $first_time, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    }
    elseif ($text == "Впервые тут!") {
        $reply = "Добро пожаловать! @weirdthingstore";
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    }
    elseif ($text == "Лавка мне уже знакома") {
        $reply = "Тогда что ж мы стоим? Кофе вас уже ждёт! @weirdthingstore";
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
    }

    elseif ($text == "Какая погода в Кейптауне?") {
        $reply = "Честно? Не знаю. Вот лучше погода в Ростове-на-Дону.";
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);
        $html=simplexml_load_file('http://informer.gismeteo.ru/rss/34731.xml');
         foreach ($html->channel->item as $item) {
             $respond .= "<b>".$item->title . "</b>\n";
             $respond .= $item->description."\n";
         }

        $telegram->sendMessage(['chat_id' => $chat_id, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true, 'text' => $respond]);
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $weird, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => 'Что-то ещё?', 'reply_markup' => $reply_markup]);

    }
    elseif ($text == "Давай сначала") {
        $reply="Давайте :)))";
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $about, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);

    }
    else {
        $reply = "Э... Простите? Что-то я подтупливаю. Меню?";
        $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $weird, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);

    }
} else {
    $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $mainmenu, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Простите, не понял ;) Может, меню?", 'reply_markup' => $reply_markup]);

}

?>