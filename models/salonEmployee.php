<?
include_once('../php-scripts/models/base.php');

class SalonEmployee extends Base
{
    public $idSalon = 0;
    public $idDepartment = 0;
    public $idEmployee = 0;

    public $strSpecialization = "";
    public $idPosition = 0;
    public $idPlace = 0;
    public $idSalaryRule = 0;
    public $idProfile = 0;
    public $isCanChangeProfile = 0;
    public $idCurrency = 0;
    public $idPricelist = 0;    //  Прайслист по умолчанию для этого мастера

    public $isHaveAccess = 0;
    public $isMaster = 1;
    public $isAssistent = 0;
    public $isAdministrator = 0;
    public $isCanSeeClients = 0;
    public $isCanChangeData = 0;
    public $intPinCode = 0;
    public $intPinCodeAtempts = 0; //  количество произведённых попыток угадать пин-код
    public $idStatusInvite = 0;

    public $ageSalaryCalculation = 0;

    public $isSdelnoAsMaster = 0;
    public $intProcentsMaster = 0;
    public $summaFixMoneyMaster = 0;
    public $isAccountSkidkiMaster = 0;
    public $isAccountRevenuMaster = 0;
    public $isAdditionForReturnClient = 0;
    public $intAdditionForReturnClientProcents = 0;
    public $summaAdditionForReturnClient = 0;
    public $isSubtractionForNotReturnClient = 0;
    public $intSubtractionForNotReturnClientProcents = 0;
    public $summaSubtractionForNotReturnClient = 0;
    public $isCorrectionByClientRateMaster = 0;
    public $intStars1ProcentsMaster = 0;
    public $intStars2ProcentsMaster = 0;
    public $intStars3ProcentsMaster = 0;
    public $intStars4ProcentsMaster = 0;
    public $intStars5ProcentsMaster = 0;

    public $isSdelnoAsAssistent = 0;
    public $intProcentsAsAssistent = 0;
    public $summaFixMoneyAsAssistent = 0;
    public $isAccountSkidkiAssistent = 0;
    public $isAccountRevenuAssistent = 0;
    public $isCorrectionByClientRateAssistent = 0;
    public $intStars1ProcentsAssistent = 0;
    public $intStars2ProcentsAssistent = 0;
    public $intStars3ProcentsAssistent = 0;
    public $intStars4ProcentsAssistent = 0;
    public $intStars5ProcentsAssistent = 0;
    public $isAdditionForReturnClientAssistent = 0;
    public $intAdditionForReturnClientProcentsAssistent = 0;
    public $summaAdditionForReturnClientAssistent = 0;
    public $isSubtractionForNotReturnClientAssistent = 0;
    public $intSubtractionForNotReturnClientProcentsAssistent = 0;
    public $summaSubtractionForNotReturnClientAssistent = 0;

    public $isSdelnoAsAdministrator = 0;
    public $isAccountSkidkiAdministrator = 0;
    public $isAccountRevenuAdministrator = 0;
    public $intProcentsCostOrderAdministrator = 0;
    public $summaFixMoneyCostOrderAdministrator = 0;
    public $intProcentsIncomeCallToVisit = 0;
    public $intProcentsOutcomeCallToVisit = 0;
    public $isCorrectionByClientRateAdministrator = 0;
    public $intStars1ProcentsAdministrator = 0;
    public $intStars2ProcentsAdministrator = 0;
    public $intStars3ProcentsAdministrator = 0;
    public $intStars4ProcentsAdministrator = 0;
    public $intStars5ProcentsAdministrator = 0;

    public $isPaymentByTime = 0;
    public $summaPaymentOklad = 0;
    public $idTypeTimePayment = 0;
    public $isPaymentByWorkTime = 0;

    public $isPaymentByRent = 0;
    public $summaPaymentRent = 0;
    public $idTypeRentPayment = 0;
    
    public $isShowOnline = 0;
    public $strDescriptionOnline = "";
    
    public $isNew = 1;
    public $isUse = 1;


    public function MakeJson() {
        return '"id":'.$this->id.','

            .'"salon":'.$this->idSalon.','
            //.'"department":'.$this->idDepartment.','
            .'"employee":'.$this->idEmployee.','
            
            .'"specialization":"'.$this->strSpecialization.'",'
            .'"position":'.$this->idPosition.','
            .'"place":'.$this->idPlace.','
            .'"salaryRule":'.$this->idSalaryRule.','
            .'"profile":'.$this->idProfile.','
            .'"isCanChangeProfile":'.$this->isCanChangeProfile.','
            .'"currency":'.$this->idCurrency.','
            
            .'"isHaveAccess":'.$this->isHaveAccess.','
            .'"isMaster":'.$this->isMaster.','
            .'"isAssistent":'.$this->isAssistent.','
            .'"isAdministrator":'.$this->isAdministrator.','
            .'"isCanSeeClients":'.$this->isCanSeeClients.','
            .'"isCanChangeData":'.$this->isCanChangeData.','
            .'"pinCode":'.$this->intPinCode.','
            //.'"atemptsPinCode":'.$this->intPinCodeAtempts.','
            .'"statusInvite":'.$this->idStatusInvite.','
            

            .'"master":{'
                .'"is":'.$this->isSdelnoAsMaster.','
                .'"procents":'.$this->intProcentsMaster.','
                .'"fix":'.$this->summaFixMoneyMaster.','
                .'"isAccountSkidki":'.$this->isAccountSkidkiMaster.','
                .'"isAccountRevenu":'.$this->isAccountRevenuMaster.','
                
                .'"add":{'
                    .'"is":'.$this->isAdditionForReturnClient.','
                    .'"procents":'.$this->intAdditionForReturnClientProcents.','
                    .'"fix":'.$this->summaAdditionForReturnClient
                .'},'
                
                .'"sub":{'
                    .'"is":'.$this->isSubtractionForNotReturnClient.','
                    .'"procents":'.$this->intSubtractionForNotReturnClientProcents.','
                    .'"fix":'.$this->summaSubtractionForNotReturnClient
                .'},'
                
                .'"stars":{'
                    .'"is":'.$this->isCorrectionByClientRateMaster.','
                    .'"procents0":'.$this->intStars0ProcentsMaster.','
                    .'"procents1":'.$this->intStars1ProcentsMaster.','
                    .'"procents2":'.$this->intStars2ProcentsMaster.','
                    .'"procents3":'.$this->intStars3ProcentsMaster.','
                    .'"procents4":'.$this->intStars4ProcentsMaster.','
                    .'"procents5":'.$this->intStars5ProcentsMaster
                .'}'
            .'},'

            .'"assistent":{'
                .'"is":'.$this->isSdelnoAsAssistent.','
                .'"procents":'.$this->intProcentsAsAssistent.','
                .'"fix":'.$this->summaFixMoneyAsAssistent.','
                .'"isAccountSkidki":'.$this->isAccountSkidkiAssistent.','
                .'"isAccountRevenu":'.$this->isAccountRevenuAssistent.','
                
                .'"add":{'
                    .'"is":'.$this->isAdditionForReturnClientAssistent.','
                    .'"procents":'.$this->intAdditionForReturnClientProcentsAssistent.','
                    .'"fix":'.$this->summaAdditionForReturnClientAssistent
                .'},'
                
                .'"sub":{'
                    .'"is":'.$this->isSubtractionForNotReturnClientAssistent.','
                    .'"procents":'.$this->intSubtractionForNotReturnClientProcentsAssistent.','
                    .'"fix":'.$this->summaSubtractionForNotReturnClientAssistent
                .'},'
                
                .'"stars":{'
                    .'"is":'.$this->isCorrectionByClientRateAssistent.','
                    .'"procents0":'.$this->intStars0ProcentsAssistent.','
                    .'"procents1":'.$this->intStars1ProcentsAssistent.','
                    .'"procents2":'.$this->intStars2ProcentsAssistent.','
                    .'"procents3":'.$this->intStars3ProcentsAssistent.','
                    .'"procents4":'.$this->intStars4ProcentsAssistent.','
                    .'"procents5":'.$this->intStars5ProcentsAssistent
                .'}'
            .'},'

            .'"administrator":{'
                .'"is":'.$this->isSdelnoAsAdministrator.','
                .'"procents":'.$this->intProcentsCostOrderAdministrator.','
                .'"fix":'.$this->summaFixMoneyCostOrderAdministrator.','
                .'"isAccountSkidki":'.$this->isAccountSkidkiAdministrator.','
                .'"isAccountRevenu":'.$this->isAccountRevenuAdministrator.','
                .'"procentsForIncomeCall":'.$this->intProcentsIncomeCallToVisit.','
                .'"procentsForOutcomeCall":'.$this->intProcentsOutcomeCallToVisit.','

                .'"stars":{'
                    .'"is":'.$this->isCorrectionByClientRateAdministrator.','
                    .'"procents0":'.$this->intStars0ProcentsAdministrator.','
                    .'"procents1":'.$this->intStars1ProcentsAdministrator.','
                    .'"procents2":'.$this->intStars2ProcentsAdministrator.','
                    .'"procents3":'.$this->intStars3ProcentsAdministrator.','
                    .'"procents4":'.$this->intStars4ProcentsAdministrator.','
                    .'"procents5":'.$this->intStars5ProcentsAdministrator
                .'}'
            .'},'

            .'"time":{'
                .'"is":'.$this->isPaymentByTime.','
                .'"summa":'.$this->summaPaymentOklad.','
                .'"type":'.$this->idTypeTimePayment.','
                .'"isByTime":'.$this->isPaymentByWorkTime.'},'

            .'"rent":{'
                .'"is":'.$this->isPaymentByRent.','
                .'"summa":'.$this->summaPaymentRent.','
                .'"type":'.$this->idTypeRentPayment.'},'


            .'"isShowOnline":'.$this->isShowOnline.','
            .'"descriptionOnline":"'.$this->strDescriptionOnline.'",'
            .'"isNew":'.$this->isNew.','
            .'"isUse":'.$this->isUse;
    }
}
?>