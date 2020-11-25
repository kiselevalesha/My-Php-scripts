<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/log.php');
    
    class DBLog extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Log", $idDb);

            $this->strFields = 'isDeleted,idDevice,idActivity,strActivity,idPage,strPage,idEvent,strEvent,idUI,strUI,idType,idStatus,strBody,ageChanged';
            //$this->arraIndexFields = array("longCode");
            $this->Init("Log", $idDb);
        }

        public function Add($idStatus, $strBody) {
            $log = new Log();
            $log->idStatus = $idStatus;
            $log->strBody = $strBody;
            $log->id = $this->Save($log);
            return $log;
        }

        public function Save($log) {
            $this->CreateContentValue();
            $this->AddContentValue("idDevice", $log->idDevice);
            $this->AddContentValue("idActivity", $log->idActivity);
            $this->AddContentValue("strActivity", $log->strActivity);
            $this->AddContentValue("idPage", $log->idPage);
            $this->AddContentValue("strPage", $log->strPage);
            $this->AddContentValue("idEvent", $log->idEvent);
            $this->AddContentValue("strEvent", $log->strEvent);
            $this->AddContentValue("idUI", $log->idUI);
            $this->AddContentValue("strUI", $log->strUI);
            $this->AddContentValue("idType", $log->idType);
            $this->AddContentValue("idStatus", $log->idStatus);
            $this->AddContentValue("strBody", $log->strBody);

            if ($log->id == 0) {
                $this->AddContentValue("isDeleted", $log->isDeleted);
                $this->AddContentValue("ageChanged", $this->NowLong());
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($log->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($log->id == 0)   $log->id = mysqli_insert_id($this->mysql->connection);
            return $log->id;
        }

        public function GetRow($row) {
            $obj = new Log();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idDevice = $row[$i++];
            $obj->idActivity = $row[$i++];
            $obj->strActivity = $row[$i++];
            $obj->idPage = $row[$i++];
            $obj->strPage = $row[$i++];
            $obj->idEvent = $row[$i++];
            $obj->strEvent = $row[$i++];
            $obj->idUI = $row[$i++];
            $obj->strUI = $row[$i++];
            $obj->idType = $row[$i++];
            $obj->idStatus = $row[$i++];
            $obj->strBody = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }

?>