<?
include_once('../php-scripts/models/base.php');

class ReservationTime extends Base
{
    public $idSalon = 0;
    public $idEssentialOwner = 0;
    public $idOwner = 0;
    public $idType = 0;
    public $idColor = 0;
    public $idTypeReason = 0;
    public $idReservationTimeTemplate = 0;
    public $dateTimeDay = 0;
    public $intTimeStart = 0;
    public $intTimeEnd = 0;
    public $intMinutesDuration = 0;
    public $strDescription = '';
    public $idNeedSaveInCalendar = 0;
    public $intMinutesRemind = 0;
    public $idEventCalendar = 0;


    public function MakeJson() {
        return '"id":'.$this->id
            .',"salon":'.$this->idSalon
            .',"essential":'.$this->idEssentialOwner
            .',"owner":'.$this->idOwner
            //.'"type":"'.$this->idType.'"'
            .',"color":'.$this->idColor
            //.'"reason":"'.$this->idTypeReason.'",'
            .',"template":'.$this->idReservationTimeTemplate
            .',"age":'.$this->dateTimeDay
            .',"start":'.$this->intTimeStart
            .',"end":'.$this->intTimeEnd
            .',"duration":'.$this->intMinutesDuration
            .',"description":"'.$this->strDescription.'"';
            //.'"needSaveInCalendar":"'.$this->idNeedSaveInCalendar.'",'
            //.'"remind":"'.$this->intMinutesRemind.'",'
            //.'"eventCalendar":"'.$this->idEventCalendar.'"';
    }
}
?>
