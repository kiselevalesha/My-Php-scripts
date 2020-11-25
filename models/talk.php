<?
include_once('../php-scripts/models/base.php');

abstract class EnumTypeTalks {
    const TypeTalkDialog = 1;
    const TypeTalkSupport = 2;
    const TypeTalkBot = 3;
    const TypeTaskAction = 4;
    
    //  парный или групповой
}
abstract class EnumTypeUser {
    const TypeUserClient = 1;
    const TypeUserEmployee = 2;
    const TypeUserOperator = 3;
    const TypeUserAdministrator = 4;
    const TypeUserSupport = 5;
    const TypeUserDeveloper = 6;
    const TypeUserBot = 7;
}

class Talk extends Base
{
    public $strUidFirebase = '';
    public $intCodeUidFirebase = 0;
    
    public $idHost = 0;
    public $idGlobalTalk = 0;

    //  Получатель сообщения
    public $idTypeUser = 0;     //  ::EnumTypeUser  -   кем выступает получатель сообщения
    public $strUidUser = '';
    public $intCodeUidUser = 0;

    public $idType = 0;         //  ::EnumTypeTalks
    public $intCountNewMessages = 0;
    public $ageChanged = 0;
}

?>