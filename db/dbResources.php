<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/resource.php');
    
    class DBResource extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Resources", $idDb);
            $this->Init("Resources", $idDb);
        }

        public function New() {
            $obj = new Resource();
            $obj->id = $this->Save($obj);
            return $obj;
        }
        
        public function GetResource($id) {
            $obj = new Resource();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }
        
        public function SaveUpdate($obj) {
            if ($obj->id == 0) {
                $obj->id = $this->GetIdField(" LOWER(strName) LIKE '".mb_strtolower($obj->strName)."'");
            }
            return $this->Save($obj);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            //$this->AddContentValue("isDeleted", $obj->isDeleted);
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("strSynonyms", $obj->strSynonyms);
            $this->AddContentValue("strInventoryNumber", $obj->strInventoryNumber);
            $this->AddContentValue("strBarCode", $obj->strBarCode);
            $this->AddContentValue("idSalon", $obj->idSalon);
            $this->AddContentValue("idPlace", $obj->idPlace);
            $this->AddContentValue("idCategory", $obj->idCategory);
            $this->AddContentValue("idMainPhoto", $obj->idMainPhoto);
            $this->AddContentValue("intMinutesDuration", $obj->intMinutesDuration);
            $this->AddContentValue("isHaveAppointments", $obj->isHaveAppointments);
            $this->AddContentValue("isUse", $obj->isUse);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id == 0) {
                $this->AddContentValue("isDeleted", $obj->isDeleted);
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
            $obj = new Resource();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->strName = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->strSynonyms = $row[$i++];
            $obj->strInventoryNumber = $row[$i++];
            $obj->strBarCode = $row[$i++];
            $obj->idSalon = $row[$i++];
            $obj->idPlace = $row[$i++];
            $obj->idCategory = $row[$i++];
            $obj->idMainPhoto = $row[$i++];
            $obj->intMinutesDuration = $row[$i++];
            $obj->isHaveAppointments = $row[$i++];
            $obj->isUse = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }

?>