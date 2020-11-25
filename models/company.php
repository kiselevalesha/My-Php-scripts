<?
include_once('../php-scripts/models/user.php');

class Company extends Base
{
    public $uid = '';
    public $strName = '';
    public $strAlias = '';
    public $strDescription = '';
    public $strAddress = '';

    public $idINN = 0;
    public $idKPP = 0;

    public $idLegalStatus = 0;      //  Юридическое или физическое лицо.

    public $isUse = 0;
    public $isDeleted = 0;
    public $isSelected = 0;

    public $dateTimeUpdated = 0;
    public $dateTimeCreated = 0;
}

?>