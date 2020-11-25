<?
include_once('../php-scripts/models/base.php');

abstract class EnumTypePayments {
    const TypeStartGift = 1;
    const TypeStartManual = 2;  //  Выдано вручную
    const TypeYandexMoney = 3;
    const TypeVKMoney = 4;
    //const Type... = ;
}

class SubscriptionPayment extends Base
{
    public $agePayment = 0;
    public $idTypePayment = 0;      //  Через какую систему платили. Например, Яндекс-деньги
    public $summaPayment = 0;
    public $summaBonus = 0;
    
    public $strDescription = '';
}

?>