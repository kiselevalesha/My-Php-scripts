<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/salonEmployee.php');
    
    class DBSalonEmployee extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("SalonEmployee", $idDb);
            $this->Init("SalonEmployee", $idDb);
        }

        public function New($idSalon, $idEmployee) {
            $salonEmployee = new SalonEmployee();
            $salonEmployee->idSalon = $idSalon;
            $salonEmployee->idEmployee = $idEmployee;
            $salonEmployee->id = $this->Save($salonEmployee);
            return $salonEmployee;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idSalon", $obj->idSalon);
            $this->AddContentValue("idDepartment", $obj->idDepartment);
            $this->AddContentValue("idEmployee", $obj->idEmployee);
            $this->AddContentValue("strSpecialization", $obj->strSpecialization);
            $this->AddContentValue("idPosition", $obj->idPosition);
            $this->AddContentValue("idPlace", $obj->idPlace);
            $this->AddContentValue("idSalaryRule", $obj->idSalaryRule);
            $this->AddContentValue("idProfile", $obj->idProfile);
            $this->AddContentValue("isCanChangeProfile", $obj->isCanChangeProfile);
            $this->AddContentValue("idCurrency", $obj->idCurrency);
            $this->AddContentValue("idPricelist", $obj->idPricelist);

            $this->AddContentValue("isHaveAccess", $obj->isHaveAccess);
            $this->AddContentValue("isMaster", $obj->isMaster);
            $this->AddContentValue("isAssistent", $obj->isAssistent);
            $this->AddContentValue("isAdministrator", $obj->isAdministrator);
            $this->AddContentValue("isCanSeeClients", $obj->isCanSeeClients);
            $this->AddContentValue("isCanChangeData", $obj->isCanChangeData);
            $this->AddContentValue("intPinCode", $obj->intPinCode);
            ///$this->AddContentValue("intPinCodeAtempts", $obj->intPinCodeAtempts);
            ///$this->AddContentValue("idStatusInvite", $obj->idStatusInvite);

            $this->AddContentValue("ageSalaryCalculation", $obj->ageSalaryCalculation);

            $this->AddContentValue("isSdelnoAsMaster", $obj->isSdelnoAsMaster);
            $this->AddContentValue("intProcentsMaster", $obj->intProcentsMaster);
            $this->AddContentValue("summaFixMoneyMaster", $obj->summaFixMoneyMaster);
            $this->AddContentValue("isAccountSkidkiMaster", $obj->isAccountSkidkiMaster);
            $this->AddContentValue("isAccountRevenuMaster", $obj->isAccountRevenuMaster);
            $this->AddContentValue("isAdditionForReturnClient", $obj->isAdditionForReturnClient);
            $this->AddContentValue("intAdditionForReturnClientProcents", $obj->intAdditionForReturnClientProcents);
            $this->AddContentValue("summaAdditionForReturnClient", $obj->summaAdditionForReturnClient);
            $this->AddContentValue("isSubtractionForNotReturnClient", $obj->isSubtractionForNotReturnClient);
            $this->AddContentValue("intSubtractionForNotReturnClientProcents", $obj->intSubtractionForNotReturnClientProcents);
            $this->AddContentValue("summaSubtractionForNotReturnClient", $obj->summaSubtractionForNotReturnClient);
            $this->AddContentValue("isCorrectionByClientRateMaster", $obj->isCorrectionByClientRateMaster);
            $this->AddContentValue("intStars0ProcentsMaster", $obj->intStars1ProcentsMaster);
            $this->AddContentValue("intStars1ProcentsMaster", $obj->intStars1ProcentsMaster);
            $this->AddContentValue("intStars2ProcentsMaster", $obj->intStars2ProcentsMaster);
            $this->AddContentValue("intStars3ProcentsMaster", $obj->intStars3ProcentsMaster);
            $this->AddContentValue("intStars4ProcentsMaster", $obj->intStars4ProcentsMaster);
            $this->AddContentValue("intStars5ProcentsMaster", $obj->intStars5ProcentsMaster);

            $this->AddContentValue("isSdelnoAsAssistent", $obj->isSdelnoAsAssistent);
            $this->AddContentValue("intProcentsAsAssistent", $obj->intProcentsAsAssistent);
            $this->AddContentValue("summaFixMoneyAsAssistent", $obj->summaFixMoneyAsAssistent);
            $this->AddContentValue("isAccountSkidkiAssistent", $obj->isAccountSkidkiAssistent);
            $this->AddContentValue("isAccountRevenuAssistent", $obj->isAccountRevenuAssistent);
            $this->AddContentValue("isCorrectionByClientRateAssistent", $obj->isCorrectionByClientRateAssistent);
            $this->AddContentValue("intStars0ProcentsAssistent", $obj->intStars1ProcentsAssistent);
            $this->AddContentValue("intStars1ProcentsAssistent", $obj->intStars1ProcentsAssistent);
            $this->AddContentValue("intStars2ProcentsAssistent", $obj->intStars2ProcentsAssistent);
            $this->AddContentValue("intStars3ProcentsAssistent", $obj->intStars3ProcentsAssistent);
            $this->AddContentValue("intStars4ProcentsAssistent", $obj->intStars4ProcentsAssistent);
            $this->AddContentValue("intStars5ProcentsAssistent", $obj->intStars5ProcentsAssistent);
            $this->AddContentValue("isAdditionForReturnClientAssistent", $obj->isAdditionForReturnClientAssistent);
            $this->AddContentValue("intAdditionForReturnClientProcentsAssistent", $obj->intAdditionForReturnClientProcentsAssistent);
            $this->AddContentValue("summaAdditionForReturnClientAssistent", $obj->summaAdditionForReturnClientAssistent);
            $this->AddContentValue("isSubtractionForNotReturnClientAssistent", $obj->isSubtractionForNotReturnClientAssistent);
            $this->AddContentValue("intSubtractionForNotReturnClientProcentsAssistent", $obj->intSubtractionForNotReturnClientProcentsAssistent);
            $this->AddContentValue("summaSubtractionForNotReturnClientAssistent", $obj->summaSubtractionForNotReturnClientAssistent);

            $this->AddContentValue("isSdelnoAsAdministrator", $obj->isSdelnoAsAdministrator);
            $this->AddContentValue("isAccountSkidkiAdministrator", $obj->isAccountSkidkiAdministrator);
            $this->AddContentValue("isAccountRevenuAdministrator", $obj->isAccountRevenuAdministrator);
            $this->AddContentValue("intProcentsCostOrderAdministrator", $obj->intProcentsCostOrderAdministrator);
            $this->AddContentValue("summaFixMoneyCostOrderAdministrator", $obj->summaFixMoneyCostOrderAdministrator);
            $this->AddContentValue("intProcentsIncomeCallToVisit", $obj->intProcentsIncomeCallToVisit);
            $this->AddContentValue("intProcentsOutcomeCallToVisit", $obj->intProcentsOutcomeCallToVisit);
            $this->AddContentValue("isCorrectionByClientRateAdministrator", $obj->isCorrectionByClientRateAdministrator);
            $this->AddContentValue("intStars0ProcentsAdministrator", $obj->intStars1ProcentsAdministrator);
            $this->AddContentValue("intStars1ProcentsAdministrator", $obj->intStars1ProcentsAdministrator);
            $this->AddContentValue("intStars2ProcentsAdministrator", $obj->intStars2ProcentsAdministrator);
            $this->AddContentValue("intStars3ProcentsAdministrator", $obj->intStars3ProcentsAdministrator);
            $this->AddContentValue("intStars4ProcentsAdministrator", $obj->intStars4ProcentsAdministrator);
            $this->AddContentValue("intStars5ProcentsAdministrator", $obj->intStars5ProcentsAdministrator);

            $this->AddContentValue("isPaymentByTime", $obj->isPaymentByTime);
            $this->AddContentValue("summaPaymentOklad", $obj->summaPaymentOklad);
            $this->AddContentValue("idTypeTimePayment", $obj->idTypeTimePayment);
            $this->AddContentValue("isPaymentByWorkTime", $obj->isPaymentByWorkTime);
            
            $this->AddContentValue("isPaymentByRent", $obj->isPaymentByRent);
            $this->AddContentValue("summaPaymentRent", $obj->summaPaymentRent);
            $this->AddContentValue("idTypeRentPayment", $obj->idTypeRentPayment);

            $this->AddContentValue("isShowOnline", $obj->isShowOnline);
            $this->AddContentValue("strDescriptionOnline", $obj->strDescriptionOnline);
            $this->AddContentValue("isUse", $obj->isUse);
            $this->AddContentValue("isNew", $obj->isNew);

            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id == 0) {
                $this->AddContentValue("isDeleted", $obj->isDeleted);
                $this->AddContentValue("idStatusInvite", $obj->idStatusInvite);
                $this->AddContentValue("intPinCodeAtempts", $obj->intPinCodeAtempts);
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
            return $this->GetIdField("idSalon=".$obj->idSalon." AND idDepartment=".$obj->idDepartment." AND idEmployee=".$obj->idEmployee);
        }

        public function SaveUpdate($obj) {
            $obj->id = $this->GetId($obj);
            return $this->Save($obj);
        }

        public function GetRow($row) {
            $i = 0;
            $obj = new SalonEmployee();
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            
            $obj->idSalon = $row[$i++];
            $obj->idDepartment = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->strSpecialization = $row[$i++];
            $obj->idPosition = $row[$i++];
            $obj->idPlace = $row[$i++];
            $obj->idSalaryRule = $row[$i++];
            $obj->idProfile = $row[$i++];
            $obj->isCanChangeProfile = $row[$i++];
            $obj->idCurrency = $row[$i++];
            $obj->idPricelist = $row[$i++];

            $obj->isHaveAccess = $row[$i++];
            $obj->isMaster = $row[$i++];
            $obj->isAssistent = $row[$i++];
            $obj->isAdministrator = $row[$i++];
            $obj->isCanSeeClients = $row[$i++];
            $obj->isCanChangeData = $row[$i++];
            $obj->intPinCode = $row[$i++];
            $obj->intPinCodeAtempts = $row[$i++];
            $obj->idStatusInvite = $row[$i++];

            $obj->ageSalaryCalculation = $row[$i++];

            $obj->isSdelnoAsMaster = $row[$i++];
            $obj->intProcentsMaster = $row[$i++];
            $obj->summaFixMoneyMaster = $row[$i++];
            $obj->isAccountSkidkiMaster = $row[$i++];
            $obj->isAccountRevenuMaster = $row[$i++];
            $obj->isAdditionForReturnClient = $row[$i++];
            $obj->intAdditionForReturnClientProcents = $row[$i++];
            $obj->summaAdditionForReturnClient = $row[$i++];
            $obj->isSubtractionForNotReturnClient = $row[$i++];
            $obj->intSubtractionForNotReturnClientProcents = $row[$i++];
            $obj->summaSubtractionForNotReturnClient = $row[$i++];
            $obj->isCorrectionByClientRateMaster = $row[$i++];
            $obj->intStars0ProcentsMaster = $row[$i++];
            $obj->intStars1ProcentsMaster = $row[$i++];
            $obj->intStars2ProcentsMaster = $row[$i++];
            $obj->intStars3ProcentsMaster = $row[$i++];
            $obj->intStars4ProcentsMaster = $row[$i++];
            $obj->intStars5ProcentsMaster = $row[$i++];

            $obj->isSdelnoAsAssistent = $row[$i++];
            $obj->intProcentsAsAssistent = $row[$i++];
            $obj->summaFixMoneyAsAssistent = $row[$i++];
            $obj->isAccountSkidkiAssistent = $row[$i++];
            $obj->isAccountRevenuAssistent = $row[$i++];
            $obj->isCorrectionByClientRateAssistent = $row[$i++];
            $obj->intStars0ProcentsAssistent = $row[$i++];
            $obj->intStars1ProcentsAssistent = $row[$i++];
            $obj->intStars2ProcentsAssistent = $row[$i++];
            $obj->intStars3ProcentsAssistent = $row[$i++];
            $obj->intStars4ProcentsAssistent = $row[$i++];
            $obj->intStars5ProcentsAssistent = $row[$i++];
            $obj->isAdditionForReturnClientAssistent = $row[$i++];
            $obj->intAdditionForReturnClientProcentsAssistent = $row[$i++];
            $obj->summaAdditionForReturnClientAssistent = $row[$i++];
            $obj->isSubtractionForNotReturnClientAssistent = $row[$i++];
            $obj->intSubtractionForNotReturnClientProcentsAssistent = $row[$i++];
            $obj->summaSubtractionForNotReturnClientAssistent = $row[$i++];

            $obj->isSdelnoAsAdministrator = $row[$i++];
            $obj->isAccountSkidkiAdministrator = $row[$i++];
            $obj->isAccountRevenuAdministrator = $row[$i++];
            $obj->intProcentsCostOrderAdministrator = $row[$i++];
            $obj->summaFixMoneyCostOrderAdministrator = $row[$i++];
            $obj->intProcentsIncomeCallToVisit = $row[$i++];
            $obj->intProcentsOutcomeCallToVisit = $row[$i++];
            $obj->isCorrectionByClientRateAdministrator = $row[$i++];
            $obj->intStars0ProcentsAdministrator = $row[$i++];
            $obj->intStars1ProcentsAdministrator = $row[$i++];
            $obj->intStars2ProcentsAdministrator = $row[$i++];
            $obj->intStars3ProcentsAdministrator = $row[$i++];
            $obj->intStars4ProcentsAdministrator = $row[$i++];
            $obj->intStars5ProcentsAdministrator = $row[$i++];

            $obj->isPaymentByTime = $row[$i++];
            $obj->summaPaymentOklad = $row[$i++];
            $obj->idTypeTimePayment = $row[$i++];
            $obj->isPaymentByWorkTime = $row[$i++];
            
            $obj->isPaymentByRent = $row[$i++];
            $obj->summaPaymentRent = $row[$i++];
            $obj->idTypeRentPayment = $row[$i++];

            $obj->isShowOnline = $row[$i++];
            $obj->strDescriptionOnline = $row[$i++];
            $obj->isUse = $row[$i++];
            $obj->isNew = $row[$i++];

            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }

?>