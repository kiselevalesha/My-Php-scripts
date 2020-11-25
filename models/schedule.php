<?
include_once('../php-scripts/models/base.php');

abstract class EnumTypeGraphicDays {
    const TypeWorkDay = 1;
    const TypeVacancyDay = 2;
}

class Shedule extends Base
{
    public $age = 0;
    public $idTypeDay = 0;      //  Рабочий или выходной
    public $intTimeStart = 0;
    public $intTimeEnd = 0;
    public $idEssentialOwner = 0;
    public $idOwner = 0;
    public $idSalon = 0;
    public $idPlace = 0;
    public $idColor = 0;
    public $intMaxAppointments = 0;

    function MakeJson() {
        return '"id":'.$this->id.',"type":'.$this->idTypeDay.',"color":'.$this->idColor.',"max":'.$this->intMaxAppointments.
            ',"age":'.$this->age.',"start":'.$this->intTimeStart.',"end":'.$this->intTimeEnd.
            ',"salon":'.$this->idSalon.',"place":'.$this->idPlace.
            ',"owner":'.$this->idOwner.',"essential":'.$this->idEssentialOwner;
    }

    function MakeMiniJson() {
        return '"o":'.$this->idOwner.',"t":'.$this->idTypeDay.',"a":'.$this->age.
                ',"s":'.$this->intTimeStart.',"e":'.$this->intTimeEnd;
    }

}
?>