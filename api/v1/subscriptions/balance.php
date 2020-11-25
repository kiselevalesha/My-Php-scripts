<?
    require_once('../php-scripts/db/dbMessages.php');
    require_once('../php-scripts/db/dbSubscriptionWaste.php');
    require_once('../php-scripts/db/dbSubscriptionPayments.php');


//  Получение текущего баланса с учётом выданных бонусов
function GetJsonBalance($idDB) {
    global $dbTokenEmployee;
    $dbSubscriptionWaste = new DBSubscriptionWaste($idDB);

    $ageDay = $year = date("Y") * 10000 + date("n") * 100 + date("d");
    $summaTotalTodayWastes = $dbSubscriptionWaste->GetWasteForDay($ageDay);
    
    /// Рассчитаем суммы потраченные на отправку сообщений
    $summaTotalWasteMessages = GetTotalMessageWastes($idDB);

    $summaTotalPayments = $dbTokenEmployee->GetIntField("summaTotalPayments", "id=".$idDB);
    $summaTotalOldWastes = $dbTokenEmployee->GetIntField("summaTotalWastes", "id=".$idDB) - ($summaTotalTodayWastes + $summaTotalWasteMessages);

    return '"balance":{"payments":'.$summaTotalPayments.',"wastes":{"old":'.$summaTotalOldWastes.',"today":'.$summaTotalTodayWastes.'}}';
}

//  Получение текущего баланса с учётом выданных бонусов, т.е. только тех денег, которые были заплачены (плюс 10% от сервиса)
function GetPayedBalance($idDB) {
    $summaTotalWasteMessages = GetTotalMessageWastes($idDB);
    $summaTotalTodayWastes = GetTotalServiceWastes($idDB);
    $summaTotalTodayPayments = GetTotalRealPayments($idDB);
    return ($summaTotalTodayPayments - ($summaTotalTodayWastes + $summaTotalWasteMessages));
}

function GetTotalRealPayments($idDB) {
    $dbSubscriptionPayment = new DBSubscriptionPayment($idDB);
    return $dbSubscriptionPayment->GetTotalRealPayments();
}
function GetTotalMessageWastes($idDB) {
    $dbMessage = new DBMessage($idDB);
    return $dbMessage->GetTotalWastes();
}
function GetTotalServiceWastes($idDB) {
    $dbSubscriptionWaste = new DBSubscriptionWaste($idDB);
    return $dbSubscriptionWaste->GetTotalWastes();
}

?>