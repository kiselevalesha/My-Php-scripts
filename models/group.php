<?
include_once('../php-scripts/models/base.php');

class Group extends Base
{
    public $idEssential = 0;
    public $idType = 0;
    public $idColor = 0;
    
    public $strDescription = 0;
    public $isNew = 0;

    //  данные для ownerGroup
    public $idRelation = 0;
    public $idOwner = 0;
    public $idGroup = 0;
    public $isChecked = 0;

    public $isAutoCreated = 0;      //  Создана ли группа автоматически
    public $idGroupRule = 0;        //  Правило, по которому атоматически была создана группа



    public static function GetNameTypeRussian($idType) {
        $str = "";
        switch($idType) {
            case 1:
                $str = "";
                break;
            case 2:
                $str = "";
                break;
        }
        return $str;
    }
    
    public function MakeJson() {
        return '"id":"'.$this->id.'",'
            .'"name":"'.$this->strName.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"essential":'.$this->idEssential.','
            .'"type":'.$this->idType.','
            .'"color":'.$this->idColor.','
            .'"isDeleted":'.$this->isDeleted;
    }
}
?>