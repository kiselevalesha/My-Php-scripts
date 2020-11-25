<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/reservationTime.php');
    
    class DBReservationTime extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("ReservationTimes", $idDb);
            $this->Init("ReservationTimes", $idDb);
        }

        public function New() {
            $obj = new ReservationTime();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idEssentialOwner", $obj->idEssentialOwner);
            $this->AddContentValue("idOwner", $obj->idOwner);
            $this->AddContentValue("idType", $obj->idType);
            $this->AddContentValue("idColor", $obj->idColor);
            $this->AddContentValue("idTypeReason", $obj->idTypeReason);
            $this->AddContentValue("idReservationTimeTemplate", $obj->idReservationTimeTemplate);
            $this->AddContentValue("dateTimeDay", $obj->dateTimeDay);
            $this->AddContentValue("intTimeStart", $obj->intTimeStart);
            $this->AddContentValue("intTimeEnd", $obj->intTimeEnd);
            $this->AddContentValue("intMinutesDuration", $obj->intMinutesDuration);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("idNeedSaveInCalendar", $obj->idNeedSaveInCalendar);
            $this->AddContentValue("intMinutesRemind", $obj->intMinutesRemind);
            $this->AddContentValue("idEventCalendar", $obj->idEventCalendar);
            $this->AddContentValue("idSalon", $obj->idSalon);
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
            $obj = new ReservationTime();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idEssentialOwner = $row[$i++];
            $obj->idOwner = $row[$i++];
            $obj->idType = $row[$i++];
            $obj->idColor = $row[$i++];
            $obj->idTypeReason = $row[$i++];
            $obj->idReservationTimeTemplate = $row[$i++];
            $obj->dateTimeDay = $row[$i++];
            $obj->intTimeStart = $row[$i++];
            $obj->intTimeEnd = $row[$i++];
            $obj->intMinutesDuration = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->idNeedSaveInCalendar = $row[$i++];
            $obj->intMinutesRemind = $row[$i++];
            $obj->idEventCalendar = $row[$i++];
            $obj->idSalon = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
        public function MakeJson($obj) {
            return '"id":"'.$obj->id.'",'
                .'"name":"'.$obj->strName.'",'
                .'"description":"'.$obj->strDescription.'",'
                .'"changed":'.$obj->ageChanged;
        }
        
        public function UpdateSave($obj) {
            $sqlWhere = "dateTimeDay=".$obj->dateTimeDay." AND idOwner=".$obj->idOwner." AND idEssentialOwner=".$obj->idEssentialOwner." AND idSalon=".$obj->idSalon.
                " AND intTimeStart=".$obj->intTimeStart." AND intTimeEnd=".$obj->intTimeEnd;
            $base = $this->GetRowBySql($sqlWhere);
            if (!empty($base->id))  $obj->id = $base->id;
            return $this->Save($obj);
        }

    }

?>