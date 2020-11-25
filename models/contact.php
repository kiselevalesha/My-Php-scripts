<?
include_once('../php-scripts/models/base.php');

abstract class EnumTypeContacts {
    const TypePhone = 1;
    const TypeEmail = 2;
    const TypeVK = 3;
    //const TypeYandex = 4;
    //...
}

class Contact extends Base
{
    public $idOwner = 0;
    public $idOwnerEssential = 0;   //  мастер или клиент
    public $idType = 0;             //  EnumTypeContacts:: phone/email/viber/VK
    public $intPhonePrefix = '';      //  +7 или +44 или +1 - международный префикс телефонного номера
    public $isAllow = 1;            //  можно ли использовать для обращений
    public $strText = '';           //  номер телефона или email
    public $intCodeText = 0;        //  Hash-код для strText
    public $strPassword = '';       //  иногда для чего-то требуется пароль

    public function GetPhoneNumber() {
        $strPrefix = "";
        if (($this->intPhonePrefix == 7) || ($this->intPhonePrefix == 8))   $strPrefix = "+7";
        $str = trim($strPrefix." ".$this->strText);
        return $str;
    }
    public function SetPhoneNumber($strPhone) {
        $strPhone = str_replace(" ", "", $strPhone);
        
        $plus = substr($strPhone, 0, 1);
        if (strcmp($plus, "+") == 0) {
            $prefix = substr($strPhone, 1, 1);
            if ($prefix == 8)   $prefix = 7;
            $this->intPhonePrefix = "+".$prefix;
            $this->strText = trim(substr($strPhone, 2));
            return;
        }
        $prefix = substr($strPhone, 0, 1);
        if (($prefix == 7) || ($prefix == 8)) {
            $this->intPhonePrefix = "+7";
            $this->strText = trim(substr($strPhone, 1));
            return;
        }
        if (strlen($strPhone) == 10) {
            $this->intPhonePrefix = "+7";
        }
        $this->strText = trim($strPhone);
    }

    
    public function MakeJson() {
        return '"id":"'.$this->id.'",'
            .'"owner":'.$this->idType.','
            .'"essential":'.$this->idType.','
            .'"type":'.$this->idType.','
            .'"isAllow":'.$this->idType.','
            .'"type":'.$this->idType.','
            .'"body":"'.$this->strText.'",'
            .'"isDeleted":'.$this->isDeleted;
    }

}

?>