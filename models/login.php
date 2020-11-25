<?
include_once('../php-scripts/models/base.php');


abstract class EnumTypeLogins {
    const IdTypeLoginWeb = 1;
    const IdTypeLoginAndroid = 2;
    const IdTypeLoginApple = 3;
}

class DataBase extends Base
{
    public $strUid = "";    //  Это web-cookie или androidDevice
    public $iUid = 0;

    public $strLogin = "";
    public $strPassword = "";

    public $isUse = 1;

    public $dateTimeCreated = 0;
    public $dateTimeUpdated = 0;
}

?>