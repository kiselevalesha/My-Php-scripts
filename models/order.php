<?
include_once('../php-scripts/models/base.php');

class Order extends Base
{
    public $strDescription = "";
    public $strNomer = "";
    public $strType = "";
    public $idCategory = 0;     //  Какой-то тип приказов из категорий
    public $strBody = "";
    public $ageDate = 0;        //  От какого числа
    public $isNew = 1;
    public $isUse = 1;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"name":"'.$this->strName.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"nomer":"'.$this->strNomer.'",'
            .'"type":"'.$this->strType.'",'
            .'"body":"'.$this->strBody.'",'
            .'"age":'.$this->ageDate.','
            .'"isUse":'.$this->isUse;
    }
}
?>