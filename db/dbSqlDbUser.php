<?
    require_once('../php-scripts/db/dbBase.php');
    require_once('../php-scripts/models/sqldbUser.php');

    class DBSqlDBUser extends DBBase {

        public function __construct()
        {
            $this->strFields = 'idTokenUser,ageChanged';
            $this->arraIndexFields = array("idTokenUser");
            //$this->Init("Sqldbs", "");
        }

        public function New() {
            $obj = new SqlDBUser();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idTokenUser", $obj->idTokenUser);
            $this->AddContentValue("ageChanged", $this->NowLong());

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
            $obj = new SqlDBUser();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->idTokenUser = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
        public function MakeJson($obj) {
            return $obj->MakeJson();
        }
    }

?>