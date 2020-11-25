<?
include_once('../php-scripts/models/base.php');

class OwnerGroup extends Base
{
    public $idRelation = 0;
    
    public $idEssential = 0;
    public $idOwner = 0;
    public $idGroup = 0;
    public $isChecked = 0;

    public $isAutoCreated = 0;      //  Создана ли группа автоматически
    public $idGroupRule = 0;        //  Правило, по которому атоматически была создана группа
}

?>