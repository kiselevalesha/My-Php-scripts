<?
include_once('../php-scripts/models/base.php');

class PricelistContent extends Base
{
    public $idPricelist = 0;
    public $idPricelistSection = 0;
    public $idOwner = 0;
    public $idEssential = 0;
    public $idProduct = 0;
    public $isUse = 0;
    public $isCostPerTime = 0;
    public $isAbonement = 0;
    public $intQuantity = 1;
    public $idWhat = 0;
    public $intDurationMinutes = 0;
    public $costForSale = 0;
    public $costForService = 0;
    public $intSellerProcents = 0;
    public $summaSellerFixMoney = 0;
    public $intMasterProcents = 0;
    public $summaMasterFixMoney = 0;
    public $isCalcProductPrice = 1;
    public $strDescription = '';
    public $idTax = 0;
    public $idCurrency = 0;
    public $idGlobal = 0;
    public $strKeyAuthor = '';
    public $dateTimeGlobalChanged = 0;

    public function MakeJson() {
        return //'"id":'.$this->idPricelist.','
            '"pricelist":{"id":'.$this->idPricelist.'},'
            //.'"product":'.$this->idProduct.','
            //.'"essential":'.$this->idEssential.','
            .'"cost":'.$this->costForSale.','
            .'"duration":'.$this->intDurationMinutes;   //.','
            //.'"isUse":'.$this->isUse.'';
    }
}
?>