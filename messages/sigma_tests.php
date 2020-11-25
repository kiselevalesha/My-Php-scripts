<?


/* Тесты */
$myphone = '+79119876543';
echo 'Тест СМС: '.PHP_EOL;
$sendSms = sendOneMess('sms', $myphone, 'SigmaSMS', 'Тестовое сообщение СМС');
var_dump($sendSms);

echo PHP_EOL.'Проверка статуса сообщения: '.PHP_EOL;
var_dump(checkStatus('6035fe28-2f60-4973-8681-jhjh887990087'));

echo PHP_EOL.'Загрузка картинки: '.PHP_EOL;
$upload_image = uploadFile('test.png');
var_dump($upload_image);
echo 'Проверить корректность загрузки можно по ссылке: https://online.sigmasms.ru/api/storage/{user_id}/{image_key}'.PHP_EOL;

echo PHP_EOL.'Тест Viber: '.PHP_EOL;
$msg_image = json_decode($upload_image);
if (isset($msg_image->key)) {
    var_dump(sendOneMess('viber', $myphone, 'X-City', 'Тест сообщения Viber', array('text' => 'Текст кнопки', 'url' => 'https://google.ru'), $msg_image->key));
}

echo PHP_EOL.'Каскадная переотправка VK->Viber->SMS: '.PHP_EOL;
$cascadeData = array(
    "type"       => 'vk',
    "recipient"  => clear_phone($myphone),
    "payload"    => array(
        "sender" => 'sigmasmsru',
        "text"   => 'Тест сообщения ВК',
    ),
    "fallbacks"  => [
        array(
            "type"       => 'viber',
            "payload"    => array(
                "sender" => 'X-City',
                "text"   => 'Тест сообщения Viber',
                "image"  => $msg_image->key,
                "button" => array(
                    "text" => "Текст кнопки",
                    "url"  => 'https://google.ru',
                ),
            ),
            '$options' => array(
                "onStatus" => ["failed"],
                "onTimeout" => array(
                    "timeout" => 120,
                    "except"  => ["delivered", "seen"]
                )
            )
        ),
        array(
            "type"    => "sms",
            "payload" => array(
                "sender" => "SigmaSMS",
                "text"   => 'Тест сообщения СМС'
            ),
            '$options' => array(
                "onStatus" => ["failed"],
                "onTimeout" => array(
                    "timeout" => 120,
                    "except"  => ["delivered", "seen"]
                )
            )
        )
    ]
);
var_dump(sendCascade($cascadeData));

?>