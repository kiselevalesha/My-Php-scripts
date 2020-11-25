<?
    chdir('../../..');
    require_once '../php-scripts/utils/api.php';


    require_once('../php-scripts/db/dbSupportTalks.php');
    $dbSupportTalk = new DBSupportTalk();

    $idSupportTalk = GetInt($json->support);
    if ($idSupportTalk > 0) {
        $idDB = $dbSupportTalk->GetIntField("idDB","id=".$idSupportTalk);
    }
    

    $idAppointment = 0;
    $strAppointment = GetCleanString($json->appointment);
    if (!empty($strAppointment)) {
        require_once('../php-scripts/db/dbCodeAppointments.php');
        
        $codeAppointment = new CodeAppointment();
        $idCodeAppointment = $codeAppointment->GetIdByCode($strAppointment);
        
        if ($idCodeAppointment > 0) {
            $dbCodeAppointment = new DBCodeAppointment();
            $idAppointment = $dbCodeAppointment->GetIntField("idAppointment", "id=".$idCodeAppointment);
        }
    }



    $sideA = $json->sides[0];
    if (empty($sideA))   ExitError(101, "Side1 not defined!");
    $sender = GetCleanString($sideA->id);
    $essentialSender = GetInt($sideA->type);
    if (empty($essentialSender))   ExitError(101, "Side1 not defined!");

    $sideB = $json->sides[1];
    if (empty($sideB))    ExitError(102, "Side2 not defined!");
    $receiver = GetCleanString($sideB->id);
    $essentialReceiver = GetInt($sideB->type);
    if (empty($essentialReceiver))    ExitError(102, "Side2 not defined!");


    //  Проверить существует ли таблица Talks
    require_once('../php-scripts/db/dbTalks.php');
    $dbTalk = new DBTalk($idDB);

    $idTalk = GetInt($json->talk);
    if ($idTalk < 1)
        $idTalk = $dbTalk->CreateUpdateIdTalk($essentialSender, $sender, $essentialReceiver, $receiver);
    $talk = $dbTalk->Get($idTalk);



    $jsonMessage = $json->message;
    if (!empty($jsonMessage)) {
        
        
        require_once('../php-scripts/db/dbMessages.php');
        $dbMessage = new DBMessage($idDB);

        $idMessage = GetInt($jsonMessage->id);
        if ($idMessage < 0) {
            if (strlen($strToken) == 0)     ExitError(104, "User not defined!");
            $strMessage = GetCleanString($jsonMessage->body);
            if (strlen($strMessage) == 0)   ExitError(103, "Message is empty!");
            $idChannel = GetInt($jsonMessage->channel->id);
            $strAdress = GetCleanString($jsonMessage->channel->adress);
            $ageWill = GetInt($jsonMessage->age->will);
            
            $message = new Message();
            $message->idTalk = $idTalk;
            $message->idAppointment = $idAppointment;
        }
        elseif ($idMessage > 0) {
            $message = $dbMessage->Get($idMessage);
        }
    
        if ($message instanceof Message) {
            $message->strBody = $strMessage;
            $message->strUidUser = $strToken;
            $message->idEssential = $essentialSender;
            $message->idTypeChannel = $idChannel;
            $message->strAdress = $strAdress;
            $message->idTypeContent = EnumTypeContents::TypeContentText;
            if ($message->idTypeChannel == EnumTypeChannels::TypeChannelChat) {
                if ($ageWill > 0)   $message->ageWillSend = $ageWill;
                else                $message->ageWillSend = $dbMessage->NowLong();
                $message->ageWasSended = $message->ageWillSend;
            }
            else {
                $message->ageWillSend = $ageWill;
            }
            $dbMessage->Save($message);
            
            if ($idMessage < 1)    $talk->intCountMessages++;
            $dbTalk->Save($talk);
        }
    

        
        
        //  Если это обращение в службу техподдержки, отошлём себе письмо
        if ($idMessage < 0) {
            require_once('../php-scripts/models/essential.php');
            if ($essentialReceiver == EnumEssential::SUPPORT) {
                
                //  Если это не ответ от техподдержки
                $idSupportTalk = $dbSupportTalk->SaveUpdate($idDB, $talk->id, $essentialSender);
            
    
                require_once '../php-scripts/utils/utils.php';
                $to = 'beautymastersapp@gmail.com';
                $subject = 'В техподдержку от '.$strToken;
                $body = '<div>Токен: <b>'.$strToken.'</b> idDB: <b>'.$idDB.'</b><br><br>'.$strMessage.
                '<br><br><a href="https://записи.онлайн/board/editToken.php?talk='.$idSupportTalk.'&token='.$strToken.'">Перейти в чат</a><br>'.'</div>';
                SendUniversalEmail($to, $subject, $body);
            }
        }

    }


    
    $strJsonUser = '"user":"'.$strToken.'","talk":'.$idTalk.',"support":'.$idSupportTalk;
    $srJsonMessages = ',"messages":['.$dbMessage->GetJsonMessages($idTalk, $idAppointment).']';

    echo GetOutJson($strJsonUser.$srJsonMessages);
?>
