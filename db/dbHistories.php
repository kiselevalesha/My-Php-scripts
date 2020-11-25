<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/history.php');
    
    class DBHistory extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("History", $idDb);
            $this->strFields = 'isDeleted,idEssential,idAction,strJson,ageChanged';
            $this->arraIndexFields = array("idEssential, idAction");
            $this->Init("History", $idDb);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idEssential", $obj->idEssential);
            $this->AddContentValue("idAction", $obj->idAction);
            $this->AddContentValue("strJson", $obj->strJson);
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
            $obj = new History();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idEssential = $row[$i++];
            $obj->idAction = $row[$i++];
            $obj->strJson = htmlspecialchars_decode($row[$i++]);
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function Add($idAction, $idEssential, $json='') {
            $obj = new History();
            $obj->idAction = $idAction;
            $obj->idEssential = $idEssential;
            $obj->strJson = htmlspecialchars($json);
            return $this->Save($obj);
        }
        
        public function GetJsonObjectFromRecentRow($history) {
            $str = '{"tables":['.$history->strJson.']}';
            return json_decode($str, false, 32);
        }
        public function GetRecentRow() {
            $row = $this->GetRowBySql('isDeleted=0', 'id DESC');
            $this->Delete($row->id);
            return $row;
        }

    }

?>