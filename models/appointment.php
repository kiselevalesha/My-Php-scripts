<?
include_once('../php-scripts/models/base.php');

abstract class EnumTypeToolCreator {
    const SITE_ZAPISHIS_ONLINE = 1;
    const SITE_ZAPISI_ONLINE = 2;
    const APP_ANDROID_CLIENTS_APPOINTMENTS = 3;
}

abstract class EnumTypeConfirmed {
    const NOT_CONFIRMED = 1;        //  Запись не подтверждена
    const CONFIRMED_BY_PHONE = 2;   //  Запись подтверждена по телефону
    const CONFIRMED_ONLINE = 3;     //  Запись подтверждена онлайн
    const CANCEL_BY_PHONE = 4;      //  Запись отменена по телефону
    const CANCEL_ONLINE = 5;        //  Запись отменена онлайн
}

abstract class EnumTypeStatus {
    const WAITING_CLIENT = 1;       //  Ожидание прихода клиента
    const CLIENT_LATE = 2;          //  Клиент опаздывает
    const CLIENT_NOT_ARRIVE = 3;    //  Клиент не пришёл
    const CLIENT_WAITING = 4;       //  Клиент ожидает обслуживания
    const WORK_IN_PROGRESS = 5;     //  Происходит работа с клиентом - выполняется заказ
    const FINISHED = 6;             //  Работа закончена
    const CANCELED = 7;             //  Запись отменена
}

class Appointment extends Base
{
    /*public $client = new Item();
    public $salon = new Item();
    public $department = new Item();
    public $place = new Item();
    public $course = new Item();
    
    public $masters = array();
    public $services = array();
    public $administrators = array();
    public $photos = array();*/
    
    
    public $strTokenAdministratorOrder = "";
    public $intCodeTokenAdministratorOrder = 0;
    public $strTokenAdministratorVisit = "";
    public $intCodeTokenAdministratorVisit = 0;

    public $idClient = 0;
    public $idContact = 0;
    public $idAdress = 0;
    
    public $idSalon = 0;
    public $idDepartment = 0;
    public $idPlace = 0;
    public $idCourse = 0;
    public $idPhoto = 0;

    public $idMaster1 = 0;
    public $summaMaster1 = 0;
    public $idMaster2 = 0;
    public $summaMaster2 = 0;
    public $idMaster3 = 0;
    public $summaMaster3 = 0;
    public $idAssistent1 = 0;
    public $summaAssistent1 = 0;
    public $idAssistent2 = 0;
    public $summaAssistent2 = 0;
    public $idAssistent3 = 0;
    public $summaAssistent3 = 0;
    
    public $idTypeToolCreator = 0;      //  Инструмент, с помощью чего создана запись: сайт такой-то, мобильное приложение
    public $idInstanceToolCreator = 0;  //  Версия этого инструмента (Возможно это может пригодиться, например, для А/Б тестов)
    public $idEssentialCreator = 0;     //  Кто создал запись: Мастер, Клиент, Администратор, Удалённый администратор, Партнёр
    public $idCreator = 0;
    
    public $ageCreated = 0;
    public $ageOrderStart = 0;

    public $costOrder = 0;
    public $isAutoCalcCostOrder = 1;    //  Автоматически рассчитать стоимость записи или оставить возможность ввести её вручную
    public $costVisit = 0;
    public $isAutoCalcCostVisit = 1;
    public $idTotalPayment = 0;
    public $isTotalPaymentZero = 0;
    
    public $idCurrency = 0;
    public $idAutoChoosePricelist = 0;
    public $idPricelist = 0;
    public $idAction = 0;

    public $intMinutesDuration = 0;
    public $isAutoCalculationDuration = 1;
    
    public $flagIncomeOutcome = 0;
    public $idReklama = 0;
    public $idNeedCreateCommunications = 0;
    public $idNeedSendEmail = 0;
    public $idNeedSaveInCalendar = 0;
    public $idEventCalendar = 0;
    public $idForCreateCommunicationBefore = 0;
    public $idForCreateCommunicationAfter = 0;
    
    public $isRemind = 0;
    public $ageRemindWill = 0;
    public $ageRemindWas = 0;
    public $intMinutesRemind = 0;
    public $strTextRemindMessage = '';
    public $idSendNotification = 0;
    
    //  Если заказ создаётся онлайн, его должен подтвердить мастер. Флаг - подтверждён ли мастером ?
    public $ageSendedInfoToMaster = 0;   // время, когда информация о записи выслана мастеру
    public $ageAcceptedByMaster = 0;   //  время подтверждения онлайн-записи мастером

    //  Иногда накануне записи требуется подтверждение от клиента. Флаг - подтверждён ли клиентом ?
    public $ageSendedInfoToClient = 0;   //  время, когда информация о записи выслана клиенту
    public $ageConfirmedByClient = 0;   //  время подтверждения клиентом своего прихода на запись
    public $idTypeConfirmed = 0;

    public $idStatus = 0;       //  EnumTypeStatus::
    public $ageClientCame = 0;
    public $ageWorkStart = 0;
    public $ageWorkEnd = 0;
    
    public $ageReview = 0;      //  ДатаВремя, когда оставлен отзыв клиентом на полученные услуги. Если был оставлен.
    public $intRatingByMaster = 0;
    public $strReviewByMaster = '';
    public $intRatingByClient = 0;
    public $strReviewByClient = '';

    public $strUrlReferer = '';
    public $strBarCode = '';
    public $strDescription = '';
    public $isNew = 1;
    public $isFinished = 0;
    public $longCode = 0;       //  0000-0000-0000-0000  Шестнадцати-циферный код записи

    public $strJsonServices = "";
    //public $strJsonMasters = "";
    //public $strJsonAdress = "";
    //public $strJsonClient = "";


    function GetCodeFormat() {
        include_once('../php-scripts/models/codeAppointment.php');
        $codeAppointment = new CodeAppointment();
        $codeAppointment->longCode = $this->longCode;
        return $codeAppointment->GetCodeFormat();
    }
    

    function MakeJson() {
        return '"code":"'.$this->longCode.'","photo":'.$this->idPhoto.
         ',"status":'.$this->idStatus.',"isFinished":'.$this->isFinished.','.
         '"creator":{"type":'.$this->idEssentialCreator.'},'.
         '"informedByMaster":{"ageSended":'.$this->ageSendedInfoToMaster.',"ageAccepted":'.$this->ageAcceptedByMaster.'},'.
         '"informedByClient":{"ageSended":'.$this->ageSendedInfoToClient.',"ageConfirmed":'.$this->ageConfirmedByClient.',"type":'.$this->idTypeConfirmed.'},'.
         '"duration":{"isAuto":'.$this->isAutoCalculationDuration.',"minutes":'.$this->intMinutesDuration.'},'.
         '"cost":{"isAuto":'.$this->isAutoCalcCostOrder.',"summa":'.$this->costOrder.'},'.
         '"services":['.$this->strJsonServices.'],'.
         '"age":{"created":'.$this->ageCreated.',"changed":'.$this->ageChanged.',"start":'.$this->ageOrderStart.'},'.
         '"administrator":{"order":"'.$this->strTokenAdministratorOrder.'","visit":"'.$this->strTokenAdministratorVisit.'"},'.
         '"rate":'.$this->intRatingByClient.',"review":"'.$this->strReviewByClient.'","description":"'.$this->strDescription.'"';
    }

    function MakeJsonVisit() {
        return '"id":'.$this->id.',"code":"'.$this->longCode.'","photo":'.$this->idPhoto.
         ',"status":{"id":'.$this->idStatus.',"name":"","description":""}'.
         ',"confirmed":{"id":'.$this->idTypeConfirmed.',"name":"","description":""}'.
         ',"isFinished":'.$this->isFinished.
         ',"informedByClient":{"ageSended":'.$this->ageSendedInfoToClient.',"ageConfirmed":'.$this->ageConfirmedByClient.'},'.
         '"rate":{"stars":'.$this->intRatingByMaster.',"description":"'.$this->strReviewByMaster.'"},'.
         '"remind":{"isSend":'.$this->isRemind.',"age":'.$this->ageRemindWill.',"body":"'.$this->strTextRemindMessage.'"},'.
         '"age":{"start":'.$this->ageOrderStart.',"clientCome":'.$this->ageClientCame.',"workStart":'.$this->ageWorkStart.',"workEnd":'.$this->ageWorkEnd.'},'.
         '"description":"'.$this->strDescription.'"';
    }

    function MakeJsonReview() {
        return '"code":"'.$this->longCode.'","status":'.$this->idStatus.',"isFinished":'.$this->isFinished.','.
         '"rate":{"client":{"stars":'.$this->intRatingByClient.',"description":"'.$this->strReviewByClient.'"},'.
         '"master":{"stars":'.$this->intRatingByMaster.',"description":"'.$this->strReviewByMaster.'"}},'.
         '"age":{"start":'.$this->ageOrderStart.',"review":'.$this->ageReview.'}';
    }

}

?>