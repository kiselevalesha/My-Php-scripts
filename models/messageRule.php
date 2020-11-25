<?
include_once('../php-scripts/models/message.php');

//  Подготовленные отчёты для отсылки вместе с медийными сообщениями
abstract class EnumPreGeneratedReports {
    const TypeCreateTalon = 1;    //  Талон о записи сотруднику
    const TypeSalaryDay = 3;        //  Отчёт о рассчитанной зарплате за день
    const TypeSalaryMonth = 4;
    const TypeTotalDay = 5;         //  Отчёт об итогах за день
    const TypeTotalMonth = 6;
    const TypeCancelAppointment = 7;   //  Отмена Записи.  Нужно для идентификации правила создания сообщений
    const TypeCreateReview = 9;
    //  ... и ещё какие-то могут быть добавлены
}

abstract class EnumDateTypes {
    const TypeDateBirthDay = 1;
    const TypeDateNextAppointment = 2;
    const TypeDatePrevVisit = 3;
    const TypeDateCreateAppointment = 4;
    const TypeDateBurnOutBonus = 5;
    const TypeDateStartAction = 6;
    const TypeDateEndAction = 7;
    const TypeDateCustom = 8;
    const TypeDateNow = 9;
}

abstract class EnumTimeTypes {
    const TypeTimeMorning = 1;
    const TypeTimeAfternoon = 2;
    const TypeTimeEvening = 3;
    const TypeTimeNight = 4;
    const TypeTimeArrivalLastVisit = 5;
    const TypeTimeDepartureLastVisit = 6;
    const TypeTimeArrivalNextVisit = 7;
    const TypeTimeDepartureNextVisit = 8;
    const TypeTimeCreateAppointment = 9;
    const TypeTimeStartWorkDay = 10;
    const TypeTimeEndWorkDay = 11;
    const TypeTimeCustom = 12;
    const TypeTimeNow = 13;
}

abstract class EnumRepeatTypes {
    const TypeRepeatOneTime = 1;
    const TypeRepeatEveryHour = 2;
    const TypeRepeatEveryDay = 3;
    const TypeRepeatEveryWorkDay = 4;
    const TypeRepeatEveryWeek = 5;
    const TypeRepeatEveryMonth = 6;
    const TypeRepeatEverySeason = 7;
    const TypeRepeatEveryHalfYear = 8;
    const TypeRepeatEveryYear = 9;
    const TypeRepeatCustom = 10;
}

class MessageRule extends Base
{
    public $strName = '';
    public $strDescription = '';
    public $strBody = '';

    public $isApproved = 0;         //  Одобрено ли правило для создания и рассылки сообщений
    public $idTypeRecepient = 1;
    public $idTypeMessage = EnumTypeMessage::TypeMessageText;
    public $idTypeChannel = EnumTypeChannels::TypeChannelNone;
    public $idTypeContent = EnumTypeContents::TypeContentNone;
    
    public $idTypeDate = EnumDateTypes::TypeDateNextAppointment;
    public $ageCustom = 0;
    public $idTypeTime = EnumTimeTypes::TypeTimeMorning;
    public $intTimeCustom = 0;
    public $intHoursShift = 0;      //  Смещение в часах от расчитанного времени. Может быть с минусом - это значит, что смещается назад.
    public $idTypeDelivery = 1;
    public $idTypeRepeat = EnumRepeatTypes::TypeRepeatOneTime;
    public $intRepeatCustom = 0;
    
    public $idCategoryClients = 0;
    public $idCategoryEmployee = 0;
    public $idCategoryProducts = 0;
    public $idCategoryServices = 0;
    public $idCategoryPlaces = 0;
    
    public $intRateByMaster = 0;
    public $intRateByClient = 0;
    
    public $idReport = 0;
    public $isHidden = 0;
    public $isNew = 1;
    public $isUse = 1;
    

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"name":"'.$this->strName.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"body":"'.$this->strBody.'",'
            
            .'"isApproved":'.$this->isApproved.','
            .'"typeMessage":'.$this->idTypeMessage.','
            .'"channel":'.$this->idTypeChannel.','
            .'"content":'.$this->idTypeContent.','

            .'"typeRecepient":'.$this->idTypeRecepient.','
            .'"typeDate":'.$this->idTypeDate.','
            .'"ageCustom":'.$this->ageCustom.','
            .'"typeTime":'.$this->idTypeTime.','
            .'"timeCustom":'.$this->intTimeCustom.','
            .'"timeShift":'.(0+$this->intTimeShift).','
            .'"typeDelivery":'.$this->idTypeDelivery.','
            .'"typeRepeat":'.$this->idTypeRepeat.','
            .'"repeatCustom":'.$this->intRepeatCustom.','
            
            .'"rateByMaster":'.$this->intRateByMaster.','
            .'"rateByClient":'.$this->intRateByClient.','

            .'"idReport":'.$this->idReport.','
            .'"isDeleted":'.$this->isDeleted.','
            .'"isUse":'.$this->isUse;
    }
    
    
    public function ToMessage() {
        include_once('../php-scripts/models/message.php');
        $message = new Message();
        $message->strBody = $this->strBody;
        $message->idMessageRule = $this->id;
        $message->isHidden = $this->isHidden;
        $message->idTypeMessage = $this->idTypeMessage;
        $message->isApproved = $this->isApproved;
        $message->idTypeContent = $this->idTypeContent;
        if ($this->idTypeContent == EnumTypeContents::TypeContentHTML)
            $message->idTypeChannel = EnumTypeChannels::TypeChannelEmail;
        else
            $message->idTypeChannel = $this->idTypeChannel;
        return $message;
    }

}

?>