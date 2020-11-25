<?
include_once('../php-scripts/models/base.php');

class Criterion extends Base
{
    public $strDescription = '';
    public $idEssential = 0;
    
    public $idClientCategory = 0;
    public $idClient = 0;
    
    public $idEmployeeCategory = 0;
    public $idEmployee = 0;
    
    public $idProductCategory = 0;
    public $idProduct = 0;
    
    public $idServiceCategory = 0;
    public $idService = 0;
    
    public $idSetCategory = 0;
    public $idSet = 0;
    
    public $idPlaceCategory = 0;
    public $idPlace = 0;
    
    public $intDayWeek1 = 0;
    public $intDayWeek2 = 0;
    public $intDayWeek3 = 0;
    public $intDayWeek4 = 0;
    public $intDayWeek5 = 0;
    public $intDayWeek6 = 0;
    public $intDayWeek7 = 0;
    public $intDayMonth1 = 0;
    public $intDayMonth2 = 0;
    public $intDayMonth3 = 0;
    public $intDayMonth4 = 0;
    public $intDayMonth5 = 0;
    public $intDayMonth6 = 0;
    public $intDayMonth7 = 0;
    public $intDayMonth8 = 0;
    public $intDayMonth9 = 0;
    public $intDayMonth10 = 0;
    public $intDayMonth11 = 0;
    public $intDayMonth12 = 0;
    public $intDayMonth13 = 0;
    public $intDayMonth14 = 0;
    public $intDayMonth15 = 0;
    public $intDayMonth16 = 0;
    public $intDayMonth17 = 0;
    public $intDayMonth18 = 0;
    public $intDayMonth19 = 0;
    public $intDayMonth20 = 0;
    public $intDayMonth21 = 0;
    public $intDayMonth22 = 0;
    public $intDayMonth23 = 0;
    public $intDayMonth24 = 0;
    public $intDayMonth25 = 0;
    public $intDayMonth26 = 0;
    public $intDayMonth27 = 0;
    public $intDayMonth28 = 0;
    public $intDayMonth29 = 0;
    public $intDayMonth30 = 0;
    public $intDayMonth31 = 0;
    
    public $intMonth1 = 0;
    public $intMonth2 = 0;
    public $intMonth3 = 0;
    public $intMonth4 = 0;
    public $intMonth5 = 0;
    public $intMonth6 = 0;
    public $intMonth7 = 0;
    public $intMonth8 = 0;
    public $intMonth9 = 0;
    public $intMonth10 = 0;
    public $intMonth11 = 0;
    public $intMonth12 = 0;
    
    public $intHour1 = 0;
    public $intHour2 = 0;
    public $intHour3 = 0;
    public $intHour4 = 0;
    public $intHour5 = 0;
    public $intHour6 = 0;
    public $intHour7 = 0;
    public $intHour8 = 0;
    public $intHour9 = 0;
    public $intHour10 = 0;
    public $intHour11 = 0;
    public $intHour12 = 0;
    public $intHour13 = 0;
    public $intHour14 = 0;
    public $intHour15 = 0;
    public $intHour16 = 0;
    public $intHour17 = 0;
    public $intHour18 = 0;
    public $intHour19 = 0;
    public $intHour20 = 0;
    public $intHour21 = 0;
    public $intHour22 = 0;
    public $intHour23 = 0;
    public $intHour24 = 0;
    
    public $ageStart = 0;
    public $ageEnd = 0;
    
    public $isNew = 1;
    public $isDeleted = 0;
    public $isUse = 1;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"name":"'.$this->strName.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"ageStart":'.$this->ageStart.','
            .'"ageEnd":'.$this->ageEnd.','
            .'"isUse":'.$this->isUse.','
            .'"isDeleted":'.$this->isDeleted;
    }
}
?>