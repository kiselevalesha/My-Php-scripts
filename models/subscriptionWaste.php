<?
include_once('../php-scripts/models/base.php');

class SubscriptionWaste extends Base
{
    public $idService = 0;      //  id сервиса на оплату которого записана плата за сутки
    public $idEmployee = 0;     //  Хочу сделать, чтобы оплата была и по каждому пользующемся сервисом. Но до конца ещё не продумано и не сделано...
    public $idMessage = 0;      //  Деньги списываются по дням на оплату подключённых сервисов и на оплату отправленных сообщений. Это id отправленного платного сообщения.
    public $cost = 0;
    public $ageDay = 0;

    function MakeJson() {
        return '"service":'.$this->idService./*',"employee":'.$this->idEmployee.*/
            ',"cost":'.$this->cost.',"age":'.$this->ageDay;
    }

    
}

?>