<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/schedule.php');
    
    class DBSchedule extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Schedule", $idDb);
            $this->strFields = 'isDeleted,idTypeDay,age,intTimeStart,intTimeEnd,idEssentialOwner,idOwner,idSalon,idPlace,idColor,intMaxAppointments,strJson,idEssentialAuthor,idAuthor,ageChanged';
            $this->Init("Schedule", $idDb);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idTypeDay", $obj->idTypeDay);
            $this->AddContentValue("age", $obj->age);
            $this->AddContentValue("intTimeStart", $obj->intTimeStart);
            $this->AddContentValue("intTimeEnd", $obj->intTimeEnd);
            $this->AddContentValue("idEssentialOwner", $obj->idEssentialOwner);
            $this->AddContentValue("idOwner", $obj->idOwner);
            $this->AddContentValue("idSalon", $obj->idSalon);
            $this->AddContentValue("idPlace", $obj->idPlace);
            $this->AddContentValue("idColor", $obj->idColor);
            $this->AddContentValue("intMaxAppointments", $obj->intMaxAppointments);
            $this->AddContentValue("strJson", $obj->MakeJson());
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
        
        public function UpdateSave($obj) {
            $sqlWhere = "age=".$obj->age." AND idOwner=".$obj->idOwner." AND idEssentialOwner=".$obj->idEssentialOwner." AND idSalon=".$obj->idSalon." AND idPlace=".$obj->idPlace;
            $base = $this->GetRowBySql($sqlWhere);
            if (!empty($base->id))  $obj->id = $base->id;
            return $this->Save($obj);
        }

        public function GetRow($row) {
            $obj = new Shedule();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idTypeDay = $row[$i++];
            $obj->age = $row[$i++];
            $obj->intTimeStart = $row[$i++];
            $obj->intTimeEnd = $row[$i++];
            $obj->idEssentialOwner = $row[$i++];
            $obj->idOwner = $row[$i++];
            $obj->idSalon = $row[$i++];
            $obj->idPlace = $row[$i++];
            $obj->idColor = $row[$i++];
            $obj->intMaxAppointments = $row[$i++];
            $obj->strJson = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
        public function MakeJson($obj) {
            return '"id":"'.$obj->id.'",'
                //.'"name":"'.$obj->strName.'",'
                //.'"description":"'.$obj->strDescription.'",'
                .'"changed":'.$obj->ageChanged;
        }
    }

?>