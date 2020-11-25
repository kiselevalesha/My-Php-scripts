<?
include_once('../php-scripts/models/base.php');

class SqlDBUser extends Base
{
    public $id = 0;             //  Это номер базы данных. Конечный суффикс всех её таблиц.
    
    public $idEssential = 0;    //  кто создаёт DB - employee или client
    public $idTokenUser = 0;    //  id - создающего в dbTokenEmployee или в dbTokenClient
    
    public $ageCreated = 0;


    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"essential":'.$this->idEssential.','
            .'"user":'.$this->idTokenUser.','
            .'"age":'.$this->ageCreated;
    }
}
?>