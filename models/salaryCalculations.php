<?
include_once('../php-scripts/models/base.php');

class SalaryCalculation extends Base
{
    public $intYear = 0;
    public $intMonth = 0;
    public $intDay = 0;
    public $idSalon = 0;
    public $idEmployee = 0;
    public $idPlace = 0;
    public $idCurrency = 0;
    
    public $summaAsMaster = 0;
    public $summaAsAssistent = 0;
    public $summaAsAdministartor = 0;
    public $summaAsSeller = 0;
    public $summaForPeriod = 0;
    public $summaForRent = 0;

    public $summaBonus = 0;
    public $summaPenalty = 0;
    public $summaFix = 0;

    public $summaOnHands = 0;
    
    public $isAutoCalculation = 0;
    public $ageCalculated = 0;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"year":'.$this->intYear.','
            .'"month":'.$this->intMonth.','
            .'"day":'.$this->intDay.','
            .'"isAutoCalculation":'.$this->isAutoCalculation;
    }

}