<?
include_once('../php-scripts/models/base.php');

class Tax extends Base
{
    public $idForCalculation = 0;
    public $strDescription = '';
    public $idTypePeriod = 0;
    public $isTaxAddToPrice = 0;
    public $isUse = 1;
    public $isNew = 1;
    public $idColor = 0;

    public function ToJson() {
        return '{"id":"'.$this->id.'",'
            .'"name":"'.$this->strName.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"idForCalculation":"'.$this->idForCalculation.'",'
            .'"idTypePeriod":"'.$this->idTypePeriod.'",'
            .'"isTaxAddToPrice":"'.$this->isTaxAddToPrice.'",'
            .'"isUse":"'.$this->isUse.'",'
            .'"idColor":"'.$this->idColor.'"}';
    }
}
?>