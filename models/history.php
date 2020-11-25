<?
require_once('../php-scripts/models/base.php');

class EnumTypeActions {
    const ActionCreate = 1;
    const ActionEdit = 2;
    const ActionDelete = 3;
}

class History extends Base
{
    public $idEssential = 0;
    public $idAction = 0;
    public $strJson = "";

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"essential":'.$this->idEssential.','
            .'"action":'.$this->idAction.','
            .'"json":"'.str_replace('"', "'", $this->strJson).'",'     //'\"'
            .'"age":"'.$this->ageChanged.'",'
            .'"isDeleted":0';
    }
}
?>