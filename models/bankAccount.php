<?
include_once('../php-scripts/models/base.php');

class BankAccount extends Base
{
    public $idEssential = 0;
    public $idOwner = 0;

    public $strName = "";
    public $strBIK = "";
    public $strBankName = "";
    public $strRasAccount = "";
    public $strKorAccount = "";

    public $isDefault = 0;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"essential":'.$this->idEssential.','
            .'"owner":'.$this->idOwner.','

            .'"name":"'.$this->strName.'",'
            .'"BIK":"'.$this->strBIK.'",'
            .'"bank":"'.$this->strBankName.'",'
            .'"raccount":"'.$this->strRasAccount.'",'
            .'"kaccount":"'.$this->strKorAccount.'",'
            
            .'"isDeleted":'.$this->isDeleted.','
            .'"isDefault":'.$this->isDefault;
    }
}
?>