<?php

function curl_get($url, $referer = 'http://www/google.com')
{
    $ch = curl_init(); //ініціалізація curl, збереження його в зміну. повертає зміну з курлом де всі налаштування, за допомогою цеї зміної робимо запроси до сайта. Далі налаштування опціцй курла
    curl_setopt($ch, CURLOPT_URL, $url); // setopt- set option - налаштовуємо параметри курла .Тут $url - це адресса куди буде звертатися налаштований курл
    curl_setopt($ch, CURLOPT_HEADER, 0); //вказуємо що нас не цікавлять заголовки
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0" ); //вказуємо фейковий бразузер тіпа ми з нього
    curl_setopt($ch, CURLOPT_REFERER, $referer);// устанавлюємо $referer, тіпа ми перейшли з гугла
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // тру-щоб curl_exec повернув весь хтмл код з сервера
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
