<?
    function ExitEmptyError($strError) {
        //require_once '../php-scripts/db/dbBase.php';
        global $dbLog;
        if (!empty($dbLog))     $dbLog->Add(100, $str);
        echo "{".GetOutJsonStatus('100Error', " EmptyError - ".$strError).'}';      //  EnumErrors::StrEmptyError
        exit; 
    }
    function ExitError($idError, $strError) {
        global $idReturnCode, $idGlobal, $idLocal, $now, $dbLog;
        if (!empty($dbLog))     $dbLog->Add($idError, $strError);
        //$str = "{".GetOutJsonStatus($idError, $strError).','.GetOutJsonInstructions().',"rows":[]}';
        $str = "{".GetOutJsonStatus($idError, $strError).'}';
        echo $str;
        exit; 
    }
    
    function GetOutJsonStatus($idError, $strDescription) {
        return '"status":{"id":"'.$idError.'","description":"'.$strDescription.'"}';
    }

    function GetOutJsonInstructions() {
        return '"instructions":[]';
    }

    function GetOutJsonData($strDate) {
        return '"data":{'.$strDate.'}';
    }

    function GetOutJson($strDate) {
        global $dbLog;
        $str = GetOutJsonStatus(200, "OK200").','.GetOutJsonData($strDate).','.GetOutJsonInstructions();
        if (!empty($dbLog))     $dbLog->Add(2002, $str);
        return '{'.$str.'}';
    }



    function IsNumeric($num) {
        if (isSet($num))
            if (is_numeric($num))   return true;
        return false;
    }
    function IsInteger($num) {
        if (isSet($num))
            if (is_int($num))   return true;
        return false;
    }
    function GetString($str) {
        if (isSet($str))    return substr($str, 0, 1000);       //  Ограничиваю 1000 символами.
        return "";
    }
    function GetCleanString($str) {
        if (isSet($str))    return substr(CleanValue($str), 0, 1000);       //  Ограничиваю 1000 символами.
        return "";
    }
    function GetInt($num) {
        $ret = 0;
        if (isSet($num)) {
            if (strlen("".$num) == 0)  $ret = 0;
            else if (is_int($num))  $ret = $num;
        }
        return $ret;
    }
    function GetNumeric($num) {
        $ret = 0;
        if (isSet($num)) {
            if (strlen($num) == 0)  $ret = 0;
            else if (is_numeric($num))  $ret = $num;
        }
        return $ret;
    }
    function CleanValue($str) {
        $str = str_replace("'","`", $str);
        $str = str_replace('"',"'", $str);
        $str = str_replace('*','', $str);
        $str = str_replace('=','', $str);
        $str = str_replace('|','', $str);
        $str = str_replace('$','', $str);
        return trim($str);
        //return mysql_real_escape_string($str);
    }
    function GetEmail($str) {
        return mb_strtolower(GetCleanString($str));
    }

?>