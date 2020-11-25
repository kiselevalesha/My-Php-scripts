<?
include_once('../php-scripts/models/base.php');

class UserSqldb extends Base
{
    public $idToken = 0;
    public $idSqldb = 0;

    public $idAccessProfile = 0;            //  id-заготовленного профиля, устанавливающего права на доступ к DB. Это будет отдельная таблица. Сделай потом.

    public $isCanSeeAppointments = 1;
    public $isCanChangeAppointments = 1;

    public $isCanSeeClients = 1;
    public $isCanChangeClients = 1;
    
    //  Потом добавь ещё множество других прав на доступ к просмотру и изменению общих данных или только своих
    //  ...

    public $ageChanged = 0;
}

?>