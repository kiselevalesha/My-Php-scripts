<?
    require_once('../php-scripts/db/dbBase.php');
    require_once('../php-scripts/models/talk.php');
    
    class DBTalk extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Talks", $idDb);
            $this->strFields = 'isDeleted,strUidFirebase,intCodeUidFirebase,idHost, idEssential1,id1, idEssential2,id2, intCountMessages, strJson, ageChanged';
            $this->arrayIndexFields = array("id1", "id2", "intCodeUidFirebase");
            $this->Init("Talks", $idDb);
        }

        public function Save($talk) {
            //if (strlen($talk->strUidFirebase) == 0) return 0;
            $this->CreateContentValue();
            $this->AddContentValue("strUidFirebase", $talk->strUidFirebase);
            $this->AddContentValue("intCodeUidFirebase", $this->GetSimpleCode($talk->intCodeUidFirebase));
            
            $this->AddContentValue("idHost", $talk->idHost);

            $this->AddContentValue("idEssential1", $talk->idEssential1);
            $this->AddContentValue("id1", $talk->id1);

            $this->AddContentValue("idEssential2", $talk->idEssential2);
            $this->AddContentValue("id2", $talk->id2);

            $this->AddContentValue("intCountMessages", $talk->intCountMessages);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($talk->id == 0) {
                $this->AddContentValue("isDeleted", $talk->isDeleted);
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($talk->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($talk->id == 0)   $talk->id = $this->GetInsertedId();
            return $talk->id;
        }

        public function GetRow($row) {
            $obj = new Talk();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->strUidFirebase = $row[$i++];
            $obj->intCodeUidFirebase = $row[$i++];
            $obj->idHost = $row[$i++];
            
            $obj->idEssential1 = $row[$i++];
            $obj->id1 = $row[$i++];

            $obj->idEssential2 = $row[$i++];
            $obj->id2 = $row[$i++];

            $obj->intCountMessages = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function DateUpdate($idTalk) {
            if ($idTalk > 0)
                $this->UpdateField("ageChanged", $this->NowLong(), "id=".$idTalk);
        }

        public function GetIdTalk($idEssential1,$id1, $idEssential2,$id2) {
            $idTalk = 0;
            $strWhere1 = "id1=".$id1." AND id2=".$id2." AND idEssential1=".$idEssential1." AND idEssential2=".$idEssential2." AND isDeleted=0";
            $strWhere2 = "id1=".$id2." AND id2=".$id1." AND idEssential1=".$idEssential2." AND idEssential2=".$idEssential1." AND isDeleted=0";
            $idTalk = $this->GetIdField('('.$strWhere1.') OR ('.$strWhere2.')');
            return $idTalk;
        }
        
        public function CreateUpdateIdTalk($idEssential1,$id1, $idEssential2,$id2) {
            $idTalk = $this->GetIdTalk($idEssential1,$id1, $idEssential2,$id2);
            if ($idTalk == 0)   $idTalk = $this->CreateIdTalk($idEssential1,$id1, $idEssential2,$id2);
            return $idTalk;
        }
        public function CreateIdTalk($idEssential1,$id1, $idEssential2,$id2) {
            $talk = new Talk();
            $talk->idEssential1 = $idEssential1;
            $talk->id1 = $id1;
            $talk->idEssential2 = $idEssential2;
            $talk->id2 = $id2;
            $talk->idHost = $this->GetDefaultHost();
            $idTalk = $this->Save($talk);
            return $idTalk;
        }
        
        
        public function GetIdSupportTalk() {
            require_once('../php-scripts/models/essential.php');
            return $this->CreateUpdateIdTalk(EnumEssential::SUPPORT, 0, EnumEssential::SALONS, 0);
        }
    }
?>