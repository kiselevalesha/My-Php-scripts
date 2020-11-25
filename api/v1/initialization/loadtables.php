<?
    //  Инициализациия некоторых таблиц новосозданной Базы данных

    //  Надо инициировать некоторые данные
    $isInitializationed = $dbTokenEmployee->GetIntField("isInitializationed", "id=".$idToken);
    if ($isInitializationed == 0) {

        //  Выдаём бонус
        require_once('../php-scripts/db/dbSubscriptionPayments.php');
        $dbSubscriptionPayment = new DBSubscriptionPayment($idDB);
        if ($dbSubscriptionPayment->GetCountRows("") == 0) {
            $summa = $dbSubscriptionPayment->AddGift();

            $summaTotalPayments = $dbTokenEmployee->GetIntField("summaTotalPayments", "id=".$idToken) + $summa;
            $dbTokenEmployee->UpdateField("summaTotalPayments", $summaTotalPayments, "id=".$idToken);
        }


        //  Устанавливаем подписки
        require_once('../php-scripts/db/dbSubscriptionStates.php');
        $dbSubscriptionState = new DBSubscriptionState($idDB);
    
        $idEmployee = 1;
        if ($dbSubscriptionState->GetCountRows("") == 0) {
            
            require_once('../php-scripts/db/dbSubscriptionChanges.php');
            $dbSubscriptionChange = new DBSubscriptionChange($idDB);
            $idState = 1;
            
            require_once('../php-scripts/models/subscription.php');
            
            $idService = EnumTypeServices::ONLINEAPPOINTMENTS;
            $dbSubscriptionChange->AddChange($idService, $idEmployee, $idState);
            $dbSubscriptionState->UpdateState($idService, $idEmployee, $idState);
        
            $idService = EnumTypeServices::CLIENTBASE;
            $dbSubscriptionChange->AddChange($idService, $idEmployee, $idState);
            $dbSubscriptionState->UpdateState($idService, $idEmployee, $idState);
        
            $idService = EnumTypeServices::PHOTOHOSTING;
            $dbSubscriptionChange->AddChange($idService, $idEmployee, $idState);
            $dbSubscriptionState->UpdateState($idService, $idEmployee, $idState);
        
            /*
            $idService = EnumTypeServices::FINANCIALANALYTICS;
            $dbSubscriptionChange->AddChange($idService, $idEmployee, $idState);
            $dbSubscriptionState->UpdateState($idService, $idEmployee, $idState);
            
            $idService = EnumTypeServices::VENDORS;
            $dbSubscriptionChange->AddChange($idService, $idEmployee, $idState);
            $dbSubscriptionState->UpdateState($idService, $idEmployee, $idState);
            
            $idService = 6;EnumTypeServices::MARKETING;
            $dbSubscriptionChange->AddChange($idService, $idEmployee, $idState);
            $dbSubscriptionState->UpdateState($idService, $idEmployee, $idState);
        
            $idService = EnumTypeServices::SALARYCALCULATION;
            $dbSubscriptionChange->AddChange($idService, $idEmployee, $idState);
            $dbSubscriptionState->UpdateState($idService, $idEmployee, $idState);
            */
        
            $idService = EnumTypeServices::BACKUP;
            $dbSubscriptionChange->AddChange($idService, $idEmployee, $idState);
            $dbSubscriptionState->UpdateState($idService, $idEmployee, $idState);
        
            $idService = EnumTypeServices::ANALYTICS;
            $dbSubscriptionChange->AddChange($idService, $idEmployee, $idState);
            $dbSubscriptionState->UpdateState($idService, $idEmployee, $idState);
        
            $idService = EnumTypeServices::MESSAGESENDING;
            $dbSubscriptionChange->AddChange($idService, $idEmployee, $idState);
            $dbSubscriptionState->UpdateState($idService, $idEmployee, $idState);
        
            $idService = EnumTypeServices::VOICEROBOT;
            $dbSubscriptionChange->AddChange($idService, $idEmployee, $idState);
            $dbSubscriptionState->UpdateState($idService, $idEmployee, $idState);
        }


        //  Начисляем оплату за этот день. (по выданным подпискам)
        
        $year = $_GET['year'];
        if (empty($year))     $year = date("Y");
        $month = $_GET['month'];
        if (empty($month))     $month = date("n");
        $day = $_GET['day'];
        if (empty($day))     $day = date("d");
        
        require_once '../xn--80anea7an.xn--80asehdb/api/v1/cron/subscriptions/calcForOne.php';
        $token = $dbTokenEmployee->Get($idToken);
        CalcCostSubscriptionsForOneToken($year, $month, $day, $token);

        
                
        //  Загружаем правила формирования сообщений
        require_once('../php-scripts/db/dbMessageRules.php');
        $dbMessageRule = new DBMessageRule($idDB);
        if ($dbMessageRule->GetCountRows("") == 0) {
            $dbMessageRule->AddPrepareRules();
        }
        
        $dbTokenEmployee->UpdateField("isInitializationed", 1, "id=".$idToken);
    }

?>