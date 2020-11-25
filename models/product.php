<?
include_once('../php-scripts/models/base.php');

class Product extends Base
{
    public $idEssential = 0;
    
    public $strNameOnline = '';     //  Название в онлайн-записи
    public $strNameCheque = '';     //  Название в чеке
    public $strSynonyms = '';      //  Синонимы услуги/продукта для чат-бота
    
    public $strDescription = '';
    public $strArticul = '';
    public $strBarCode = '';
    public $idCategory = 0;
    public $intUsePeriod = 0;
    public $isAutoCalculation = 1;
    public $idNotificationRule = 0;
    public $idTax = 0;
    public $idUnitProduct = 0;
    public $idUnitContent = 0;
    public $intQuantityBrutto = 0;
    public $intQuantityNetto = 0;
    public $idItemWizard = 0;
    public $isForWoman = 1;
    public $isForMan = 1;
    public $isForChildren = 1;
    public $isForSale = 0;
    public $isUse = 1;
    public $isShowOnline = 1;
    public $isNew = 1;
    
    public $idMainPhoto = 0;

    //================//
    
    public $cost = 0;
    public $duration = 0;
    
    public function MakeJson() {
        return '"id":'.(0 + $this->id).
        ',"name":"'.$this->strName.
        '","nameOnline":"'.$this->strNameOnline.
        '","nameCheque":"'.$this->strNameCheque.
        '","synonimes":"'.$this->strSynonyms.
        '","description":"'.$this->strDescription.
        '","usePeriod":'.$this->intUsePeriod.
        ',"isAutoCalculation":'.(0 + $this->isAutoCalculation).
        ',"isForWoman":'.(0 + $this->isForWoman).
        ',"isForMan":'.(0 + $this->isForMan).
        ',"isForChildren":'.(0 + $this->isForChildren).
        ',"isShowOnline":'.(0 + $this->isShowOnline).
        ',"isDeleted":'.(0 + $this->isDeleted).
        ',"essential":'.EnumEssential::SERVICES.
        ',"isUse":'.(0 + $this->isUse);
    }

}

?>