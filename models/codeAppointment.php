<?
include_once('../php-scripts/models/base.php');

class CodeAppointment extends Base
{
    public $longCode = 0;

    public $isFinishedStep1 = 0;
    public $isFinishedStep2 = 0;
    public $isFinishedStep3 = 0;
    public $isFinishedStep4 = 0;

    public $idDB = 0;
    public $idSalon = 0;
    public $idEmployee = 0;
    public $idAppointment = 0;
    
    
    function GetNewNumber() {
        return random_int (0, 9);
    }
    function GenerateCode() {    //  Будет ошибка, когда $id будет больше 9 цифр !!!     Переделай потом, учитывая эту ситуацию !!!
        $id = $this->id;
        $length = strlen($id);
        //echo " id=".$id;
        //echo " length=".$length;
        
        $offset = $this->GetNewNumber();
        //echo " offset=".$offset;
        if ($offset > (14 - $length))   $offset = 14 - $length;
        //echo " offset=".$offset;
        
        $ret = $offset;
        for ($i = 0; $i < $offset; $i++) 
            $ret = $ret.$this->GetNewNumber();
        //echo " ret=".$ret;
        
        $ret = $ret.$id;
        //echo " ret=".$ret;
        
        for ($i = 0; $i < (14 - ($offset + $length)); $i++) 
            $ret = $ret.$this->GetNewNumber();
            
        //echo " ret=".$ret;
        $ret = $ret.$length;
        
        $this->longCode = $ret;
        //echo " ret=".$ret;
        return $ret;
    }
    
    function GetIdByCode($strCodeFormat) {
        //$strCode = $this->ToCode($strCodeFormat);
        $strCode = $strCodeFormat;
        while(strlen($strCode) < 16)    $strCode = "0".$strCode;
        $offset = substr($strCode, 0, 1);
        $length = substr($strCode, strlen($strCode) - 1, 1);
        $id = substr($strCode, $offset + 1, $length);
        //echo " GetIdByCode: offset=".$offset." length=".$length." id=".$id;
        return $id;
    }
        
    
    function GetCodeFormat() {
        $str = "".$this->longCode;
        ///  Может быть меньше 16 цифр. Значит спереди нужно подставить нули!!! Или ничего не ставить. И ставить лишь в обработчике!!!
        ///while(strlen($str) < 16)    $str = "0".$str;
        return $str;
    }
    function ToCode($str) {
        //  Убрать все пробелы и прочий мусор
        return substr($str, 0, 4).substr($str, 5, 4).substr($str, 10, 4).substr($str, 15, 4);
    }
    
}

?>