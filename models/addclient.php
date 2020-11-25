<?
include_once('../php-scripts/models/base.php');

class AddClient extends Base
{
    public $idToken = 0;
    public $strFIO = "";
    public $idFIO = 0;
    
    public $strTheme = "";
    public $idTheme = 0;
    
    public $strServices = "";
    public $strSchedule = "";
    public $strPhone = "";
    public $strEmail = "";
    public $strVK = "";
    public $strAdress = "";
    public $strLinkFrom = "";
    public $strPhoto = "";
    public $strDescription = "";
    public $strResult = "";

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"fio":"'.$this->strFIO.'",'
            .'"theme":"'.$this->strTheme.'",'
            .'"services":"'.$this->strServices.'",'
            .'"schedule":"'.$this->strSchedule.'",'
            .'"phone":"'.$this->strPhone.'",'
            .'"email":"'.$this->strEmail.'",'
            .'"vk":"'.$this->strVK.'",'
            .'"from":"'.$this->strLinkFrom.'",'
            .'"to":"'.$this->strLinkTo.'",'
            .'"message":"'.$this->strMessage.'",'
            .'"photo":"'.$this->strPhoto.'",'
            .'"specialization":"'.$this->strSpecialization.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"result":"'.$this->strResult.'",'
            .'"adress":"'.$this->strAdress.'",'
            .'"changed":"'.$this->ageChanged.'"';
    }
}
?>