<?
include_once('../php-scripts/models/base.php');

class OwnerService extends Base
{
    public $idOwner = 0;
    
    public $idSalon = 0;
    public $idEployee = 0;
    
    public $idService = 0;
    public $isChecked = 0;

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"owner":'.$this->idOwner.','
            .'"salon":'.$this->idSalon.','
            .'"eployee":'.$this->idEployee.','
            .'"service":'.$this->idService.','
            .'"isChecked":'.$this->isChecked;
    }

}

?>