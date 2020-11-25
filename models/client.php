<?
include_once('../php-scripts/models/user.php');

class Client extends User
{
    public $intPeriodDays = 0;      //  Период дней между посещениями
    public $isAutoCalcPeriod = 0;   //  Автоматически рассчитать такой период

    public $idReklama = 0;          //  Из какого рекламного канала пришёл клиент
    
    public $ageCreated = 0;
    public $ageFirstVisit = 0;
    public $ageLastVisit = 0;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"surname":"'.$this->strSurName.'",'
            .'"name":"'.$this->strName.'",'
            .'"patronymic":"'.$this->strPatronymic.'",'
            .'"alias":"'.$this->strAlias.'",'
            .'"born":'.$this->dateBorn.','
            .'"sex":'.$this->idSex.','
            .'"description":"'.$this->strDescription.'",'
            .'"ageCreated":'.$this->ageCreated.','
            //.'"ageFirstVisit":'.$this->ageFirstVisit.','
            //.'"ageLastVisit":'.$this->ageLastVisit.','
            .'"isDeleted":'.$this->isDeleted.','
            .'"essential":'.EnumEssential::CLIENTS.','
            .'"isUse":'.$this->isUse;
    }
}
?>