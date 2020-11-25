<?
    require_once('../php-scripts/db/dbBase.php');
    require_once('../php-scripts/models/group.php');
    require_once('../php-scripts/models/essential.php');
    
    class DBGroup extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Groups", $idDb);
            $this->Init("Groups", $idDb);
        }

        public function New() {
            $obj = new Group();
            //$obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetGroup($id) {
            $obj = new Group();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            //$this->AddContentValue("isDeleted", $obj->isDeleted);
            $this->AddContentValue("idEssential", $obj->idEssential);
            $this->AddContentValue("idType", $obj->idType);
            $this->AddContentValue("idColor", $obj->idColor);
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id < 1) {
                $this->AddContentValue("isDeleted", $obj->isDeleted);
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
            $obj = new Group();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idEssential = $row[$i++];
            $obj->idType = $row[$i++];
            $obj->idColor = $row[$i++];
            $obj->strName = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

    }
?>