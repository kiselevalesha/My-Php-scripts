<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/urlAppointment.php');
    
    class DBUrlAppointment extends DBBase {

        public function __construct()
        {
            //$this->DropTable("UrlAppointments", "");

            $this->strFields = 'isDeleted,idDB,idSalon,idDepartment,idEmployee,isCanChangeGivenParameters,
            strUrlNamed,intCodeUrl,strUrlDigital,
            isShowAdress,isGenerateQRCode,isUseAudio,
            isRequireAccepted,intMinutesWaiting,
            intPeriodMinutes,intBetweenMinutes,intBeforeMinutes,
            isCanUseAuthorisation,isRequirePhone,isRequireEmail,isRequireName,isShowCommentField,
            isUseOneTotalTime,intTotalTimeMinutes,
            isUse,isSendedNotification,isForecastOptions,isShowReminders, ageChanged';
            
            $this->arraIndexFields = array("intCodeUrl");
            $this->Init("UrlAppointments", "");
        }

        public function New($idDB) {
            $obj = new UrlAppointment();
            $obj->idDB = $idDB;
            $obj->idSalon = 1;
            $obj->idDepartment = 1;
            $obj->idEmployee = 1;
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function AddNewUrl($idDB, $idSalon, $idDepartment, $idEmployee, $strUrlNamed) {
            $obj = new UrlAppointment();
            $obj->idDB = $idDB;
            $obj->idSalon = $idSalon;
            $obj->idDepartment = $idDepartment;
            $obj->idEmployee = $idEmployee;
            $obj->strUrlNamed = $strUrlNamed;
            $obj->intCodeUrl = $this->GetSimpleCode($strUrlNamed);
            $obj->id = $this->Save($obj);
            return $obj;
        }


        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idDB", $obj->idDB);
            $this->AddContentValue("idSalon", $obj->idSalon);
            $this->AddContentValue("idDepartment", $obj->idDepartment);
            $this->AddContentValue("idEmployee", $obj->idEmployee);
            $this->AddContentValue("isCanChangeGivenParameters", $obj->isCanChangeGivenParameters);
            
            $this->AddContentValue("strUrlNamed", $obj->strUrlNamed);
            $this->AddContentValue("intCodeUrl", $this->GetSimpleCode($obj->strUrlNamed));
            $this->AddContentValue("strUrlDigital", $obj->strUrlDigital);
            
            $this->AddContentValue("isShowAdress", $obj->isShowAdress);
            $this->AddContentValue("isGenerateQRCode", $obj->isGenerateQRCode);
            $this->AddContentValue("isUseAudio", $obj->isUseAudio);
            
            $this->AddContentValue("isRequireAccepted", $obj->isRequireAccepted);
            $this->AddContentValue("intMinutesWaiting", $obj->intMinutesWaiting);
            
            $this->AddContentValue("intPeriodMinutes", $obj->intPeriodMinutes);
            $this->AddContentValue("intBetweenMinutes", $obj->intBetweenMinutes);
            $this->AddContentValue("intBeforeMinutes", $obj->intBeforeMinutes);

            $this->AddContentValue("isCanUseAuthorisation", $obj->isCanUseAuthorisation);
            $this->AddContentValue("isRequirePhone", $obj->isRequirePhone);
            $this->AddContentValue("isRequireEmail", $obj->isRequireEmail);
            $this->AddContentValue("isRequireName", $obj->isRequireName);
            $this->AddContentValue("isShowCommentField", $obj->isShowCommentField);
            
            $this->AddContentValue("isUseOneTotalTime", $obj->isUseOneTotalTime);
            $this->AddContentValue("intTotalTimeMinutes", $obj->intTotalTimeMinutes);
            
            $this->AddContentValue("isUse", $obj->isUse);
            $this->AddContentValue("isSendedNotification", $obj->isSendedNotification);
            $this->AddContentValue("isForecastOptions", $obj->isForecastOptions);
            $this->AddContentValue("isShowReminders", $obj->isShowReminders);

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
            $obj = new UrlAppointment();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idDB = $row[$i++];
            $obj->idSalon = $row[$i++];
            $obj->idDepartment = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->isCanChangeGivenParameters = $row[$i++];
            
            $obj->strUrlNamed = $row[$i++];
            $obj->intCodeUrl = $row[$i++];
            $obj->strUrlDigital = $row[$i++];
            $obj->isShowAdress = $row[$i++];
            $obj->isGenerateQRCode = $row[$i++];
            $obj->isUseAudio = $row[$i++];
            $obj->isRequireAccepted = $row[$i++];
            $obj->intMinutesWaiting = $row[$i++];
            $obj->intPeriodMinutes = $row[$i++];
            $obj->intBetweenMinutes = $row[$i++];
            $obj->intBeforeMinutes = $row[$i++];
            $obj->isCanUseAuthorisation = $row[$i++];
            $obj->isRequirePhone = $row[$i++];
            $obj->isRequireEmail = $row[$i++];
            $obj->isRequireName = $row[$i++];
            $obj->isShowCommentField = $row[$i++];
            $obj->isUseOneTotalTime = $row[$i++];
            $obj->intTotalTimeMinutes = $row[$i++];
            $obj->isUse = $row[$i++];
            $obj->isSendedNotification = $row[$i++];
            $obj->isForecastOptions = $row[$i++];
            $obj->isShowReminders = $row[$i++];

            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function GetDefault($idDB) {
            $base = $this->GetRowBySql("idDB=".$idDB);
            if (empty($base->id)) {
                $base = $this->New($idDB);
            }
            return $base;
        }
        
        public function GenerateUrl($strName, $strSurname) {
            $urlAppointment = new UrlAppointment();
            return $urlAppointment->MakeRussianUrlForAppointment(trim($strName), trim($strSurname));
        }
        
        public function GetIdByUrlSalonEmployee($strUrlNamed, $idSalon, $idEmployee) {
            $urlAppointment = $this->GetByUrl($strUrlNamed);
            if ($urlAppointment instanceof UrlAppointment) {
                if ($urlAppointment->idSalon == $idSalon)
                    if ($urlAppointment->idEmployee == $idEmployee) {
                        //  ОК.
                        return $urlAppointment->id;
                    }
                //  Занят
                return -1;
            }
            return 0;
        }
        
        public function GenerateNewUrl($idDB, $idSalon, $idDepartment, $idEmployee, $strUrlNamed) {
            $urlAppointment = $this->AddNewUrl($idDB, $idSalon, $idDepartment, $idEmployee, $strUrlNamed);
            $strNewUrl = $strUrlNamed."_".$urlAppointment->id;
            $this->SaveField("strUrlNamed", $strNewUrl, "id=".$urlAppointment->id);
            return $strNewUrl;
        }
        
        public function CreateNewUniqueUrlAppointment($urlAppointment) {
            //  $urlAppointment уже должен быть сохранён. Был вызван GetDefault($idDB);
            $id = $this->GetIdByUrl($urlAppointment->strUrlNamed);
            if ($id > 0) {
                $urlAppointment->strUrlNamed = $urlAppointment->strUrlNamed."_".$urlAppointment->id;
            }
            $urlAppointment->id = $this->Save($urlAppointment);
            return $urlAppointment;
        }
        
        public function GetIdByUrl($strUrlNamed) {
            $intCodeUrl = $this->GetSimpleCode($strUrlNamed);
            $sqlWhere = "intCodeUrl=".$intCodeUrl." AND isDeleted=0 AND isUse=1 AND strUrlNamed LIKE '".trim($strUrlNamed)."'";
            return $this->GetIdField($sqlWhere);
        }
        public function GetByUrl($strUrlNamed) {
            $id = $this->GetIdByUrl($strUrlNamed);
            return $this->Get($id);
        }



        
    }

?>