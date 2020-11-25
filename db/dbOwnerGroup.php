<?
    require_once '../php-scripts/db/dbBase.php';
    require_once '../php-scripts/db/dbGroups.php';
    require_once '../php-scripts/models/group.php';
    
    class DBOwnerGroup extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("OwnersGroups", $idDb);
            $this->Init("OwnersGroups", $idDb);
        }

        public function New() {
            $obj = new Group();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            //$this->AddContentValue("isDeleted", $obj->isDeleted);
            $this->AddContentValue("idEssential", $obj->idEssential);
            $this->AddContentValue("idOwner", $obj->idOwner);
            $this->AddContentValue("idGroup", $obj->idGroup);
            $this->AddContentValue("isChecked", $obj->isChecked);
            $this->AddContentValue("isAutoCreated", $obj->isAutoCreated);
            $this->AddContentValue("idGroupRule", $obj->idGroupRule);
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

        public function GetId($obj) {
            return $this->GetIdField("idOwner=".$obj->idOwner." AND idGroup=".$obj->idGroup." AND idEssential=".$obj->idEssential);
        }

        public function SaveUpdate($obj) {
            $obj->id = $this->GetId($obj);
            return $this->Save($obj);
        }

        public function GetRow($row) {
            $obj = new Group();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idEssential = $row[$i++];
            $obj->idOwner = $row[$i++];
            $obj->idGroup = $row[$i++];
            $obj->isChecked = $row[$i++];
            $obj->isAutoCreated = $row[$i++];
            $obj->idGroupRule = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function GetArrayGroups($idOwner=0, $idEssential=0, $idType=0) {
            $dbGroup = new DBGroup($this->idDB);
            $sqlWhere = "isDeleted=0";
            if (!empty($idEssential))
                $sqlWhere .= " AND idEssential=".$idEssential;
            if (!empty($idType))
                $sqlWhere .= " AND idType=".$idType;
            $arrayRows = $dbGroup->GetArrayOrderRows($sqlWhere, "strName");

            foreach($arrayRows as $row) 
                if ($row->id > 0) {
                    $row->idGroup = $row->id;

                    $ownerGroup = $this->GetRowBySql("idOwner=".$idOwner." AND idEssential=".$row->idEssential." AND idGroup=".$row->id." AND isDeleted=0");
                    if ($ownerGroup->isChecked) $row->isChecked = 1;
                    else                        $row->isChecked = 0;
                }

            return $arrayRows;
        }
    }

?>