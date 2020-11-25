<?
include_once('../php-scripts/models/base.php');

abstract class EnumTypeTemplateDays {
    const TypeDayWorking = 1;
    const TypeDayVacancy = 2;
}

class TemplateDay extends Base
{
    public $idTypeDay = 0;
    public $intTimeStart = 0;
    public $intTimeEnd = 0;
    public $idColor = 0;
    public $isCanEdit = 1;
    public $strName = '';
    public $strDescription = '';

    function MakeJson() {
        return '"id":'.$this->id.',"color":'.$this->idColor.',"isCanEdit":'.$this->isCanEdit.
            ',"start":'.$this->intTimeStart.',"end":'.$this->intTimeEnd.',"type":'.$this->idTypeDay.
            ',"name":'.$this->strName.',"description":'.$this->strDescription;
    }
    
}
?>