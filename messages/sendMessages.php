<?
    require_once('../php-scripts/db/dbMessages.php');
    require_once('../php-scripts/db/dbMessageRules.php');
    require_once('../php-scripts/db/dbSubscriptionWaste.php');
    require_once('../php-scripts/messages/sigmasms.php');
    require_once('../php-scripts/api/v1/subscriptions/balance.php');


    //$sender = "talon24ru";
    //$sender = "sigmasmsru";    //  Пока не одобрили наше имя
    
    $sender = "B-Media";    //  Пока не одобрили наше имя. Не закоментируй это, иначе смски не будут отсылаться !!!
    
    $senderSMS = "B-Media";
    $senderWhatsApp = "B-Media";
    $senderVider = "Lucky Shop";
    $senderVK = "sigmasmsru";
    $dbMessage = null;

function SendMessages($idDB) {
    global $sender, $dbMessage;
    
    $dbMessage = new DBMessage($idDB);

    //  Сначала отправим все не отправленные email-сообщения
    $arrayMessages = $dbMessage->GetArrayRows("idTypeChannel=".EnumTypeChannels::TypeChannelEmail." AND ageWasSended=0 AND isDraft=0  AND isNew=0 AND isDeleted=0 AND idTypeError=0");
    foreach($arrayMessages as $message) {
        if (!empty($message->strAdress)) {
            //if ((!empty($message->strAdress)) && (($message->idTypeError == 0) || ($message->idTypeError == EnumTypeError::TypeErrorNoEmail))) {
            SendUniversalEmail($message->strAdress, $message->strBody, $message->strBodyOut);
            $dbMessage->UpdateField("ageWasSended", $dbMessage->NowLong(), "id=".$message->id);
        }
        else {
            $dbMessage->UpdateField("idTypeError", EnumTypeError::TypeErrorNoEmail, "id=".$message->id);
        }
    }

    //  Проверим, что на счету есть деньги (и это не подарочные деньги от сервиса)
    $totalPayedBalance = 0;

    $totalRealPayed = GetTotalRealPayments($idDB);
    $totalMessageWasted = GetTotalMessageWastes($idDB);
    if ($totalRealPayed == 0) {     //  Если были платежи
        if ($totalMessageWasted < 600) {  //  Если расход на отправку сообщений не превысил 6 рублей
            $totalPayedBalance = 600 - $totalMessageWasted;   //  Дадим подарочные 6 руб. для отсылки нескольких первых сообщений бесплатно.
        }
    }
    else {
        $summaTotalTodayWastes = GetTotalServiceWastes($idDB);
        $totalPayedBalance = $summaTotalTodayPayments - ($summaTotalTodayWastes + $summaTotalWasteMessages);
    }


    //  ПОТОМ ЭТО УДАЛИ !!!!! Это только для тестов
    //$totalPayedBalance = $totalPayedBalance + 100000;

    
    //  Потом отправим остальные через сервис SigmaSms (sms, viber, whatsapp)
    $ageNow = $dbMessage->NowLong();
    $dbSubscriptionWaste = new DBSubscriptionWaste($idDB);
    
    $sql = "(NOT idTypeChannel=".EnumTypeChannels::TypeChannelEmail.") AND (ageWillSend=0 OR ageWillSend>=".$ageNow.") AND ageWasSended=0 AND strIdSigmaMessage='' AND isDraft=0 AND isNew=0 AND isDeleted=0 AND idTypeError=0";
    $arrayMessages = $dbMessage->GetArrayRows($sql);
    foreach($arrayMessages as $message) {
        if ($totalPayedBalance > 100) {     //  Больше хотя бы одного рубля
            $totalPayedBalance -= DoSendMessage($message);
        }
        else    $dbMessage->UpdateField("idTypeError", EnumTypeError::TypeErrorLackMoney, "id=".$message->id);
    }
}

function DoSendMessage($message) {
    global $sender, $dbMessage, $idDB;
    $cost = 0;
    
    if ($dbMessage == null)     $dbMessage = new DBMessage($idDB);
    
    ///$message->strBodyOut = "Это тестовое сообщение.";//Изменённый текст будет отправлен на модерацию.";  //  Пока отсылаем тестовое сообщение. Потом убери это !!!!!!
    $strJsonReturn = "";

    switch($message->idTypeChannel) {
        case EnumTypeChannels::TypeChannelVk:
            $strJsonReturn = SendVk($message->strAdress, $message->strBodyOut, $message->ageWillSend);
            break;
        case EnumTypeChannels::TypeChannelWhatsapp:
            $strJsonReturn = SendWhatsapp('+7'.$message->strAdress, $message->strBodyOut, $message->ageWillSend);
            break;
        case EnumTypeChannels::TypeChannelViber:
            $strJsonReturn = SendViber('+7'.$message->strAdress, $message->strBodyOut, $message->ageWillSend);
            break;
        case EnumTypeChannels::TypeChannelSmsMms:
            $strJsonReturn = SendSms('+7'.$message->strAdress, $message->strBodyOut, $message->ageWillSend);
            break;
        case EnumTypeChannels::TypeChannelPhone:
        default:
            //  Если используется оптимизация стоимости, то будем каскадно искать самый дешёвый канал
            
            //  Что-то каскадный способ не работает !!!
            //$strJsonReturn = SendMessageCascade('+7'.$message->strAdress, $message->strBodyOut, $message->ageWillSend);
            
            //  Пока отправляем в смс, а не каскадом !!!
            $strJsonReturn = SendSms('+7'.$message->strAdress, $message->strBodyOut, $message->ageWillSend);
            break;
    }

    ///echo " strJsonSigmaReturn: ".$strJsonReturn;

    //  Обрабатываем возвращаемый json и сохраняем idMessage, чтобы можно было проверить, что оно было отослано, стоимость и время отправки
    $flagIsError = 1;
    if (!empty($strJsonReturn)) {
        $jsonSigma = json_decode($strJsonReturn, false, 32);

        if (!empty($jsonSigma)) {

            if ((isset($jsonSigma->id)) && ($jsonSigma->id != null)) {

                $flagIsError = 0;

                /*if (isset($jsonSigma->type))
                    switch($jsonSigma->type) {
                        case 'sms':
                            //  Каждое смс (80 символов) оплачивается отдельно
                            $length = mb_strlen($message->strBody);
                            $count = ceil($length / 80);
                            if ($count < 1) $count = 1;     //  На всякий случай проверим
                            $cost = $count * 300;
                            break;
                        case 'mms': $cost = 500;    break;
                        case 'viber': $cost = 300;    break;
                        case 'whatsapp': $cost = 300;    break;
                        case 'vk': $cost = 60;    break;
                    }*/

                if ($message->ageWillSend == 0)
                    $dbMessage->UpdateField("ageWasSended", $dbMessage->NowLong(), "id=".$message->id);
                else
                    $dbMessage->UpdateField("ageWasSended", $message->ageWillSend, "id=".$message->id);
                
                if (isset($jsonSigma->id))
                    $dbMessage->UpdateField("strIdSigmaMessage", $jsonSigma->id, "id=".$message->id);
                
                if (isset($jsonSigma->price) && ($jsonSigma->price > 0)) {
                    $cost = $jsonSigma->price * 100;

                    if ($message->isHidden == 0)
                        $dbMessage->UpdateField("cost", $cost, "id=".$message->id);

                    $dbMessage->UpdateField("costSender", $cost, "id=".$message->id);
                }
            }

            if (isset($jsonSigma->error)) {
                if (($jsonSigma->error !== null)) {
                    if (isset($jsonSigma->error))
                        $dbMessage->UpdateField("idSenderError", $jsonSigma->error, "id=".$message->id);
                    if (isset($jsonSigma->message))
                        $dbMessage->UpdateField("strSenderError", $jsonSigma->message, "id=".$message->id);
                    }
            }
        }
    }
    if ($flagIsError == 1)
        $dbMessage->UpdateField("idTypeError", EnumTypeError::TypeErrorCanNotReceived, "id=".$message->id);

    return $cost;
}

function SendSms($adress, $body, $ageWillSend) {
    global $sender;
    return SendMessage('sms', $adress, $sender, $body, $ageWillSend);
}
function SendViber($adress, $body, $ageWillSend) {
    global $sender;
    return SendMessage('viber', $adress, $sender, $body, $ageWillSend);
}
function SendWhatsapp($adress, $body, $ageWillSend) {
    global $sender;
    return SendMessage('whatsapp', $adress, $sender, $body, $ageWillSend);
}
function SendVk($adress, $body, $ageWillSend) {
    global $sender;
    return SendMessage('vk', $adress, $sender, $body, $ageWillSend);
}

function SendMessage($type, $adress, $sender, $body, $ageWillSend) {
    /*$testObj = new Base();
    $testObj->status = 1;
    $testObj->type = 'sms';
    $testObj->id = '123456789';
    return $testObj;*/
    
    if ($ageWillSend == 0) {
        return sendOneMess($type, $adress, $sender, $body);
    }
    elseif ($ageWillSend > 0) {
            $strAge = GetDateTimeFormat($ageWillSend);
            return sendOneMessSchedule($type, $adress, $sender, $body, $strAge);
        }
}

function SendMessageCascade($adress, $body, $ageWillSend) {
    /*$testObj = new Base();
    $testObj->status = 1;
    $testObj->type = 'sms';
    $testObj->id = '123456789';
    return $testObj;*/

    if ($ageWillSend == 0) {
        $cascade = GetCascadeData($adress, $body);
        return sendCascade($cascade);
    }
    elseif ($ageWillSend > 0) {
            $strAge = GetDateTimeFormat($ageWillSend);
            return sendCascade(GetCascadeScheduleData($adress, $body, $strAge));
        }
}

function GetDateTimeFormat($age) {
    $year = substr($age, 0, 4);
    $month = substr($age, 4, 2);
    $day = substr($age, 6, 2);
    $hour = substr($age, 8, 2);
    $minute = substr($age, 10, 2);
    $str = "".$year."-".$month."-".$day."T".$hour.":".$minute.":00.000Z";
    return $str;
}

function GetCascadeData($receiver, $text) {
    global $senderWhatsApp, $senderVider, $senderVK, $senderSMS;
    return array(
        "type"       => 'vk',
        "recipient"  => clear_phone($receiver),
        "payload"    => array(
            "sender" => $senderVK,
            "text"   => $text,
        ),
        "fallbacks"  => [
            array(
                "type"       => 'whatsapp',
                "payload"    => array(
                    "sender" => $senderWhatsApp,
                    "text"   => $text
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
                "type"       => 'viber',
                "payload"    => array(
                    "sender" => $senderVider,
                    "text"   => $text,
                    "image"  => "",
                    "button" => array(
                        "text" => "",
                        "url"  => '',
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
                    "sender" => $senderSMS,
                    "text"   => $text
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
    
}

function GetCascadeScheduleData($receiver, $sender, $text, $schedule) {
    global $senderWhatsApp, $senderVider, $senderVK, $senderSMS;
    return array(
        "type"       => 'vk',
        "recipient"  => clear_phone($receiver),
        "payload"    => array(
            "sender" => $senderVK,
            "text"   => $text,
        ),
        "fallbacks"  => [
            array(
                "type"       => 'whatsapp',
                "payload"    => array(
                    "sender" => $senderWhatsApp,
                    "text"   => $text
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
                "type"       => 'viber',
                "payload"    => array(
                    "sender" => $senderVider,
                    "text"   => $text,
                    "image"  => "",
                    "button" => array(
                        "text" => "",
                        "url"  => '',
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
                    "sender" => $senderSMS,
                    "text"   => $text
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
    
}

?>