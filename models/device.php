<?
include_once('../php-scripts/models/base.php');

class Device extends Base
{
    public $idAndroid = 0;
    public $strIdAndroid = '';  //  IdDevice
    public $strDevice = '';     //  название устройства

    public $strPhone = '';
    public $strEmail = '';
    public $strCode = '';   //  4-чисельный код подтверждения

    public $dateTimeCreated = 0;
    public $dateTimeUpdated = 0;

    public $idLanguage = 0;

    public $countReturns = 0;       //  Сколько дней (учитывает первый раз в день) пользователь запускал приложение
    public $countAppointments = 0;
    public $countClients = 0;
    public $countMasters = 0;
    public $countSalons = 0;
    public $countServices = 0;
    public $countResources = 0;
    public $countShedules = 0;
    public $countMessages = 0;
}

?>