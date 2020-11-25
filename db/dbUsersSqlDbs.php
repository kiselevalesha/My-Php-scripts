<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/userSqldb.php');

    // Это общая таблица (для Employee и Clients разные), где хранится информация какой юзер (TokenUser) к какой DB имеет доступ. И какой именно доступ.
     
    class DBUserSqlDb extends DBBase {

        public function __construct()
        {
            $this->strFields = 'idToken,idSqlDb,idAccessProfile, isCanSeeAppointments,isCanChangeAppointments, isCanSeeClients,isCanChangeClients, ageChanged';
            $this->arraIndexFields = array("idToken", "idSqlDb");
            //$this->Init("UserSqlDb", $idDb);
        }

        public function Update($idToken, $idSqlDb) {
            $obj = new UserSqldb();
            $obj->idToken = $idToken;
            $obj->idSqlDb = $idSqlDb;
            $obj->id = $this->GetId($obj);
            if ($obj->id < 1)   $obj->id = $this->Save($obj);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idToken", $obj->idToken);
            $this->AddContentValue("idSqlDb", $obj->idSqlDb);
            $this->AddContentValue("idAccessProfile", $obj->idAccessProfile);
            
            $this->AddContentValue("isCanSeeAppointments", $obj->isCanSeeAppointments);
            $this->AddContentValue("isCanChangeAppointments", $obj->isCanChangeAppointments);
            $this->AddContentValue("isCanSeeClients", $obj->isCanSeeClients);
            $this->AddContentValue("isCanChangeClients", $obj->isCanChangeClients);
            
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id == 0) {
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($obj->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($obj->id == 0)   $obj->id = $this->GetInsertedId();
            return $obj->id;
        }

        public function GetRow($row) {
            $obj = new UserSqldb();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->idToken = $row[$i++];
            $obj->idSqlDb = $row[$i++];
            
            $obj->idAccessProfile = $row[$i++];
            
            $obj->isCanSeeAppointments = $row[$i++];
            $obj->isCanChangeAppointments = $row[$i++];
            $obj->isCanSeeClients = $row[$i++];
            $obj->isCanChangeClients = $row[$i++];
            // ...
            
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function GetId($obj) {
            return $this->GetIdField("idToken=".$obj->idToken." AND idSqlDb=".$obj->idSqlDb);
        }

        public function SaveUpdate($obj) {
            $obj->id = $this->GetId($obj);
            return $this->Save($obj);
        }
        
    }

?>