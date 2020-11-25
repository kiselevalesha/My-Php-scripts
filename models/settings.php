<?
include_once('../php-scripts/models/base.php');

abstract class EnumTypeTematics {
    const BEAUTY = 1;
    const VETERINARY = 2;
    const MEDICINE = 3;
    const TEACHING = 4;
    const PUBLIC = 5;
    const CHILDREN = 6;
    const AUTOREPAIR = 7;
    const PSYHOLOGY = 8;
}

abstract class EnumTypeConfiguration {
    const SIMPLE = 1;
    const EXTENDED = 2;
}

abstract class EnumTypeFunctionality {
    const MASTER = 1;
    const ADMINISTRATOR = 2;
    const MANAGER = 3;
}

class Settings extends Base
{
    public $intMaxCountMasters = 1;     //  Максимальное количество мастеров в Записи клиента. Это влияет на количество полей в таблице Appointments
    public $intMaxCountAssistents = 1;  //  Максимальное количество ассистентов в Записи клиента. Это влияет на количество полей в таблице Appointments

    public $isShowTips = 0;
    public $isUseAudio = 0;

    public $isUseOnlineAppointment = 1; //  Использовать ли все Онлайн-записи ?
    public $isChoosePlace = 0;
    public $isChooseMasters = 0;
    public $isChooseResources = 0;
    //public $isShowAdress = 1;           //  Показывать ли в онлайн-записи адресс
    //public $isGenerateQRCode = 1;       //  Показывать ли в онлайн-записи qr-код. (Он тоже показывается по окончании онлайн-записи). Правда пока никак не используется.

    public $idTypeTematic = EnumTypeTematics::BEAUTY;
    public $idTypeConfiguration = 1;
    public $idTypeFunctionality = 1;

    public $intTimeStart = 900;         //  Время начала рабочего дня по умолчанию. Если оно не задано в графике на день (если не задано на весь месяц)
    public $intTimeEnd = 2100;          //  Время окончания рабочего дня по умолчанию. Если оно не задано в графике на день (если не задано на весь месяц)
    
    public $intCountDaysForAppointments = 7;    //  За сколько дней показывать записи в списке записей
    
    public $intMinutesWaiting = 0;      //  Время ожидания подтверждения от мастера //   2 часа = 120 
    public $intPeriodMinutes = 30;      //  Период для записей
    public $intBetweenMinutes = 0;      //  Количество минут перерыва между записями
    public $intBeforeMinutes = 60;      //  Количество минут за сколько ближайше можно записаться. 
    
    
    public $ageLastShowAppointments = 0;
    public $ageLastShowReviews = 0;
    public $ageLastShowSupport = 0;
    public $ageLastShowClients = 0;
    public $ageLastShowVendors = 0;
    public $ageLastShowEmployee = 0;

    
    public function MakeJson() {
        return '"intMaxCountMasters":'.$this->intMaxCountMasters.','
            .'"intMaxCountAssistents":'.$this->intMaxCountAssistents.','
            .'"isUseOnlineAppointment":'.$this->isUseOnlineAppointment.','
            //.'"isShowAdress":'.$this->isShowAdress.','
            //.'"isGenerateQRCode":'.$this->isGenerateQRCode.','
            .'"isShowTips":'.$this->isShowTips.','
            .'"isUseAudio":'.$this->isUseAudio.','
            .'"typeConfiguration":'.$this->idTypeConfiguration.','
            .'"typeFunctionality":'.$this->idTypeFunctionality.','
            .'"timeStart":'.$this->intTimeStart.','
            .'"timeEnd":'.$this->intTimeEnd.','
            .'"isChoosePlace":'.$this->isChoosePlace.','
            .'"isChooseMasters":'.$this->isChooseMasters.','
            .'"isChooseResources":'.$this->isChooseResources.','
            .'"countDaysForAppointments":'.$this->intCountDaysForAppointments.','
            .'"waiting":'.$this->intMinutesWaiting.','
            .'"period":'.$this->intPeriodMinutes.','
            .'"between":'.$this->intBetweenMinutes.','
            .'"before":'.$this->intBeforeMinutes;
    }
    
    public function MakeJsonForAppointments() {
        return '"period":'.$this->intPeriodMinutes
            .',"between":'.$this->intBetweenMinutes
            .',"before":'.$this->intBeforeMinutes
            .',"showDays":'.$this->intCountDaysForAppointments
            .',"start":'.$this->intTimeStart
            .',"end":'.$this->intTimeEnd;
    }
    
}

?>