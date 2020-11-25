<?
    //require_once '../php-scripts/db/open_db.php';
    require_once '../php-scripts/db/mysqli.php';
    require_once '../php-scripts/db/synchronization/maketable.php';

    abstract class EnumErrors {
        const StrDBErrorCreateTable = "Ошибка создания таблицы: ";
        const StrDBErrorSQL = "Ошибка запроса: ";
        const StrEmptyError = "Не указаны данные: ";
    }

    abstract class EnumIdTables {
        const Adress = 1;
        const Appointments = 2;
        const Messages = 3;
    }

    class DBBase {
        
        public $strDbNameProject = "Online";    //  Общее название проекта. Используется как приставка для всех таблиц в проекте.
        public $strTableNameInitial = "";
        public $strTableName = "";
        public $idDB = 0;
        public $mysql = null;

        public $idTable = 0;        //  идентификатор таблицы EnumIdTables
        public $isChanges = false;  //  флаг, были ли изменения в таблице

        public $strFields;      //  строка, перечисление всех полей
        public $arrayFields;    //  массив полей
        public $arrayValues;    //  массив значений полей
        public $arrayIndexFields = array();   //  массив полей, по которым нужно создать индексы

        public function Init($strTableName, $idDB)
        {
            $this->mysql = new MySqla();
            $this->idDB = $idDB;
            if ($idDB > 0) {
                $strFields = GetStrTableFields($strTableName);
                if (!empty($strFields)) $this->strFields = $strFields;
            }
            $this->SetLocalTableName($strTableName, $idDB);
            $this->CreateTableIfNotExist();
        }
        
        public function GetLocalTableName($strTable, $idDb) {
            $strRet = $strTable;
            if (!empty($idDb))  $strRet .= "_".$idDb;
            return $strRet;
        }
        public function SetLocalTableName($strTableName, $idDB) {
            $this->strTableNameInitial = $strTableName;
            $this->strTableName = $this->GetLocalTableName($this->strDbNameProject.$strTableName, $idDB);
        }
        public function CreateContentValue() {
            $this->arrayFields = array();
            $this->arrayValues = array();
        }
        public function AddContentValue($strField, $strValue) {
            array_push($this->arrayFields, $strField);
            array_push($this->arrayValues, $strValue);
        }
        public function GetUpdateSQL($id) {
            $sql = '';
            for ($i=0; $i < sizeOf($this->arrayFields); $i++) {
                if (strlen($sql) > 0)   $sql .= ',';
                $sql .= $this->arrayFields[$i].'="'.$this->CleanValue($this->arrayValues[$i]).'"';
            }
            if (strlen($sql) > 0)   $sql = 'UPDATE '.$this->strTableName.' SET '.$sql.' WHERE id='.$id;
            return $sql;
        }
        public function GetUpdateSQLWithoutClean($id) {
            $sql = '';
            for ($i=0; $i < sizeOf($this->arrayFields); $i++) {
                if (strlen($sql) > 0)   $sql .= ',';
                $sql .= $this->arrayFields[$i].'="'.$this->EscapeValue($this->arrayValues[$i]).'"';
            }
            if (strlen($sql) > 0)   $sql = 'UPDATE '.$this->strTableName.' SET '.$sql.' WHERE id='.$id;
            return $sql;
        }
        public function GetInsertSQL() {
            $sqlFields = '';
            $sqlValues = '';
            for ($i=0; $i < sizeOf($this->arrayFields); $i++) {
                if (strlen($sqlFields) > 0)   $sqlFields .= ',';
                $sqlFields .= $this->arrayFields[$i];
                
                if (strlen($sqlValues) > 0)   $sqlValues .= ',';
                $sqlValues .= '"'.$this->CleanValue($this->arrayValues[$i]).'"';
            }
            return 'INSERT INTO '.$this->strTableName.' ('.$sqlFields.') VALUES ('.$sqlValues.')';
        }
        public function GetInsertSQLWithoutClean() {
            $sqlFields = '';
            $sqlValues = '';
            for ($i=0; $i < sizeOf($this->arrayFields); $i++) {
                if (strlen($sqlFields) > 0)   $sqlFields .= ',';
                $sqlFields .= $this->arrayFields[$i];
                
                if (strlen($sqlValues) > 0)   $sqlValues .= ',';
                $sqlValues .= '"'.$this->EscapeValue($this->arrayValues[$i]).'"';
            }
            return 'INSERT INTO '.$this->strTableName.' ('.$sqlFields.') VALUES ('.$sqlValues.')';
        }


        public function UpdateField($nameField, $value, $sqlWhere) {
            //$query = 'UPDATE '.$this->strTableName.' SET '.$nameField.'="'.$value.'"';
            $query = "UPDATE ".$this->strTableName." SET ".$nameField."='".$value."'";
            if (!empty($sqlWhere))  $query .= ' WHERE '.$sqlWhere;
            $result = $this->ExecuteQuery($query);
        }
        public function GetIdField($sqlWhere) {
            return $this->GetIntField("id", $sqlWhere);
        }
        public function GetIntField($nameField, $sqlWhere) {
            $id = 0;
            if (!empty($sqlWhere)) {
                $query = "SELECT  ".$nameField."  FROM  ".$this->strTableName." WHERE ".$sqlWhere;
                $result = $this->ExecuteQuery($query);
                if ($result)
                    if ($row = $result->fetch_array(MYSQL_NUM))   $id = $row[0];
            }
            return $id;
        }
        public function GetStringField($nameField, $sqlWhere) {
            $str = "";
            if (!empty($sqlWhere)) {
                $query = "SELECT  ".$nameField."  FROM  ".$this->strTableName." WHERE ".$sqlWhere;
                $result = $this->ExecuteQuery($query);
                if ($result)
                    if ($row = $result->fetch_array(MYSQL_NUM))   $str = $row[0];
            }
            return $str;
        }
        public function GetArrayField($nameField, $sqlWhere, $offset=0, $limit=0) {
            return $this->GetArrayFieldByOrder($nameField, $sqlWhere, "", $offset, $limit);
        }
        public function GetArrayFieldByOrder($nameField, $sqlWhere, $order, $offset=0, $limit=0) {
            $arrayField = array();
            $query = "SELECT  ".$nameField."  FROM  ".$this->strTableName;
            if (!empty($sqlWhere))  $query .= ' WHERE '.$sqlWhere;
            if (!empty($order))  $query .= ' ORDER BY '.$order;
            if ($limit > 0)
                if ($offset >= 0)
                    $query .= ' LIMIT '.$offset.','.$limit;
            $result = $this->ExecuteQuery($query);
            
            if ($result)
                while ($row = $result->fetch_array(MYSQL_NUM)) {
                    
                    //  нужно заменить кавычки на правильные и заменить пустые числовые значения.
                    $str = $row[0];
                    $str = str_replace("'",'"',$str);
                    $str = str_replace(":,",':0,',$str);
                    
                    //  заменяем конечное пустое числовое значение
                    $chr = substr($str, -1);
                    if ($chr == ":")    $str .= '0';
                    
                    array_push($arrayField, $str);
                }
            return $arrayField;
        }
        public function GetJsonRows($sqlWhere, $offset=0, $limit=0) {
            return $this->GetJsonOrderRows($sqlWhere, "", $offset, $limit);
        }
        public function GetJsonOrderRows($sqlWhere, $order, $offset=0, $limit=0) {
            $arrayJsonRows = $this->GetArrayFieldByOrder("strJson", $sqlWhere, $order, $offset, $limit);
            $str = "";
            foreach($arrayJsonRows as $json) {
                $str .= $comma . "{".$json."}";
                $comma = ",";
            }
            return $str;
        }

        public function GetJsonItem($id, $strTitle, $idField="id", $nameField="strName") {
            return $this->GetJsonItemRaw($strTitle, $idField, $nameField, "id=".$id);
        }
        public function GetJsonItemRaw($strTitle, $idField, $nameField, $sqlWhere) {
            $str = "";
            if (!empty($sqlWhere)) {
                $query = "SELECT  ".$idField.",".$nameField."  FROM  ".$this->strTableName." WHERE ".$sqlWhere;
                $result = $this->ExecuteQuery($query);
                if ($result)
                    if ($row = $result->fetch_array(MYSQL_NUM))
                        $str = '"'.$strTitle.'":{"id":'.$row[0].',"name":"'.$row[1].'"}';
            }
            return $str;
        }

        public function CreateTable() {
            $arrayFields = makeArraysField($this->strFields);
            $strSQL = makeStrCreateTable($this->strTableName, $arrayFields);
            $result = $this->ExecuteQuery($strSQL);
        }


        public function ExecuteQuery($query) {
            $result = $this->ExecuteQueryWithoutError($query);
            if (!$result) echo "Error :".$this->mysql->GetError()." - ".$query;
            return $result;
        }
        public function ExecuteQueryWithoutError($query) {
            if (!isSet($this->mysql))   $this->mysql = new MySqla();
            return $this->mysql->ExecuteQuery($query);
        }
        public function GetInsertedId() {
            return mysqli_insert_id($this->mysql->connection);
        }


        public function DBExitError($strError) {
            echo "Ошибка: ".$strError;
            exit; 
        }
    
        public function Save($obj) {}
        public function Get($id) {
            $sqlWhere = "";
            if ($id > 0)    $sqlWhere = "id=".$id;
            return $this->GetRowBySql($sqlWhere);
        }
        public function GetRowBySql($sqlWhere, $sqlOrder='') {
            $base = new Base();
            if (!empty($sqlWhere)) {
                $query = "SELECT  id,".$this->strFields." FROM ".$this->strTableName." WHERE ".$sqlWhere;
                if (! empty($sqlOrder))  $query .= ' ORDER BY '.$sqlOrder;
                $result = $this->ExecuteQuery($query);
                
                if ($result)
                    if ($row = $result->fetch_array(MYSQL_NUM)) {
                        //echo " query=".$query;
                        $base = $this->GetRow($row);
                    }
            }
            return $base;
        }
        public function DeleteRow($id) {
            $this->DeleteRowsBySql('id='.$id);
        }
        public function DeleteRowsBySql($sqlWhere) {
            $query = 'DELETE FROM '.$this->strTableName.' WHERE '.$sqlWhere;
            $result = $this->ExecuteQuery($query);
        }
        public function SetDelete($id, $valueIsDeleted=1) {
            $this->UpdateField("isDeleted", $valueIsDeleted, "id=".$id);
        }
        public function Delete($id, $valueIsDeleted=1) {
            $this->DeleteBySql("id=".$id);
        }
        public function DeleteBySql($sqlWhere, $valueIsDeleted=1) {
            $this->UpdateField("isDeleted", $valueIsDeleted, $sqlWhere);
        }
        public function IsExistTable() {
            return $this->ExecuteQueryWithoutError("DESCRIBE `".$this->strTableName."`");
        }
        public function DropTable($strTable, $idDB) {
            $this->DropLocalTable($this->GetLocalTableName($this->strDbNameProject.$strTable, $idDB));
        }
        public function DropLocalTable($strTableName) {
            if (!empty($strTableName)) {
                $query = "DROP TABLE IF EXISTS ".$strTableName;
                $result =  $this->ExecuteQuery($query);
                if (!$result) $this->DBExitError($this->mysql->error." - ".$query);
                echo " DBBase DropTable $strTableName ";
            }
        }
        public function CreateTableIfNotExist() {
            if (!$this->IsExistTable()) {
                
                //  Создаём таблицу
                $this->CreateTable();

                //  Создаём индексы для созданной таблицы
                for ($i=0; $i < sizeOf($this->arrayIndexFields); $i++) {
                    //"create index idx_username on users(username)";
                    $sql = "create index idx_".$this->arrayIndexFields[$i]." on ".$this->strTableName."(".$this->arrayIndexFields[$i].")";
                    $this->ExecuteQuery($sql);
                }
            }
        }
        
        public function GetArrayRows($sqlWhere) {
            return $this->GetArrayOrderRows($sqlWhere, "");
        }
        
        public function GetArrayOrderRows($sqlWhere, $order) {
            $arrayRows = array();
            
            $query = "SELECT id,".$this->strFields." FROM  ".$this->strTableName;
            if (!empty($sqlWhere))  $query .= ' WHERE '.$sqlWhere;
            if (!empty($order))  $query .= ' ORDER BY '.$order;

            $result = $this->ExecuteQuery($query);
            
            while ($row = $result->fetch_array(MYSQL_NUM)) {
                array_push($arrayRows, $this->GetRow($row));
            }
            return $arrayRows;
        }
        
        public function GetRow($row) {
            $base = new Base();
            return $base;
        }
        
        public function GetItemById($id) {
            include_once('../php-scripts/models/item.php');
            if ($id < 1)    return (new Item());
            return $this->GetItem("id=".$id." AND isDeleted=0");
        }
        public function GetItem($sqlWhere) {
            include_once('../php-scripts/models/item.php');
            $item = new Item();
            if (!empty($sqlWhere)) {
                $query = "SELECT  id,strName  FROM  ".$this->strTableName." WHERE ".$sqlWhere;
                $result = $this->ExecuteQuery($query);
                if ($row = $result->fetch_array(MYSQL_NUM)) {
                    $item->id = $row[0];
                    $item->strName = $row[1];
                }
            }
            return $item;
        }

        
        
        public function Now() {
            $date = new DateTime();
            return $date->getTimestamp();
        }
        
        public function NowLong() {
            $date = new DateTime();
            return $date->format("YmdHis");
        }


        public function GetOnlyDigits($str) {
            $len = mb_strlen($str);
            $strRet = "";
            for ($i=0; $i < $len; $i++) {
                $char = mb_substr($str, $i, 1);
                $num = ord($char);
                if (($num >= ord("0")) && ($num <= ord("9"))) {
                    $strRet .= $char;
                }
            }
            return $strRet;
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
        function EscapeValue($str) {
            /*$str = str_replace("'","\'", $str);
            $str = str_replace('"','\"', $str);
            $str = str_replace('*','\*', $str);
            $str = str_replace('=','\=', $str);
            $str = str_replace('|','\|', $str);
            $str = str_replace('$','\$', $str);
            return trim($str);*/
            return mysqli_real_escape_string($this->mysql->connection, $str);
        }


        public function GetCountRows($sqlWhere) {
            $query = "SELECT id FROM  ".$this->strTableName;
            if (!empty($sqlWhere))  $query .= " WHERE ".$sqlWhere;
            $result = $this->ExecuteQuery($query);
            return $result->num_rows;
        }
        
        public function GetExistTableCountRows($sqlWhere) {
            if ($this->IsExistTable()) {
                $query = "SELECT id FROM  ".$this->strTableName;
                if (!empty($sqlWhere))  $query .= " WHERE ".$sqlWhere;
                $result = $this->ExecuteQuery($query);
                return $this->mysql->mysqli_num_rows($result);
            }
            return 0;
        }


        
        public function GetIdTable() {
            return $this->idTable;
        }
        public function GetFlagChanges() {
            return $this->isChanges;
        }
        public function SetFlagChanges() {
            $this->isChanges = true;
        }
        public function ClearFlagChanges() {
            $this->isChanges = false;
        }
        

        public function GetSimpleCode($str) {
            $ret = 0;
            for ($i=0; $i < strlen($str); $i++)
                $ret = $ret + ord(mb_substr($str, $i, 1));
            return $ret;
        }
        
        public function GetDefaultHost() {
            return 1;
        }



        public function MakeJson($obj) {
            $str = "";
            if (isSet($obj))
                $str = $obj->MakeJson();
            return $str;
        }




        // Сохранить массив
        public function SaveArray($array) {
            foreach ($array as $object)
                    $this->Save($object);
        }
        
        // Взять массив
        public function GetArray($sqlWhere, $offset=0, $maximum=0, $strOrder=null) {
            return $this->GetArrayOrderRows($sqlWhere, $strOrder);
        }

        // Взять Json-массив
        public function GetJsonArray($sqlWhere, $offset=0, $maximum=0, $strOrder=null) {
            $str = "";
            $comma = "";
            $arrayRows = $this->GetArray($sqlWhere, $offset, $maximum, $strOrder);
            foreach ($arrayRows as $object) {
                $str .= $comma ."{". $object->MakeJson()."}";
                $comma = ",";
            }
            return $str;
        }

    }
?>