<?
include_once('../php-scripts/models/base.php');

abstract class EnumTypeStates {
    const StateON = 1;
    const StateOFF = 2;
}

class SubscriptionState extends Base
{
    public $idService = 0;
    public $idEmployee = 0;
    public $idState = 0;
}

?>