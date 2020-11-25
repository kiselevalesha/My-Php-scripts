<?
require_once('../php-scripts/models/essential.php');
require_once('../php-scripts/db/dbSalons.php');
require_once('../php-scripts/db/dbAdresses.php');
require_once('../php-scripts/db/dbContacts.php');
require_once('../php-scripts/db/dbClients.php');
require_once('../php-scripts/db/dbImages.php');
require_once('../php-scripts/db/dbProducts.php');
require_once('../php-scripts/db/dbProductsAppointments.php');
require_once('../php-scripts/db/dbSettings.php');
require_once('../php-scripts/db/dbEmployee.php');
require_once('../php-scripts/db/dbSalonEmployee.php');


function GetFullJsonAppointment($appointment, $idDB) {

    // Найдём информацию по салону.
    $strJsonSalon = GetJsonSalon($idDB, $appointment->idSalon);

    // Найдём информацию по мастерам.
    $strJsonEmployees = GetJsonArrayEmployees($idDB, $appointment);

    return '{'.GetShortJsonAppointment($appointment, $idDB).',"employee":['.$strJsonEmployees.']'.$strJsonSalon.'}';
}

function GetJsonAppointment($appointment, $idDB) {
    return '{'.GetShortJsonAppointment($appointment, $idDB).'}';
}

function GetShortJsonAppointment($appointment, $idDB) {

    // Найдём информацию по клиенту.
    $strJsonClient = GetJsonClient($idDB, $appointment->idClient);

    // Найдём фотографию, если был заказ из портфолио.
    $strUrlPhoto = GetUrlPhotoPortfolio($idDB, $appointment->idPhoto);

    //  Найдём информацию по услугам.
    $strJsonServices = GetJsonServices($idDB, $appointment->id);

    //  Найдём настройки салона, в который записывается клиент
    $settings = GetSettings($idDB);

    $strJson = '"id":"'.$appointment->longCode.'","photo":"'.$strUrlPhoto.'","start":"'.$appointment->ageOrderStart.'","duration":"'.$appointment->intMinutesDuration.
        '","cost":"'.$appointment->costVisit.'","created":"'.$appointment->ageCreated.'","ageAccepted":"'.$appointment->ageAcceptedByMaster.
        '","description":"'.$appointment->strDescription.'","status":'.$appointment->idStatus.
        ',"client":{'.$strJsonClient.'},"services":['.$strJsonServices.'],"waitingMinutes":"'.$settings->intMinutesWaiting.'"';

    return $strJson;
}

function GetJsonReview($appointment, $idDB) {
    
    // Создадим json с информацией об оценках и отзывах
    $strJsonReview = $appointment->MakeJsonReview();

    // Найдём информацию по мастерам/ассистентам в записи.
    $strJsonEmployees = GetJsonArrayEmployees($idDB, $appointment);

    // Найдём информацию по клиенту.
    $strJsonClient = GetJsonClient($idDB, $appointment->idClient);

    return '{'.$strJsonReview.',"employee":['.$strJsonEmployees.'],"client":{'.$strJsonClient.'}}';
}


function GetJsonArrayEmployees($idDB, $appointment) {
    $strJsonEmployees = "";
    $idSalon = GetIdSalon($idDB, $appointment->idSalon);
    
    //  Первый мастер в массиве считается главным в Записи.
    if ($appointment->idMaster1 > 0) {
        $strJsonEmployees .= GetJsonEmployee($idDB, $appointment->idMaster1, $idSalon);
    }
    if ($appointment->idMaster2 > 0) {
        if (!empty($strJsonEmployees))     $strJsonEmployees .= ',';
        $strJsonEmployees .= GetJsonEmployee($idDB, $appointment->idMaster2, $idSalon);
    }
    if ($appointment->idMaster3 > 0) {
        if (!empty($strJsonEmployees))     $strJsonEmployees .= ',';
        $strJsonEmployees .= GetJsonEmployee($idDB, $appointment->idMaster3, $idSalon);
    }
    if ($appointment->idAssistent1 > 0) {
        if (!empty($strJsonEmployees))     $strJsonEmployees .= ',';
        $strJsonEmployees .= GetJsonEmployee($idDB, $appointment->idAssistent1, $idSalon);
    }
    if ($appointment->idAssistent2 > 0) {
        if (!empty($strJsonEmployees))     $strJsonEmployees .= ',';
        $strJsonEmployees .= GetJsonEmployee($idDB, $appointment->idAssistent2, $idSalon);
    }
    if ($appointment->idAssistent3 > 0) {
        if (!empty($strJsonEmployees))     $strJsonEmployees .= ',';
        $strJsonEmployees .= GetJsonEmployee($idDB, $appointment->idAssistent3, $idSalon);
    }
    return $strJsonEmployees;
}

function GetJsonEmployee($idDB, $idEmployee, $idSalon) {
    $strJsonEmployee = "";
    if ($idEmployee > 0) {
        $dbEmployee = new DBEmployee($idDB);
        $employee = $dbEmployee->Get($idEmployee);

        $idSex = $employee->idSex * 1;
        $strJsonEmployee = '"sex":'.$idSex;
        if ($employee instanceof Employee)  $strEmployeeShortName = $employee->GetShortName();
        if (!empty($strEmployeeShortName))    $strJsonEmployee .= ',"name":"'.$strEmployeeShortName.'"';
        
        
        $dbSalonEmployee = new DBSalonEmployee($idDB);
        $strSpecialization = $dbSalonEmployee->GetStringField("strSpecialization", "idSalon=".$idSalon." AND idEmployee=".$idEmployee);
        if (!empty($strSpecialization))    $strJsonEmployee .= ',"specialization":"'.$strSpecialization.'"';
        

        // Найдём фото
        $photo = GetPhotoUser($idDB, $employee->idMainPhoto);
        if (!empty($photo)) {
            if (!empty($strJsonEmployee))     $strJsonEmployee .= ',';
            $strJsonEmployee .= '"photo":"'.$photo.'"';
        }

        // Найдём контакты
        $dbContact = new DBContact($idDB);
        $strPhone = $dbContact->GetPhoneEmployee($idEmployee);
        if (!empty($strPhone)) {
            if (!empty($strJsonEmployee))     $strJsonEmployee .= ',';
            $strJsonEmployee .= '"phone":"'.$strPhone.'"';
        }
        $strEmail = $dbContact->GetEmailEmployee($idEmployee);
        if (!empty($strEmail)) {
            if (!empty($strJsonEmployee))     $strJsonEmployee .= ',';
            $strJsonEmployee .= '"email":"'.$strEmail.'"';
        }
    }
    return '{'.$strJsonEmployee.'}';
}

function GetIdSalon($idDB, $idSalon) {
    //  Если idSalon не указан в Записи, то берём салон по умолчанию.
    $dbSalon = new DBSalon($idDB);
    if (empty($idSalon)) $idSalon = $dbSalon->GetIdDefault();
    return $idSalon;
}
function GetJsonSalon($idDB, $idSalon) {
    $dbSalon = new DBSalon($idDB);

    $strJsonSalon = "";
    $idSalon = GetIdSalon($idDB, $idSalon);
    if ($idSalon > 1) {
        $salon = $dbSalon->Get($idSalon);

        // Найдём адрес
        $strJsonAdress = GetJsonAdress($idDB, $idSalon, EnumEssential::SALONS);

        // Найдём контакты
        $dbContact = new DBContact($idDB);
        $phone = $dbContact->GetContact($idSalon, EnumEssential::SALONS, EnumTypeContacts::TypePhone);
        if (!empty($phone)) {
            $strJsonContacts .= ',';
            $strJsonContacts .= '"phone":"'.$phone->intPhonePrefix.$phone->strText.'"';
        }
        $email = $dbContact->GetContact($idSalon, EnumEssential::SALONS, EnumTypeContacts::TypeEmail);
        if (!empty($email)) {
            $strJsonContacts .= ',';
            $strJsonContacts .= '"email":"'.$email->strText.'"';
        }

        $strJsonSalon = ',"salon":{"id":'.$salon->id.',"name":"'.$salon->strName.'"'.$strJsonAdress.$strJsonContacts.'}';
    }
    return $strJsonSalon;
}

function GetJsonAdress($idDB, $idOwner, $idEssential) {
    $strJsonAdress = "";
    if ($idOwner > 0) {
        $dbAdress = new DBAdress($idDB);
        $adress = $dbAdress->GetRowBySql("idOwner=".$idOwner." AND idEssential=".$idEssential." AND isDeleted=0");
        if ($adress instanceof Adress)  $strJsonAdress = ',"adress":'.$adress->ToJson();
    }
    return $strJsonAdress;
}

function GetJsonClient($idDB, $idClient) {
    $strJsonClient = "";
    if ($idClient > 0) {
        $dbClient = new DBClient($idDB);
        $client = $dbClient->GetClient($idClient);
        
        $idSex = $client->idSex * 1;
        $strJsonClient = '"sex":'.$idSex;
        if ($client instanceof Client)  $strClientShortName = $client->GetShortName();
        if (!empty($strClientShortName))    $strJsonClient .= ',"name":"'.$strClientShortName.'"';
        
        
        // Найдём фото
        $photo = GetPhotoUser($idDB, $client->idMainPhoto);
        if (!empty($photo)) {
            if (!empty($strJsonClient))     $strJsonClient .= ',';
            $strJsonClient .= '"photo":"'.$photo.'"';
        }

        
        $dbContact = new DBContact($idDB);
        $strPhone = $dbContact->GetPhoneClient($idClient);
        if (!empty($strPhone)) {
            if (!empty($strJsonClient))     $strJsonClient .= ',';
            $strJsonClient .= '"phone":"'.$strPhone.'"';
        }
        $strEmail = $dbContact->GetEmailClient($idClient);
        if (!empty($strEmail)) {
            if (!empty($strJsonClient))     $strJsonClient .= ',';
            $strJsonClient .= '"email":"'.$strEmail.'"';
        }
    }
    return $strJsonClient;
}

function GetPhotoUser($idDB, $idPhoto) {
    $strUrlPhoto = "";
    if ($idPhoto > 0) {
        $dbImage = new DBImage($idDB);
        $image = $dbImage->Get($idPhoto);
        $strUrlPhoto = $image->GetFullPath();
    }
    return $strUrlPhoto;
}

function GetUrlPhotoPortfolio($idDB, $idPhoto) {
    $strPhoto = "";
    if ($idPhoto > 0) {
        $dbImage = new DBImage($idDB);
        $strPhoto = $dbImage->GetStringField("strUrl", "id=".$idPhoto);
    }
    return $strPhoto;
}

function GetJsonServices($idDB, $idAppointment) {
    $strJsonServices = "";

    $dbProduct = new DBProduct($idDB);
    
    $dbProductsAppointment = new DBProductsAppointment($idDB, EnumProductRelationTables::NameTableOrder);
    $arrayProductsAppointment = $dbProductsAppointment->GetArrayRows("idOwner=".$idAppointment." AND isChecked=1 AND idEssential=".EnumEssential::SERVICES);
    
    foreach ($arrayProductsAppointment as $serviceRelation)
        if ($serviceRelation->idProduct > 0) {
            $product = $dbProduct->Get($serviceRelation->idProduct);
            
            if (!empty($strJsonServices))   $strJsonServices .= ',';
            $strJsonServices .= '{"name":"'.$product->strName.'","duration":"'.$serviceRelation->intMinutesDuration.'","cost":"'.$serviceRelation->summaTotal.'"}';
        }
        
    return $strJsonServices;
}

function GetSettings($idDB) {
    $dbSettings = new DBSettings($idDB);
    $settings = $dbSettings->GetDefault();
    return $settings;
}

?>