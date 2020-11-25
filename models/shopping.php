<?
include_once('../php-scripts/models/base.php');

class Shopping extends Base
{
    public $idVendor = 0;
    public $agePayed = 0;
    
    public $summa = 0;
    public $idCurrency = 0;
    
    public $strDescription = "";
    
    public $isNew = 1;
    public $isUse = 1;

    public function MakeJson() {
        return '"id":'.$this->id.
        ',"vendor":{"id":'.$this->idVendor.',"name":""}'.
        ',"ages":{"payed":'.$this->agePayed.',"changed":'.$this->ageChanged.'}'.
        
        ',"summa":'.$this->summa.
        ',"currency":{"id":'.$this->idCurrency.',"name":""}'.

        ',"description":"'.$this->strDescription.'"'.
        
        ',"isNew":'.$this->isNew;
        ',"isUse":'.$this->isUse;
    }

}

?>