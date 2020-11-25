<?
include_once('../php-scripts/models/base.php');

class Category extends Base
{
    public $idEssential = 0;
    public $idCategory = 0;
    public $idOwner = 0;
    public $idParent = 0;
    public $strDescription = '';
    public $isNew = 1;

    public function MakeJson() {
        return '"id":"'.$this->id.'",'
            .'"name":"'.$this->strName.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"essential":'.$this->idEssential.','
            .'"category":'.$this->idCategory.','
            .'"owner":'.$this->idOwner .','
            .'"parent":'.$this->idParent.','
            .'"isDeleted":'.$this->isDeleted;
    }
}
?>