<?
include_once('../php-scripts/models/base.php');

class Last extends Base
{
    public $idTable = 0;
    public $ageChanged = 0;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"table":'.$this->idTable.','
            .'"age":'.$this->ageChanged;
    }
}
?>