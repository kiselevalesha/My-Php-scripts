<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/supportTalk.php');
    
    class DBSupportTalk extends DBBase {

        public function __construct()
        {
            //$this->DropTable("SupportTalks", "");
            $this->strFields = 'idDB, idTalk, idEssential, ageChanged';
            $this->arrayIndexFields = array("ageChanged");
            $this->Init("SupportTalks", "");
        }

        public function Save($talk) {
            $this->CreateContentValue();
            $this->AddContentValue("idDB", $talk->idDB);
            $this->AddContentValue("idTalk", $talk->idTalk);
            $this->AddContentValue("idEssential", $talk->idEssential);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($talk->id == 0) {
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($talk->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($talk->id == 0)   $talk->id = $this->GetInsertedId();
            return $talk->id;
        }
        
        public function SaveUpdate($idDB, $idTalk, $idEssential) {
            $id = $this->GetIdField("idDB=".$idDB." AND idTalk=".$idTalk);
            if ($id > 0) {
                $this->UpdateField("idEssential", $idEssential, "id=".$id);
                $this->UpdateField("ageChanged", $this->NowLong(), "id=".$id);
            }
            else {
                $talk = new SupportTalk();
                $talk->idDB = $idDB;
                $talk->idTalk = $idTalk;
                $talk->idEssential = $idEssential;
                $id = $this->Save($talk);
            }
            return $id;
        }

        public function GetRow($row) {
            $obj = new Talk();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->idDB = $row[$i++];
            $obj->idTalk = $row[$i++];
            $obj->idEssential = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }
?>