<?
    require_once('../php-scripts/models/subscription.php');

    //  Проверяем на включение подписки и её оплаты (положительного баланса)
    function checkSubscriptionAndBalance($idService, $idDB) {
        global $dbTokenEmployee;
        require_once('../php-scripts/db/dbSubscriptionStates.php');
        $dbSubscriptionState = new DBSubscriptionState($idDB);
        $state = $dbSubscriptionState->GetIntField("idState", "idService=".$idService);
        if ($state == 1) {
            require_once('../php-scripts/db/dbTokenEmployee.php');
            $dbTokenEmployee = new DBTokenEmployee($idDB);
            $idToken = $dbTokenEmployee->GetIdField("idMainDB=".$idDB);
            
            $summaPayments = $dbTokenEmployee->GetIntField("summaTotalPayments", "id=".$idToken);
            $summaWastes = $dbTokenEmployee->GetIntField("summaTotalWastes", "id=".$idToken);
            $balance = $summaPayments - $summaWastes;
            if ($balance > 0) {
                return true;
            }
        }
        return false;
    }

?>