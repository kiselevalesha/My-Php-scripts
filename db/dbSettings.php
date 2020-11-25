<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/settings.php');
    
    class DBSettings extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Settings", $idDb);
            $this->strFields = 'intMaxCountMasters,intMaxCountAssistents,isShowTips,isUseAudio,
            idTypeTematic,idTypeConfiguration,idTypeFunctionality,
            isUseOnlineAppointment,isChoosePlace,isChooseMasters,isChooseResources,
            ageLastShowAppointments, ageLastShowReviews, ageLastShowSupport, ageLastShowClients, ageLastShowVendors, ageLastShowEmployee,
            intTimeStart,intTimeEnd,intCountDaysForAppointments,intMinutesWaiting,intPeriodMinutes,intBetweenMinutes,intBeforeMinutes,ageChanged';
            $this->Init("Settings", $idDb);
        }

        public function GetDefault() {
            if ($this->GetCountRows("") == 0) {
                return new Settings();
            }
            return $this->Get(1);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("intMaxCountMasters", $obj->intMaxCountMasters);
            $this->AddContentValue("intMaxCountAssistents", $obj->intMaxCountAssistents);
            $this->AddContentValue("isShowTips", $obj->isShowTips);
            $this->AddContentValue("isUseAudio", $obj->isUseAudio);
            $this->AddContentValue("idTypeTematic", $obj->idTypeTematic);
            $this->AddContentValue("idTypeConfiguration", $obj->idTypeConfiguration);
            $this->AddContentValue("idTypeFunctionality", $obj->idTypeFunctionality);
            $this->AddContentValue("isUseOnlineAppointment", $obj->isUseOnlineAppointment);
            $this->AddContentValue("isChoosePlace", $obj->isChoosePlace);
            $this->AddContentValue("isChooseMasters", $obj->isChooseMasters);
            $this->AddContentValue("isChooseResources", $obj->isChooseResources);
            //$this->AddContentValue("isShowAdress", $obj->isShowAdress);
            //$this->AddContentValue("isGenerateQRCode", $obj->isGenerateQRCode);
            
            $this->AddContentValue("ageLastShowAppointments", $obj->ageLastShowAppointments);
            $this->AddContentValue("ageLastShowReviews", $obj->ageLastShowReviews);
            $this->AddContentValue("ageLastShowSupport", $obj->ageLastShowSupport);
            $this->AddContentValue("ageLastShowClients", $obj->ageLastShowClients);
            $this->AddContentValue("ageLastShowVendors", $obj->ageLastShowVendors);
            $this->AddContentValue("ageLastShowEmployee", $obj->ageLastShowEmployee);

            $this->AddContentValue("intTimeStart", $obj->intTimeStart);
            $this->AddContentValue("intTimeEnd", $obj->intTimeEnd);
            $this->AddContentValue("intCountDaysForAppointments", $obj->intCountDaysForAppointments);
            $this->AddContentValue("intMinutesWaiting", $obj->intMinutesWaiting);
            $this->AddContentValue("intPeriodMinutes", $obj->intPeriodMinutes);
            $this->AddContentValue("intBetweenMinutes", $obj->intBetweenMinutes);
            $this->AddContentValue("intBeforeMinutes", $obj->intBeforeMinutes);
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
            $obj = new Settings();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->intMaxCountMasters = $row[$i++];
            $obj->intMaxCountAssistents = $row[$i++];
            $obj->isShowTips = $row[$i++];
            $obj->isUseAudio = $row[$i++];
            $obj->idTypeTematic = $row[$i++];
            $obj->idTypeConfiguration = $row[$i++];
            $obj->idTypeFunctionality = $row[$i++];
            $obj->isUseOnlineAppointment = $row[$i++];
            $obj->isChoosePlace = $row[$i++];
            $obj->isChooseMasters = $row[$i++];
            $obj->isChooseResources = $row[$i++];
            //$obj->isShowAdress = $row[$i++];
            //$obj->isGenerateQRCode = $row[$i++];
            
            $obj->ageLastShowAppointments = $row[$i++];
            $obj->ageLastShowReviews = $row[$i++];
            $obj->ageLastShowSupport = $row[$i++];
            $obj->ageLastShowClients = $row[$i++];
            $obj->ageLastShowVendors = $row[$i++];
            $obj->ageLastShowEmployee = $row[$i++];

            $obj->intTimeStart = $row[$i++];
            $obj->intTimeEnd = $row[$i++];
            $obj->intCountDaysForAppointments = $row[$i++];
            $obj->intMinutesWaiting = $row[$i++];
            $obj->intPeriodMinutes = $row[$i++];
            $obj->intBetweenMinutes = $row[$i++];
            $obj->intBeforeMinutes = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }

?>