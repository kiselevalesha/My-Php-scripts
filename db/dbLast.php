<?
    require_once('../php-scripts/db/dbBase.php');
    require_once('../php-scripts/models/last.php');

    require_once('../php-scripts/db/dbSalons.php');
    require_once '../php-scripts/utils/getUrlFile.php';
    
    class DBLast extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("LastChanges", $idDb);
            $this->strFields = 'idTable,ageChanged';
            $this->arraIndexFields = array("idTable");
            $this->Init("LastChanges", $idDb);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idTable", $obj->idTable);
            $this->AddContentValue("ageChanged", $obj->ageChanged);
            //$this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id < 1) {
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($obj->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($obj->id < 1)   $obj->id = $this->GetInsertedId();
            return $obj->id;
        }

        public function GetRow($row) {
            $obj = new Bill();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->idTable = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function SetLastChanged($idTable, $idSalon) {
            if ($idTable < 1)   return 0;
            
            $last = $this->NowLong();
            $this->UpdateField("ageChanged", $last, "idTable=".$idTable);
            
            //  Если обновляется таблица Записей, то нужно установить флаг в Firebase об изменениях в Записях
            if ($idTable == EnumIdTables::Appointments) {
                $uid = $this->GetUidSalonFirebase($idSalon);
                return $this->UpdateLastAppointmentsFirebase($uid);
            }
            //  Если обновляется таблица Сообщений, то нужно установить флаг в Firebase об изменениях в Сообщениях
            elseif ($idTable == EnumIdTables::Messages) {
                $uid = "";      //  Сделай потом правильно !!!
                return $this->UpdateLastMessagesFirebase($uid);
            }
            else {
                //  Об изменениях в остальных таблицах сообщать смотря по конфигурации текущего салона
                //  ...
            }

            return $last;
        }
        public function SetLastChangedSupport($idSalon = 1) {
            $uid = $this->GetUidSalonFirebase($idSalon);
            $age = $this->NowLong();
            $response = getUrlFile("https://us-central1-onlinezapis-b03a2.cloudfunctions.net/UpdateLastSupport?uid=".$uid."&age=".$age, null);
            $jsonFirebase = json_decode($response, false, 32);
            
            if (isSet($jsonFirebase->status->id))
                if ($jsonFirebase->status->id == 200)
                    if (isSet($jsonFirebase->data->age))  return $jsonFirebase->data->age;
                    
            return "";
        }
        //  Обновить в appointments->uid в Firebase свойство last - дата последнего обновления
        function UpdateLastAppointmentsFirebase($uid) {
            
            $age = $this->NowLong();
            $response = getUrlFile("https://us-central1-onlinezapis-b03a2.cloudfunctions.net/UpdateLastAppointments?uid=".$uid."&age=".$age, null);
            $jsonFirebase = json_decode($response, false, 32);
            
            if (isSet($jsonFirebase->status->id))
                if ($jsonFirebase->status->id == 200)
                    if (isSet($jsonFirebase->data->age))  return $jsonFirebase->data->age;
                    
            return "";
        }
        //  Обновить в messages->uid в Firebase свойство last - дата последнего обновления
        function UpdateLastMessagesFirebase($uid) {
            
            $age = $this->NowLong();
            $response = getUrlFile("https://us-central1-onlinezapis-b03a2.cloudfunctions.net/UpdateLastMessages?uid=".$uid."&age=".$age, null);
            $jsonFirebase = json_decode($response, false, 32);
            
            if (isSet($jsonFirebase->status->id))
                if ($jsonFirebase->status->id == 200)
                    if (isSet($jsonFirebase->data->age))  return $jsonFirebase->data->age;
                    
            return "";
        }


        public function GetLastChanged($idTable) {
            return $this->GetIntField("ageChanged", "idTable="+$idTable);
        }
                
        public function MakeJson($obj) {
            return '"id":"'.$obj->id.'",'
                .'"table":'.$obj->idTable.','
                .'"changed":'.$obj->ageChanged;
        }
        
        function GetSalon($idSalon) {
            $dbSalon = new DBSalon($this->idDB);
            if ($idSalon < 1)   $idSalon = $dbSalon->GetIdDefault();
            return $dbSalon->Get($idSalon);
        }
        function GetUidSalonFirebase($idSalon) {
            $salon = $this->GetSalon($idSalon);
            return $salon->strFirebase;
        }
    }

?>