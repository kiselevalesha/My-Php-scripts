<?
    function ExitEmptyError($strError) {
        ExitError(101, $strError);
    }
    function ExitError($idError, $strError) {
        global $dbLog;
        if (!empty($dbLog))     $dbLog->Add($idError, $strError);
        
        $str = "{".GetOutJsonStatus($idError, $strError).'}';
        echo $str;
        exit;
    }
    
    function EndResponseListObjects($strJson) {
        EndResponsePureData('"objects":['.$strJson.']');
    }
    function EndResponseListData($strTitle, $strJson) {
        EndResponsePureData('"'.$strTitle.'":['.$strJson.']');
    }
    function EndResponseData($strTitle, $strJson) {
        EndResponsePureData('"'.$strTitle.'":{'.$strJson.'}');
    }
    function EndResponsePureData($strJson) {
        $str = GetOutJsonStatus(200, "OK200").',"data":{'.$strJson.'},'.GetOutJsonInstructions();
        echo '{'.$str.'}';

        global $dbLog;
        if (!empty($dbLog))     $dbLog->Add(2002, $str);
        
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
    
    //  Распарсить передаваемый набор id-ов и создать из них sql-выражение. Сделай потом !
    function GetSQLSetOfIds($arrayIds, $strDefault="isNew=0 AND isDeleted=0 ") {
        $str = $strDefault;
        
        if (isSet($arrayIds)) {
            if (sizeOf($arrayIds) == 1) {
                $id = GetInt($arrayIds[0]);
                if ($id > 0)    $str = "id=".$id;
            }
            elseif (sizeOf($arrayIds) > 1) {
                
                //  Выберем только числовые значения. Вдруг там какая ерунда прилетела...
                $arrayNums = array();
                foreach($arrayIds as $num) {
                    $id = GetInt($num);
                    if ($id > 0) array_push($arrayNums, $id);
                }
                
                //  Если набралось таких значений больше, чем 0, то соберём из них sql-оператор.
                if (sizeOf($arrayNums) > 0) {
                    $comma = "";
                    $ztr = "";
                    foreach($arrayNums as $num) {
                        $ztr .= $comma . $num;
                        $comma = ",";
                    }
                    
                    if (!empty($str))   $str .= " AND ";
                    $str .= " id IN (" . $ztr . ")";
                }
            }
        }

        //  -   когда массив пустой
        //  -   когда передан набор ids
        //  -   когда передан диапазон 24-78;
        return $str;
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
            if (strlen($num) == 0)  $ret = 0;
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
    
    function IsRequestForNewObject($request) {
        $flagCreateNew = false;
        if (isSet($request->ids))
            if (sizeOf($request->ids) == 1)
                if (($request->ids[0] == 0) || ($request->ids[0] == -1))
                    $flagCreateNew = true;
        return $flagCreateNew;
    }

?>