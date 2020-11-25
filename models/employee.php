<?
include_once('../php-scripts/models/user.php');

class Employee extends User
{
    public $strAdvertisement = '';
    public $strPromoCode = '';

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"surname":"'.$this->strSurName.'",'
            .'"name":"'.$this->strName.'",'
            .'"patronymic":"'.$this->strPatronymic.'",'
            .'"alias":"'.$this->strAlias.'",'
            .'"born":"'.$this->dateBorn.'",'
            .'"sex":"'.$this->idSex.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"isDeleted":'.$this->isDeleted.','
            .'"essential":'.EnumEssential::EMPLOYEE.','
            .'"isUse":'.$this->isUse;
    }
}
?>