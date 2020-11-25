<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/addedToDB.php');
    
    class DBAddedToDB extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("AddedToDBs", $idDb);
            $this->Init("AddedToDBs", $idDb);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idHost", $obj->idHost);
            $this->AddContentValue("idDB", $obj->idDB);
            $this->AddContentValue("idSalon", $obj->idSalon);
            $this->AddContentValue("idEmployee", $obj->idEmployee);
            $this->AddContentValue("isAdded", $obj->isAdded);
            $this->AddContentValue("intPinCode", $obj->intPinCode);
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
            $obj = new AddedToDB();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->idHost = $row[$i++];
            $obj->idDB = $row[$i++];
            $obj->idSalon = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->isAdded = $row[$i++];
            $obj->intPinCode = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }

?>