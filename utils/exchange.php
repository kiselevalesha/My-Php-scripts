<?
    require_once '../php-scripts/utils/utils.php';
    require_once '../php-scripts/db/synchronization/tables.php';

    require_once('../php-scripts/db/dbBase.php');
    $dbBase = new DBBase();
    

    function DeletionDB($idDB) {
        global $arrayTables, $dbBase;
        
        if ($idDB > 0) {
            for ($i=0; $i < sizeOf($arrayTables); $i++) {
                $tableName = $arrayTables[$i];
                $dbBase->DropTable($tableName, $idDB);
            }
        }
        return $i;
    }





    function ExportDB($idDB, $path = "export") {
        global $arrayTables;
        
        $year = date("Y");
        $month = date("n");
        $day = date("d");
        
        makeDir($path);
        $path = $path."/".$year;
        makeDir($path);
        $path = $path."/".GetTwoNumbers($month);
        makeDir($path);
        $path = $path."/".GetTwoNumbers($day);
        makeDir($path);
    
    
        if ($idDB > 0) {
            $filename = $path."/".$idDB.".json";
            //if (is_writable($filename)) {
    
                if (!$handle = fopen($filename, 'a')) {
                     echo "Cannot open file ($filename)";
                     exit;
                }
                ftruncate($handle, 0);
                
                $content = '{"tables":['."\n";
                if (fwrite($handle, $content) === FALSE) {
                    echo "Cannot write to file ($filename)";
                    exit;
                }
                
                
                for ($i=0; $i < sizeOf($arrayTables); $i++) {
                    $tableName = $arrayTables[$i];
    
                    $jsonTable = ExportTable($tableName, $idDB);
                    if (!empty($jsonTable)) {
                        $content = $comma.'{"name":"'.$tableName.'","rows":['.$jsonTable."\n".']}';
                        
                        if (fwrite($handle, $content) === FALSE) {
                            echo "Cannot write to file ($filename)";
                            exit;
                        }
                        
                        $comma = ','."\n";
                    }
                }
    
                $content = "\n".']}';
                if (fwrite($handle, $content) === FALSE) {
                    echo "Cannot write to file ($filename)";
                    exit;
                }
    
                fclose($handle);
            //}
        }
        return $filename;
    }

    function ExportTable($tableName, $idDB) {
        global $dbBase;
        $dbBase->strTableName = "online".$tableName.'_'.$idDB;
        if ($dbBase->IsExistTable()) {
            $result = $dbBase->ExecuteQuery("SELECT * FROM ".$dbBase->strTableName);
            if ($result)
                while ($row = $result->fetch_array(MYSQL_NUM)) {
                    
                    $strJsonRow .= $commaBig."\n".' {';
                    
                    $counts = sizeOf($row);
                    $comma = '';
                    $fields = $result->fetch_fields();
                    for ($i=0; $i < $counts; $i++) {
                        //$strJsonRow .= $comma.'"'.mysql_field_name($result, $i).'":"'.$row[$i].'"';
                        //$strJsonRow .= $comma.'"'.$result->fetch_fields()->name.'":"'.$row[$i].'"';
                        $strJsonRow .= $comma.'"'.$fields[$i]->name.'":"'.$row[$i].'"';
                        $comma = ',';
                    }
                    
                    $strJsonRow .= '}';
                    $commaBig = ',';
                }
        }
        return $strJsonRow;
    }

    function makeDir($path) {
        return is_dir($path) || mkdir($path);
    }

?>