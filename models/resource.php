<?
include_once('../php-scripts/models/base.php');

class Resource extends Base
{
    public $strDescription = '';
    public $strSynonyms = '';            //  Синонимы, используемые для идентификации ресурса ботом
    public $strInventoryNumber = '';
    public $strBarCode = '';
    
    public $idSalon = 0;
    public $idPlace = 0;
    public $idCategory = 0;
    public $idMainPhoto = 0;
    public $intMinutesDuration = 0;
    
    public $isHaveAppointments = 1;     //  Имеет ли собственную запись. (Например, солярий имеет собственную запись и его нужно показывать в списке при создании записей.)
    public $isUse = 1;
    public $isNew = 1;

    public function MakeJson() {
        return '"id":'.$this->id.
        ',"name":"'.$this->strName.
        //'","nameOnline":"'.$this->strNameOnline.
        '","synonimes":"'.$this->strSynonyms.
        '","description":"'.$this->strDescription.
        
        '","salon":{"id":'.$this->idSalon.',"name":""}'.
        ',"place":{"id":'.$this->idPlace.',"name":""}'.
        ',"category":{"id":'.$this->idCategory.',"name":""}'.
        ',"photo":'.$this->idMainPhoto.
        ',"duration":'.$this->intMinutesDuration.
        ',"isHaveAppointments":'.$this->isHaveAppointments.
        ',"isDeleted":'.$this->isDeleted.
        ',"isUse":'.$this->isUse;
    }

}

?>