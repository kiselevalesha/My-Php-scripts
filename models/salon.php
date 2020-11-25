<?
include_once('../php-scripts/models/company.php');

class Salon extends Company
{
    public $strFirebase = "";
    public $intCodeFirebase = 0;

    public $idCategory = 0;
    public $strName = '';
    public $strDescription = '';
    public $intINN = 0;
    public $intKPP = 0;
    public $idTypeLegacy = 0;
    public $idMainPhoto = 0;
    public $isUse = 1;
    public $isShowOnline = 0;
    public $isNew = 1;
    
    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"name":"'.$this->strName.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"category":'.$this->idCategory.','
            .'"INN":'.$this->intINN.','
            .'"KPP":'.$this->intKPP.','
            .'"typeLegacy":'.$this->idTypeLegacy.','
            .'"isUse":'.$this->isUse.','
            .'"isShowOnline":'.$this->isShowOnline;
    }

}
?>