<?
include_once('../php-scripts/models/base.php');

class AddedToDB extends Base
{
    public $idHost = 0;
    public $idDB = 0;
    public $idSalon = 0;
    public $idEmployee = 0;
    public $isAdded = 0;
    public $intPinCode = 0;
    public $ageChanged = 0;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"host":'.$this->idHost.','
            .'"DB":'.$this->idDB.','
            .'"salon":'.$this->idSalon.','
            .'"employee":'.$this->idEmployee.','
            .'"isAdded":'.$this->isAdded.','
            .'"pinCode":'.$this->intPinCode.','
            .'"ageChanged":'.$this->ageChanged;
    }
}
?>