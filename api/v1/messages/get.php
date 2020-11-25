<?
    chdir('../../..');
    require_once '../php-scripts/utils/api.php';


    $idSupportTalk = GetInt($json->support);
    if ($idSupportTalk > 0) {
        require_once('../php-scripts/db/dbSupportTalks.php');
        $dbSupportTalk = new DBSupportTalk();
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
        $idTalk = $dbTalk->GetIdTalk($essentialSender, $sender, $essentialReceiver, $receiver);
    if ($idTalk < 0)    $idTalk = 0;



    require_once('../php-scripts/db/dbMessages.php');
    $dbMessage = new DBMessage($idDB);

    $idMessage = GetInt($json->message->id);
    if ($idMessage == 0) {
        $srJsonMessages = ',"messages":['.$dbMessage->GetJsonMessages($idTalk, $idAppointment).']';
    }
    elseif ($idMessage > 0) {
        $message = $dbMessage->Get($idMessage);
        $srJsonMessages = ',"messages":[{'.$message->MakeJsonBody().'}]';
    }
    
    
    $strJsonUser = '"user":"'.$strToken.'","talk":'.$idTalk.',"support":'.$idSupportTalk;

    echo GetOutJson($strJsonUser.$srJsonMessages);
?>
