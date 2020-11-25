<?
include_once('../php-scripts/models/base.php');

class Token extends Base
{
    public $strUidToken = '';
    public $strIdAndroidDevice = '';
    public $strCookie = '';
    
    public $strLogin = '';
    public $strPassword = '';
    public $strUidUser = '';
    //public $idUser = 0;
    
    public $strLanguage = '';
    public $strEmail = '';
    public $strPhone = '';
    public $strIP = '';

    public $dateTimeExpired = 0;
    public $dateTimeCreated = 0;
    public $dateTimeUpdated = 0;
    
    //Временно. Вообще тут должны быть отношения один ко многим. Сейчас делаю один к одному! Потом исправь!!!
    public $strUidDataBase = '';
    public $strServerDataBase = '';
    public $idDataBase = 0;
    public $isSynchronizeDataBase = 0;
    
    public $strUidTalk = '';
    public $strServerTalk = '';
    public $idTalk = 0;
    public $isSynchronizeTalk = 1;
    
}

?>