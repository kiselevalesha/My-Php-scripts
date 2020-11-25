<?
include_once('../php-scripts/models/base.php');

class Pricelist extends Base
{
    public $idCriterion = 0;
    public $strDescription = '';

    public $isAddTip = 0;
    public $intTipProcents = 0;
    
    public $isUse = 1;
    public $isNew = 1;

    public $strJson = '';


    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"name":"'.$this->strName.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"isAddTip":'.$this->isAddTip.','
            .'"tipProcents":'.$this->intTipProcents.','
            .'"isUse":'.$this->isUse.','
            .'"isDeleted":'.$this->isDeleted.','
            .'"isNew":'.$this->isNew.'';
    }
}
?>