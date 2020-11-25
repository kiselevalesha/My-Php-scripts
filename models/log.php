<?
include_once('../php-scripts/models/relation.php');

class Log extends Relation
{
    public $idDevice = 0;
    
    public $idActivity = 0;
    public $strActivity = '';
    
    public $idPage = 0;
    public $strPage = '';
    
    public $idEvent = 0;
    public $strEvent = '';
    
    public $idUI = 0;
    public $strUI = '';
    
    public $idType = 0;
    public $idStatus = 0;
    
    public $strBody = '';   //  Какое-то текстовое содержимое
    
    public $ageChanged = 0;


    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"body":"'.$this->strBody.'",'
            .'"status":"'.$this->idStatus.'",'
            .'"changed":"'.$this->ageChanged.'"';
    }
    
}

?>