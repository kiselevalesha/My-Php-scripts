<?
require_once('../php-scripts/models/base.php');

/*abstract class EnumTypeUsers {
    const TypeClient = 1;
    const TypeEmployee = 2;
    
    //const TypeMaster = 3;
    const TypeLocalAdministartor = 4;
    const TypeRemoteAdministartor = 5;
    const TypeOperator = 6;
    const TypePartner = 7;
    const TypeSupervisor = 8;
}*/

class User extends Base
{
    public $strName = '';
    public $strSurName = '';
    public $strPatronymic = '';
    public $strAlias = '';
    public $strDescription = '';
    
    public $strToken = '';
    public $strYandexToken = '';
    public $strVKToken = '';

    public $dateBorn = 0;
    public $idSex = 0;
    public $idCategory = 0;

    public $idMainPhoto = 0;

    public $ageCreated = 0;
    public $ageChanged = 0;
    
    public $isNew = 1;
    public $isUse = 1;

    public $strJsonContacts = '';
    public $strJsonAdresses = '';
    public $strJsonCategory = '';
    public $strJsonGroups = '';


    public function GetShortName() {
        return $this->strName." ".$this->strSurName;
    }
}

?>