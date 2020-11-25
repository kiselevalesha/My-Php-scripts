<?

abstract class EnumStatusInvite {
    const INVITE_SENDED = 1;
    const INVITE_ACCEPTED = 2;
}

class Invite
{
    public $idDB = 0;
    public $idSalon = 0;
    public $idEmployee = 0;
    public $strEmail = '';
    public $strPhone = '';
    public $longCode = 0;   //  longCodeInvite
    public $ageChanged = 0;
    
    public function ToJson() {
        //return '{"id":'.$this->id.',"name":"'.$this->strName.'"}';
    }
}
?>