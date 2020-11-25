<?
class Base
{
    public $id = 0;
    public $isDeleted = 0;

    public $idEssentialAuthor = 0;
    public $idAuthor = 0;
    
    public $ageChanged = 0;

    public $strJson = "";
    public $strJsonUpdate = "";
    

    public function ToString() {
        return '';
    }
    
    public function ToJson() {
        return $this->GetJson();
    }

    public function GetJson() {
        $strJson = "";
        $strJson = $this->MakeJson();
        return '{'.$strJson.'}';
    }

    public function MakeBaseJson() {
        return '"id":'.$this->id.',"isDeleted":'.$this->isDeleted.',"typeAuthor":'.$this->idEssentialAuthor.',"author":'.$this->idAuthor.',"ageChanged":'.$this->ageChanged;
    }
    
    public function EscapeValue($str) {
        //return mysql_real_escape_string($str);
        $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
        return str_replace($search, $replace, $str);
    }

}
?>