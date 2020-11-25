<?
include_once('../php-scripts/models/base.php');

class TokenUser extends Base
{
    public $strToken = "";          //  Постоянный токен, выдавамый раз и навсегда.
    public $intCodeToken = 0;

    public $strTokenTemp = "";      //  Временный токен, выдаваемый лишь на время. Обновляемый
    public $intCodeTokenTemp = 0;
    public $ageTempTokenAlive = 0;  //  age, до которого действителен временный токен

    public $idMainDB = 0;          //  Ссылка на собственную/основную базу данных для юзера

    public $strFirebase = "";
    public $intCodeFirebase = 0;

    public $strLogin = "";
    public $intCodeLogin = 0;

    public $strPassword = "";
    public $intCodePassword = 0;

    //  Пересчитываются каждые сутки
    public $summaTotalPayments = 0;  //  Общая сумма всех платежей на текущий день
    public $summaTotalWastes = 0;    //  Общая сумма всех расходов на текущий день

    public $isTokenActive = 1;
    public $isTokenAutoCreate = 0;  //  Флаг, показывающий, что токен(юзер) был создан предварительно вручную. Нужно отслеживать, что он перешёл по ссылке - вошёл в сервис
    public $isInitializationed = 0; //  Используется при инициализации начальных таблиц db.
    public $isUrlInitializationed = 0; //  Используется для установки токена при переходе по предсгенерированной ссылке
    
    public $ageCreated = 0;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"strToken":"'.$this->strToken.'",'
            .'"intCodeToken":'.$this->intCodeToken.','

            .'"isInit":'.$this->isInitializationed.','
            .'"isUrlInit":'.$this->isUrlInitializationed.','
            
            .'"payments":'.$this->summaTotalPayments.','
            .'"wastes":'.$this->summaTotalWastes.','

            .'"isDeleted":'.$this->isDeleted.','
            .'"created":"'.$this->ageCreated.'"';
    }

}

?>