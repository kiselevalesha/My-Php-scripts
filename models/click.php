<?
include_once('../php-scripts/models/base.php');

class Click extends Base
{
    public $strUrlFrom = '';
    public $strUrlTo = '';
    public $strActivity = '';
    
    public $strPage = '';
    public $strDiv = '';
    public $strView = '';
    
    public $strValue = '';
    public $strDescription = '';
    public $strError = '';

    public function MakeJson() {
        return '"id":'.$this->id.','
            .'"strUrlFrom":"'.$this->strUrlFrom.'",'
            .'"strUrlTo":"'.$this->strUrlTo.'",'
            .'"strActivity":"'.$this->strActivity.'",'
            .'"strPage":"'.$this->strPage.'",'
            .'"strDiv":"'.$this->strDiv.'",'
            .'"strView":"'.$this->strView.'",'
            .'"strValue":"'.$this->strValue.'",'
            .'"strError":"'.$this->strError.'"';
    }

}
?>