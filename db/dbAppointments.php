<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/appointment.php');
    
    class DBAppointment extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Appointments", $idDb);
            $this->idTable = EnumIdTables::Appointments;
            $this->arraIndexFields = array("ageOrderStart", "idSalon", "idMaster1", "idMaster2", "idAssistent1", "idAssistent2");
            $this->Init("Appointments", $idDb);
        }

        public function New() {
            $obj = new Appointment();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetAppointment($id) {
            $obj = new Appointment();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("strTokenAdministratorOrder", $obj->strTokenAdministratorOrder);
            $this->AddContentValue("intCodeTokenAdministratorOrder", $this->GetSimpleCode($obj->strTokenAdministratorOrder));
            $this->AddContentValue("strTokenAdministratorVisit", $obj->strTokenAdministratorVisit);
            $this->AddContentValue("intCodeTokenAdministratorVisit", $this->GetSimpleCode($obj->strTokenAdministratorVisit));
            
            $this->AddContentValue("idClient", $obj->idClient);
            $this->AddContentValue("idContact", $obj->idContact);
            $this->AddContentValue("idAdress", $obj->idAdress);
            
            $this->AddContentValue("idSalon", $obj->idSalon);
            $this->AddContentValue("idDepartment", $obj->idDepartment);
            $this->AddContentValue("idPlace", $obj->idPlace);
            $this->AddContentValue("idCourse", $obj->idCourse);
            $this->AddContentValue("idPhoto", $obj->idPhoto);
            
            $this->AddContentValue("idMaster1", $obj->idMaster1);
            $this->AddContentValue("summaMaster1", $obj->summaMaster1);
            $this->AddContentValue("idMaster2", $obj->idMaster2);
            $this->AddContentValue("summaMaster2", $obj->summaMaster2);
            $this->AddContentValue("idAssistent1", $obj->idAssistent1);
            $this->AddContentValue("summaAssistent1", $obj->summaAssistent1);
            $this->AddContentValue("idAssistent2", $obj->idAssistent2);
            $this->AddContentValue("summaAssistent2", $obj->summaAssistent2);
            
            $this->AddContentValue("idTypeToolCreator", $obj->idTypeToolCreator);
            $this->AddContentValue("idInstanceToolCreator", $obj->idInstanceToolCreator);
            $this->AddContentValue("idEssentialCreator", $obj->idEssentialCreator);
            $this->AddContentValue("ageCreated", $obj->ageCreated);
            
            $this->AddContentValue("ageOrderStart", $obj->ageOrderStart);
            $this->AddContentValue("costOrder", $obj->costOrder);
            $this->AddContentValue("isAutoCalcCostOrder", $obj->isAutoCalcCostOrder);
            $this->AddContentValue("costVisit", $obj->costVisit);
            $this->AddContentValue("isAutoCalcCostVisit", $obj->isAutoCalcCostVisit);
            $this->AddContentValue("idTotalPayment", $obj->idTotalPayment);
            $this->AddContentValue("isTotalPaymentZero", $obj->isTotalPaymentZero);
            
            $this->AddContentValue("idCurrency", $obj->idCurrency);
            $this->AddContentValue("idAutoChoosePricelist", $obj->idAutoChoosePricelist);
            $this->AddContentValue("idPricelist", $obj->idPricelist);
            $this->AddContentValue("idAction", $obj->idAction);
            $this->AddContentValue("intMinutesDuration", $obj->intMinutesDuration);
            $this->AddContentValue("isAutoCalculationDuration", $obj->isAutoCalculationDuration);

            $this->AddContentValue("flagIncomeOutcome", $obj->flagIncomeOutcome);
            $this->AddContentValue("idReklama", $obj->idReklama);
            $this->AddContentValue("idNeedCreateCommunications", $obj->idNeedCreateCommunications);
            $this->AddContentValue("idNeedSendEmail", $obj->idNeedSendEmail);
            $this->AddContentValue("idNeedSaveInCalendar", $obj->idNeedSaveInCalendar);
            $this->AddContentValue("idEventCalendar", $obj->idEventCalendar);
            $this->AddContentValue("idForCreateCommunicationBefore", $obj->idForCreateCommunicationBefore);
            $this->AddContentValue("idForCreateCommunicationAfter", $obj->idForCreateCommunicationAfter);
            $this->AddContentValue("isRemind", $obj->isRemind);
            $this->AddContentValue("ageRemindWill", $obj->ageRemindWill);
            $this->AddContentValue("ageRemindWas", $obj->ageRemindWas);
            $this->AddContentValue("intMinutesRemind", $obj->intMinutesRemind);
            $this->AddContentValue("strTextRemindMessage", $obj->strTextRemindMessage);
            $this->AddContentValue("idSendNotification", $obj->idSendNotification);

            $this->AddContentValue("ageSendedInfoToMaster", $obj->ageSendedInfoToMaster);
            $this->AddContentValue("ageAcceptedByMaster", $obj->ageAcceptedByMaster);
            
            $this->AddContentValue("ageSendedInfoToClient", $obj->ageSendedInfoToClient);
            $this->AddContentValue("ageConfirmedByClient", $obj->ageConfirmedByClient);
            $this->AddContentValue("idTypeConfirmed", $obj->idTypeConfirmed);

            $this->AddContentValue("idStatus", $obj->idStatus);
            $this->AddContentValue("ageClientCame", $obj->ageClientCame);
            $this->AddContentValue("ageWorkStart", $obj->ageWorkStart);
            $this->AddContentValue("ageWorkEnd", $obj->ageWorkEnd);
            
            $this->AddContentValue("ageReview", $obj->ageReview);
            $this->AddContentValue("intRatingByMaster", $obj->intRatingByMaster);
            $this->AddContentValue("strReviewByMaster", $obj->strReviewByMaster);
            $this->AddContentValue("intRatingByClient", $obj->intRatingByClient);
            $this->AddContentValue("strReviewByClient", $obj->strReviewByClient);
            
            $this->AddContentValue("strUrlReferer", $obj->strUrlReferer);
            $this->AddContentValue("strBarCode", $obj->strBarCode);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("isFinished", $obj->isFinished);
            $this->AddContentValue("longCode", $obj->longCode);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());
            $this->AddContentValue("strJsonServices", $obj->strJsonServices);

            if ($obj->id == 0) {
                $this->AddContentValue("isDeleted", $obj->isDeleted);
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($obj->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($obj->id == 0)   $obj->id = $this->GetInsertedId();
            
            $this->SetFlagChanges();
            return $obj->id;
        }

        public function GetRow($row) {
            $obj = new Appointment();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->strTokenAdministratorOrder = $row[$i++];
            $obj->intCodeTokenAdministratorOrder = $row[$i++];
            $obj->strTokenAdministratorVisit = $row[$i++];
            $obj->intCodeTokenAdministratorVisit = $row[$i++];
            
            $obj->idClient = $row[$i++];
            $obj->idContact = $row[$i++];
            $obj->idAdress = $row[$i++];
            
            $obj->idSalon = $row[$i++];
            $obj->idDepartment = $row[$i++];
            $obj->idPlace = $row[$i++];
            $obj->idCourse = $row[$i++];
            $obj->idPhoto = $row[$i++];
            
            $obj->idMaster1 = $row[$i++];
            $obj->summaMaster1 = $row[$i++];
            $obj->idMaster2 = $row[$i++];
            $obj->summaMaster2 = $row[$i++];
            $obj->idAssistent1 = $row[$i++];
            $obj->summaAssistent1 = $row[$i++];
            $obj->idAssistent2 = $row[$i++];
            $obj->summaAssistent2 = $row[$i++];
            
            $obj->idTypeToolCreator = $row[$i++];
            $obj->idInstanceToolCreator = $row[$i++];
            $obj->idEssentialCreator = $row[$i++];
            $obj->ageCreated = $row[$i++];
            $obj->ageOrderStart = $row[$i++];

            $obj->costOrder = $row[$i++];
            $obj->isAutoCalcCostOrder = $row[$i++];
            $obj->costVisit = $row[$i++];
            $obj->isAutoCalcCostVisit = $row[$i++];
            $obj->idTotalPayment = $row[$i++];
            $obj->isTotalPaymentZero = $row[$i++];
            
            $obj->idCurrency = $row[$i++];
            $obj->idAutoChoosePricelist = $row[$i++];
            $obj->idPricelist = $row[$i++];
            $obj->idAction = $row[$i++];
            $obj->intMinutesDuration = $row[$i++];
            $obj->isAutoCalculationDuration = $row[$i++];

            $obj->flagIncomeOutcome = $row[$i++];
            $obj->idReklama = $row[$i++];
            $obj->idNeedCreateCommunications = $row[$i++];
            $obj->idNeedSendEmail = $row[$i++];
            $obj->idNeedSaveInCalendar = $row[$i++];
            $obj->idEventCalendar = $row[$i++];
            $obj->idForCreateCommunicationBefore = $row[$i++];
            $obj->idForCreateCommunicationAfter = $row[$i++];
            $obj->isRemind = $row[$i++];
            $obj->ageRemindWill = $row[$i++];
            $obj->ageRemindWas = $row[$i++];
            $obj->intMinutesRemind = $row[$i++];
            $obj->strTextRemindMessage = $row[$i++];
            $obj->idSendNotification = $row[$i++];

            $obj->ageSendedInfoToMaster = $row[$i++];
            $obj->ageAcceptedByMaster = $row[$i++];
            $obj->ageSendedInfoToClient = $row[$i++];
            $obj->ageConfirmedByClient = $row[$i++];
            $obj->idTypeConfirmed = $row[$i++];

            $obj->idStatus = $row[$i++];
            $obj->ageClientCame = $row[$i++];
            $obj->ageWorkStart = $row[$i++];
            $obj->ageWorkEnd = $row[$i++];
            
            $obj->ageReview = $row[$i++];
            $obj->intRatingByMaster = $row[$i++];
            $obj->strReviewByMaster = $row[$i++];
            $obj->intRatingByClient = $row[$i++];
            $obj->strReviewByClient = $row[$i++];
            
            $obj->strUrlReferer = $row[$i++];
            $obj->strBarCode = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->isFinished = $row[$i++];
            $obj->longCode = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            $obj->strJson = $row[$i++];
            $obj->strJsonServices = $row[$i++];
            return $obj;
        }

        public function Add($idSalon, $idDepartment, $idEmployee, $longCode, $idTypeToolCreator, $idInstanceToolCreator, $idEssentialCreator, $strToken, $strUrlReferer) {
            $obj = new Appointment();
            $obj->idSalon = $idSalon;
            if (!empty($idSalon))   $obj->isFinishedStep1 = 1;
            $obj->idDepartment = $idDepartment;
            $obj->idMaster1 = $idEmployee;
            if (!empty($idEmployee))   $obj->isFinishedStep2 = 1;
            
            $obj->idTypeToolCreator = $idTypeToolCreator;
            $obj->idInstanceToolCreator = $idInstanceToolCreator;
            $obj->idEssentialCreator = $idEssentialCreator;

            $obj->strTokenAdministratorOrder = $strToken;
            $obj->strUrlReferer = $strUrlReferer;

            $obj->longCode = $longCode;
            $obj->id = $this->Save($obj);
            return $obj;
        }
        public function MakeJson($obj) {
            return $obj->MakeJson();
        }

    }

?>