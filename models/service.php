<?
include_once('../php-scripts/models/base.php');

class Service extends Base
{
    public $idSalon = 0;
    public $idMaster = 0;
    
    //  Для работы с выделяемым списком услуг
    public $idAppointment = 0;
    public $idService = 0;
    public $iQuality = 0;
    public $isSelected = 0;
    public $idClient = 0;
    
    public $duration = 0;
    public $totalDuration = 0;
    public $isAutoCalculationTotalDuration = 0;

    public $cost = 0;
    public $totalCost = 0;
    public $isAutoCalculationTotalCost = 0;
}

?>