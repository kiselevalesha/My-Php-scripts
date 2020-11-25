<?
include_once('../php-scripts/models/base.php');

class Payment extends Base
{
    public $idTotalPayment = 0;
    public $idEssentialPayer = 0;
    public $idPayer = 0;
    public $idEssentialReceiver = 0;
    public $idReceiver = 0;
    public $idTypePayment = 0;
    public $idTypeContent = 0;
    public $idItemPayment = 0;
    public $idSubItemPayment = 0;
    public $idMoneyBase = 0;
    public $agePayed = 0;
    public $summaTips = 0;
    public $cost = 0;
    public $idCurrency = 0;
    public $isAutoCreated = 0;
    public $isNew = 0;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"idTotalPayment":'.$this->idTotalPayment.','
            /*.'"intBillNumber":'.$this->intBillNumber.','
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
            .'"isSaved":'.$this->isSaved.','*/
            .'"isNew":'.$this->isNew;
    }

}

?>