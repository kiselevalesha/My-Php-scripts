<?
include_once('../php-scripts/models/user.php');

class botMessage extends Base
{
    public $strMessage = "";
    public $strJsonResult = "";

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"message":"'.$this->strMessage.'",'
            .'"result":"'.$this->strJsonResult.'"';
    }
}
?>