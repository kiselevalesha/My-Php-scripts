<?
include_once('../php-scripts/models/base.php');

class Call extends Base
{
    public $ageStartCall = 0;
    public $ageStartTalk = 0;
    public $ageEndTalk = 0;
    
    public $strPhoneTo = "";
    public $idSalon = 0;
    public $idMaster = 0;
    
    public $strPhoneFrom = "";
    public $idClient = 0;
    
    public $idOperator = 0;
    public $ageChanged = 0;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"ageStartCall":'.$this->ageStartCall.','
            .'"ageStartTalk":'.$this->ageStartTalk.','
            .'"ageEndTalk":'.$this->ageEndTalk.','
            .'"phoneTo":"'.$this->strPhoneTo.'",'
            .'"salon":'.$this->idSalon.','
            .'"master":'.$this->idMaster.','
            .'"phoneFrom":"'.$this->strPhoneFrom.'",'
            .'"client":'.$this->idClient.','
            .'"operator":'.$this->idOperator.','
            .'"ageChanged":'.$this->ageChanged;
    }
}
?>