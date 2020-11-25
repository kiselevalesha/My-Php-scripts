<?
include_once('../php-scripts/models/base.php');

class Bill extends Base
{
    public $idTotalPayment = 0;
    public $intBillNumber = 0;
    public $idAppointment = 0;
    public $idEssentialContent = 0;
    public $idMaster = 0;
    public $idAdministrator = 0;
    public $ageBilled = 0;
    public $strDescription = "";
    public $idTypeBill = 0;
    public $summaTotal = 0;
    public $idCurrency = 0;
    public $idTax = 0;
    public $isAutoCalc = 0;
    public $isSaved = 0;
    public $isNew = 0;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"idTotalPayment":'.$this->idTotalPayment.','
            .'"intBillNumber":'.$this->intBillNumber.','
            .'"idAppointment":'.$this->idAppointment.','
            .'"idEssentialContent":'.$this->idEssentialContent.','
            .'"idMaster":'.$this->idMaster.','
            .'"idAdministrator":'.$this->idAdministrator.','
            .'"ageBilled":'.$this->ageBilled.','
            .'"strDescription":"'.$this->strDescription.'",'
            .'"idTypeBill":'.$this->idTypeBill.','
            .'"summaTotal":'.$this->summaTotal.','
            .'"idCurrency":'.$this->idCurrency.','
            .'"idTax":'.$this->idTax.','
            .'"isAutoCalc":'.$this->isAutoCalc.','
            .'"isSaved":'.$this->isSaved.','
            .'"isNew":'.$this->isNew;
    }
}
?>