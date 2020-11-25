<?php
    require_once '../php-scripts/db/synchronization/tables.php';

    function makeArraysField($strFieldz) {
        
        $arrayFields = array();
    
        $iStart = 0;
        $iEnd = 0;
        do {
                $iStart = $iEnd;
                $iEnd = strpos($strFieldz, ",", $iStart);
                //echo("iStart=".$iStart."  iEnd=".$iEnd."<br>");
                if ($iEnd > -1) {
                    $strField = trim(substr($strFieldz, $iStart, ($iEnd - $iStart)));
                    //echo("strField=".$strField."<br>");
                    array_push($arrayFields, $strField);
                    $iEnd = $iEnd + 1;
                }
                else if ($iStart > 0) {
                    $strField = trim(substr($strFieldz, $iStart, strlen($strFieldz)));
                    //echo("strField=".$strField."<br>");
                    array_push($arrayFields, $strField);
                }
            
        } while($iEnd > -1);
        
        return $arrayFields;
    }

    function makeStrCreateField($strField) {
        $iStart = strpos($strField, "str");
        if ($iStart === 0)   return $strField." TEXT";      //BLOB
    
        $iStart = strpos($strField, "id");
        if ($iStart === 0)   return $strField." INTEGER";
        $iStart = strpos($strField, "int");
        if ($iStart === 0)   return $strField." INTEGER";
    
        $iStart = strpos($strField, "is");
        if ($iStart === 0)   return $strField." BOOLEAN";
        $iStart = strpos($strField, "flag");
        if ($iStart === 0)   return $strField." BOOLEAN";
    
        $iStart = strpos($strField, "age");
        if ($iStart === 0)   return $strField." BIGINT";
        $iStart = strpos($strField, "dateTime");
        if ($iStart === 0)   return $strField." BIGINT";
        $iStart = strpos($strField, "date");
        if ($iStart === 0)   return $strField." BIGINT";
        $iStart = strpos($strField, "long");
        if ($iStart === 0)   return $strField." BIGINT";
        
        $iStart = strpos($strField, "float");
        if ($iStart === 0)   return $strField." REAL";
        $iStart = strpos($strField, "cost");
        if ($iStart === 0)   return $strField." INTEGER";
        $iStart = strpos($strField, "summa");
        if ($iStart === 0)   return $strField." INTEGER";
    }
    
    function makeStrCreateTable($strTableName, $arrayFields) {
        $strTable = "CREATE TABLE ".$strTableName." (id INTEGER not null primary key auto_increment, ";
        $strFields = "";
        
        foreach ($arrayFields as $strField) {
            if (strlen($strFields) > 0) {
                $strFields = $strFields . ", ";
            }
            //echo("<br>strField =".$strField);
            $strFields = $strFields . makeStrCreateField($strField);
        }
    
        $strTable = $strTable . $strFields . ")";
        return $strTable;
    }


    function GetStrTableFields($strTableName) {
        global $arrayTables, $arrayTableFields;
        $strTableNameLowerCase = strtolower($strTableName);
        
        for ($i = 0; $i < count($arrayTables); $i++) {
            if (strcmp(strtolower($arrayTables[$i]), $strTableNameLowerCase) == 0) {
                return $arrayTableFields[$i];
            }
        }
        return "";
    }

?>