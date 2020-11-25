<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/invite.php');
    
    class DBInvite extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Invites", "");
            $this->strFields = 'idDB,idSalon,idEmployee,strEmail,strPhone,longCode,ageChanged';
            $this->Init("Invites", "");
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idDB", $obj->idDB);
            $this->AddContentValue("idSalon", $obj->idSalon);
            $this->AddContentValue("idEmployee", $obj->idEmployee);
            $this->AddContentValue("strEmail", $obj->strEmail);
            $this->AddContentValue("strPhone", $obj->strPhone);
            $this->AddContentValue("longCode", $obj->longCode);
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
            $obj = new Invite();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->idDB = $row[$i++];
            $obj->idSalon = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->strEmail = $row[$i++];
            $obj->strPhone = $row[$i++];
            $obj->longCode = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }

?>