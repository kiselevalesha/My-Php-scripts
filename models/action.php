<?
include_once('../php-scripts/models/base.php');

class Bill extends Base
{
    public $strDescription = "";
    public $strPromoDescription = "";
    public $ageStartPeriod = 0;
    public $ageEndPeriod = 0;
    public $isSendMessage = 0;
    public $ageSendMessage = 0;
    public $idCriterionSendMessage = 0;
    public $strBodyMessage = "";
    public $isShowOnline = 0;
    public $isNew = 0;
    public $isUse = 0;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"strName":"'.$this->strName.'",'
            .'"strDescription":"'.$this->strDescription.'",'
            .'"strPromoDescription":"'.$this->strPromoDescription.'",'
            .'"ageStartPeriod":'.$this->ageStartPeriod.','
            .'"ageEndPeriod":'.$this->ageEndPeriod.','
            .'"isSendMessage":'.$this->isSendMessage.','
            .'"ageSendMessage":'.$this->ageSendMessage.','
            .'"idCriterionSendMessage":'.$this->idCriterionSendMessage.','
            .'"strBodyMessage":'.$this->strBodyMessage.','
            .'"isShowOnline":'.$this->isShowOnline.','
            .'"isNew":'.$this->isNew.','
            .'"isUse":'.$this->isUse;
    }
}
?>