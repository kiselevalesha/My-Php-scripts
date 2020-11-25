<?
include_once('../php-scripts/models/base.php');

abstract class EnumSubscriptionWhat {
    const DAY = 1;
    const SMS = 2;
    const REQUEST = 3;
    const MINUTE = 4;
}

abstract class EnumTypeServices {
    const ONLINEAPPOINTMENTS = 1;
    const CLIENTBASE = 2;
    const PHOTOHOSTING = 3;
    const FINANCIALANALYTICS = 4;
    const VENDORS = 5;
    const MARKETING = 6;
    const ONLINEKASSA = 7;
    const MESSAGESENDING = 8;
    const BOTTELEGRAM = 9;
    const BOTVK = 10;
    const BOTFACEBOOK = 11;
    const SALARYCALCULATION = 12;
    const MATERIALWASTE = 13;
    const FORECASTBUYING = 14;
    const REALTIMEPANEL = 15;
    const REPORTS = 16;
    const REQUESTREVIWOPERATOR = 17;
    const REQUESTREVIWBOT = 18;
    const INCOMECALLOPERATOR = 19;
    const INCOMECALLBOT = 20;
    const AUDIOHOSTING = 21;
    const ANALYTICS = 22;
    const VOICEROBOT = 23;
    const BACKUP = 24;
}

class Subscription extends Base
{
    public $idService = 0;
    public $idSection = 0;
    public $strName = '';
    public $strDescription = '';
    
    public $cost = 0;
    public $idTypeWhat = 0;
    public $isAccessable = 0;

    
    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"name":"'.$this->strName.'",'
            .'"dDescription":"'.$this->strDescription.'",'
            .'"cost":'.$this->cost.','
            .'"what":'.$this->idTypeWhat.','
            .'"isAccessable":"'.$this->isAccessable.'"';
    }

}

?>