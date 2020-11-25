<?
include_once('../php-scripts/models/base.php');

class Cookie extends Base
{
    public $strUID = '';
    public $strIP = '';
    public $isAllow = 1;
    public $idUser = 0;
    public $dateTimeCallVyzov = 0;
    public $dateTimeUpdated = 0;
    public $dateTimeCreated = 0;
}

?>