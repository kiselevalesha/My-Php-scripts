<?
include_once('../php-scripts/models/base.php');

class UrlAppointment extends Base
{
    public $idDB = 0;
    public $idSalon = 0;                //  Если салон указан, то выбор из списка салонов не показывается
    public $idDepartment = 0;           //  Если отдел указан, то выбор отделов не показывается
    public $idEmployee = 0;             //  Если конкретный мастер указан, то выбор из списка мастеров не показывается
    public $isCanChangeGivenParameters = 1; //  Можно ли или нельзя изменить заданные параметры idSalon (idDepartment),idEmployee
    
    public $strUrlNamed = "";           //  Ссылка на онлайн-запись по-русски
    public $intCodeUrl = 0;             //  Hash-код для strUrlNamed
    public $strUrlDigital = "";         //  Ссылка на онлайн-запись в цифровом виде (на английском) (позволяет указывать параметры)

    public $isShowAdress = 0;           //  Показывать ли в онлайн-записи адресс
    public $isGenerateQRCode = 1;       //  Показывать ли в онлайн-записи qr-код. (Он тоже показывается по окончании онлайн-записи). Правда пока никак не используется.
    public $isUseAudio = 1;             //  Использовать ли при онлайн-записи генерацию речи

    public $isRequireAccepted = 0;      //  Требовать подтверждения онлайн-записи от мастера/администратора
    public $intMinutesWaiting = 0;      //  Ограничение времени ожидания подтверждения от мастера. По умолчанию не используем этот функионал.
    
    public $intPeriodMinutes = 30;      //  Период для записей
    public $intBetweenMinutes = 0;      //  Количество минут перерыва между записями
    public $intBeforeMinutes = 120;     //  Количество минут за сколько ближайше можно записаться. 

    public $isCanUseAuthorisation = 1;  //  Использовать ли авторизацию с помощью социальных сетей
    public $isRequirePhone = 1;         //  Требовать ли ввода номера телефона
    public $isRequireEmail = 0;         //  Требовать ли ввода email
    public $isRequireName = 0;          //  Требовать ли ввода имени
    public $isShowCommentField = 0;     //  Показывать ли при записи поле ввода комментария
    
    public $isUseOneTotalTime = 0;      //  Использовать единое время для всех записей, независимо от выбранной услуги/услуг
    public $intTotalTimeMinutes = 0;    //  единое время в минутах

    public $isUse = 1;                  //  Использовать ли Онлайн-запись ?
    public $isSendedNotification = 1;   //  Рассылать ли сообщения по онлайн-записи (вообще все отключаются/включаются)
    public $isForecastOptions = 1;      //  Прогнозировать предпочтения клиента, заоанее выбирая нужные опции.
    public $isShowReminders = 1;        //  Показывать записывающемуся блок установки напоминаний о визите.

    
    public function MakeJson() {
        return '"db":'.$this->idDB.','
            .'"salon":'.$this->idSalon.','
            .'"department":'.$this->idDepartment.','
            .'"employee":'.$this->idEmployee.','
            .'"isCanChange":'.$this->isCanChangeGivenParameters.','
            
            .'"isShowAdress":'.$this->isShowAdress.','
            .'"isGenerateQRCode":'.$this->isGenerateQRCode.','
            .'"isUseAudio":'.$this->isUseAudio.','

            .'"isCanUseAuthorisation":'.$this->isCanUseAuthorisation.','
            .'"isRequirePhone":'.$this->isRequirePhone.','
            .'"isRequireEmail":'.$this->isRequireEmail.','
            .'"isRequireName":'.$this->isRequireName.','
            .'"isShowCommentField":'.$this->isShowCommentField.','
            
            //.'"isUseTotalTime":'.$this->isUseOneTotalTime.','
            .'"totalTime":'.$this->intTotalTimeMinutes.','
            
            //.'"isRequireAccepted":'.$this->isRequireAccepted.','
            .'"wait":'.$this->intMinutesWaiting.','
            
            .'"period":'.$this->intPeriodMinutes.','
            .'"between":'.$this->intBetweenMinutes.','
            .'"before":'.$this->intBeforeMinutes.','

            .'"isSendedNotification":'.$this->isSendedNotification.','
            .'"isForecastOptions":'.$this->isForecastOptions.','
            .'"isShowReminders":'.$this->isShowReminders.','
            
            .'"urlNamed":"'.$this->strUrlNamed.'",'
            .'"urlDigital":"'.$this->strUrlDigital.'",'
            .'"isUse":'.$this->isUse;
    }
    
    public function MakeRussianUrlForAppointment($strName, $strSurname) {
        $strNameR = $strName;
        $strSurnameR = $strSurname;
        if (!empty($strName)) {
            $lastLetterNameRest = "";
            $lastLetterName = mb_strtolower(mb_substr($strName, -1));
            switch($lastLetterName) {
                case "а":
                    $lastLetterNameRest = "е";
                    break;
                case "я":
                    $lastLetterNameRest = "и";
                    break;
                case "й":
                    $lastLetterNameRest = "ю";
                    break;
                case "ь":
                    $lastLetterNameRest = "и";
                    break;
                case "з":
                    $lastLetterNameRest = "зу";
                    break;
                case "г":
                    $lastLetterNameRest = "гу";
                    break;
                case "к":
                    $lastLetterNameRest = "ку";
                    break;
                case "н":
                    $lastLetterNameRest = "ну";
                    break;
                case "м":
                    $lastLetterNameRest = "му";
                    break;
                case "в":
                    $lastLetterNameRest = "ву";
                    break;
                case "п":
                    $lastLetterNameRest = "пу";
                    break;
                case "р":
                    $lastLetterNameRest = "ру";
                    break;
                case "с":
                    $lastLetterNameRest = "су";
                    break;
                case "т":
                    $lastLetterNameRest = "ту";
                    break;
                case "х":
                    $lastLetterNameRest = "ху";
                    break;
            }
            if (!empty($lastLetterNameRest)) $strNameR = mb_substr($strName, 0, mb_strlen($strName) - 1).$lastLetterNameRest;
        }
        
        if (!empty($strSurname)) {
            $lastLetterSurNameRest = "";
            $lastLetterSurName = mb_strtolower(mb_substr($strSurname, -1));
            switch($lastLetterSurName) {
                case "а":
                    $lastLetterSurNameRest = "ой";
                    break;
                case "в":
                    $lastLetterSurNameRest = "ву";
                    break;
                case "н":
                    $lastLetterSurNameRest = "ну";
                    break;

                case "м":
                    $lastLetterSurNameRest = "му";
                    break;
                case "к":
                    $lastLetterSurNameRest = "ку";
                    break;
                case "р":
                    $lastLetterSurNameRest = "ру";
                    break;
                case "п":
                    $lastLetterSurNameRest = "пу";
                    break;
                case "т":
                    $lastLetterSurNameRest = "ту";
                    break;
                case "с":
                    $lastLetterSurNameRest = "су";
                    break;
            }
            
            if (empty($lastLetterSurNameRest)) {
                $lastLetterSurName = mb_strtolower(mb_substr($strSurname, -2));
                switch($lastLetterSurName) {
                    case "ая":
                        $lastLetterSurNameRest = "ой";  //крицкая -> крицкой
                        break;
                    case "ия":
                        $lastLetterSurNameRest = "ии";  //лурия -> лурии
                        break;
                    case "ый":
                        $lastLetterSurNameRest = "ому";  //первый -> первому
                        break;
                    case "ий":
                        $lastLetterSurNameRest = "ому";  //первицкий -> первицкому
                        break;
                }
                if (!empty($lastLetterSurNameRest)) $strSurnameR = mb_substr($strSurname, 0, mb_strlen($strSurname) - 2).$lastLetterSurNameRest;
            }
            else {
                if (!empty($lastLetterSurNameRest)) $strSurnameR = mb_substr($strSurname, 0, mb_strlen($strSurname) - 1).$lastLetterSurNameRest;
            }
        }
        return "к_".$strNameR."_".$strSurnameR;
    }
}

?>