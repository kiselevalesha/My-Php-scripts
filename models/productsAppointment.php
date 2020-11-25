<?
include_once('../php-scripts/models/base.php');
include_once('../php-scripts/models/product.php');

class ProductAppointment extends Base
{
    public $idOwner = 0;
    public $intQuantity = 1;
    public $intMinutesDuration = 0;
    public $idEssential = 0;
    public $idProduct = 0;
    
    public $cost = 0;
    public $summaTotal = 0;
    public $summaTax = 0;
    public $summaTip = 0;
    public $isCheckedForPayment = 1;

    public $isManualEdited = 0;
    public $isChecked = 0;
    
    public $dateTimeUpdated = 0;

    public function MakeJson() {
        return '"i":'.$this->idProduct.','
            .'"q":"'.$this->intQuantity.'",'
            .'"d":"'.$this->intMinutesDuration.'",'
            .'"m":'.$this->summaTotal.','
            .'"a":'.$this->dateTimeUpdated.'';
    }

}

?>