<?
    header('Content-Type: application/json; charset="UTF-8"');
    require_once '../php-scripts/utils/utils.php';
    require_once '../php-scripts/utils/json.php';
    require_once '../php-scripts/api/v1/appointments/out.php';

    $body = file_get_contents('php://input');
    $json = json_decode($body, false, 32);


    $strAppointment = $json->code;
    if (empty($strAppointment))   ExitEmptyError("Appointment is empty!");

    require_once('../php-scripts/db/dbCodeAppointments.php');
    $dbCodeAppointment = new DBCodeAppointment();
    $codeAppointment = $dbCodeAppointment->GetByCode($strAppointment);
    $idDB = $codeAppointment->idDB;

    require_once('../php-scripts/db/dbAppointments.php');
    $dbAppointment = new DBAppointment($idDB);
    $appointment = $dbAppointment->Get($codeAppointment->idAppointment);


    require_once('../php-scripts/models/essential.php');
    require_once('../php-scripts/db/dbProducts.php');
    $dbProduct = new DBProduct($idDB);



        //  Найти клиента
        $strJsonClient = "";
        if ($appointment->idClient > 0) {
            require_once('../php-scripts/db/dbClients.php');
            $dbClient = new DBClient($idDB);
            $client = $dbClient->Get($appointment->idClient);
        
            //  Найти контакты клиента
            require_once('../php-scripts/db/dbContacts.php');
            $dbContact = new DBContact($idDB);
            $phone = $dbContact->GetPhoneClient($appointment->idClient);
            if (!empty($phone)) {
                $strJsonContacts .= ',';
                $strJsonContacts .= '"phone":"'.$phone.'"';
            }
            $email = $dbContact->GetEmailClient($appointment->idClient);
            if (!empty($email)) {
                $strJsonContacts .= ',';
                $strJsonContacts .= '"email":"'.$email.'"';
            }
            
            // Найдём фото
            $photo = "";
            
            if ($client instanceof Client) {
                if ($client->idMainPhoto > 0) {
                    require_once('../php-scripts/db/dbImages.php');
                    $dbImage = new DBImage($idDB);
                    $image = $dbImage->Get($client->idMainPhoto);
                    $photo = $image->strUrl;
                }
                
                $strJsonClientName = ',"name":"'.$client->strName.'","patronymic":"'.$client->strPatronymic.'","surname":"'.$client->strSurname.'"';
            }
            
            $strJsonClient = ',"client":{"id":'.$client->id.$strJsonClientName.',"token":"'.$client->strToken.'","sex":'.$client->idSex.',"photo":"'.$photo.'","phone":"'.$phone.'"}';
        }
        
        
        //  Найти всех сотрудников на заказе
        /*require_once('../php-scripts/db/dbOrderEmployee.php');
        $dbOrderEmployee = new DBOrderEmployee($idDB);
        $strWhere = "isChecked=0 AND idOwner=".$id;
        $arrayEmployee = $dbOrderEmployee->GetArrayRows($strWhere);*/
        
        
        
        
        
        
        
        
        //  Найти все заказанные услуги
        require_once('../php-scripts/db/dbProductsAppointments.php');
        $dbProductsAppointment = new DBProductsAppointment($idDB, "ProductsOrder");
    
    
        $strJsonServices = "";
        require_once('../php-scripts/db/dbPricelistContents.php');
        $dbPricelistContent = new DBPricelistContent($idDB);
        
        $arrayContents = $dbProductsAppointment->GetArrayRows("idOwner=".$appointment->id." AND isChecked=1 AND isDeleted=0 AND idEssential=".EnumEssential::SERVICES);

        foreach ($arrayContents as $content) {
            if (!empty($content->idProduct)) {
                
                //  Получим продукт / услугу
                $product = $dbProduct->Get($content->idProduct);
                
                //  Получим цену и продолжительность
                $sql = "idPricelist=".$appointment->idPricelist." AND idProduct=".$product->id." AND idEssential=".$product->idEssential." AND isDeleted=0";
                $pricelistProduct = $dbPricelistContent->GetRowBySql($sql);

                if (strlen($strJsonServices) > 0)   $strJsonServices .= ",";
                $strJsonServices .= '{"id":"'.$product->id.'","name":"'.$product->strName.'","cost":"'.$pricelistProduct->costForSale.'","duration":"'.$pricelistProduct->intDurationMinutes.'"}';
            }
        }
    
        if (strlen($strJsonServices) > 0)   $strJsonServices = ',"services":['.$strJsonServices.']';


        //  Найти фото из портфолио, если оно было указано при онлайн-записи
        if ($appointment->idPhoto > 0) {
            require_once('../php-scripts/db/dbImages.php');
            $dbImage = new DBImage($idDB);
            $strPhoto = $dbImage->GetStringField("strUrl", "id=".$appointment->idPhoto);
            $strJsonPortfolio = ',"portfolio":"'.$strPhoto.'"';
        }


        //  Найти место и адрес заказа
        require_once('../php-scripts/models/essential.php');
        require_once('../php-scripts/db/dbAdresses.php');
        $dbAdress = new DBAdress($idDB);
        $adress = $dbAdress->GetRowBySql("idOwner=".$appointment->id." AND idEssential=".EnumEssential::APPOINTMENTS." AND isDeleted=0");
        if ($adress instanceof Adress)  $strJsonAdress = ',"adress":'.$adress->ToJson();

    

    //  Найти мастера
    $strJsonEmployee = "";
    if ($appointment->idMaster1 > 0) {
        require_once('../php-scripts/db/dbEmployee.php');
        $dbEmployee = new DBEmployee($idDB);
        $employee = $dbEmployee->Get($appointment->idMaster1);
        if ($employee instanceof Employee) {
            //  Найти контакты мастера
            require_once('../php-scripts/db/dbContacts.php');
            $dbContact = new DBContact($idDB);
            $phone = $dbContact->GetPhoneEmployee($appointment->idMaster1);
    
            // Найдём фото
            $photo = "";
            if ($employee->idMainPhoto > 0) {
                require_once('../php-scripts/db/dbImages.php');
                $dbImage = new DBImage($idDB);
                $image = $dbImage->Get($employee->idMainPhoto);
                $photo = $image->strUrl;
            }
            
            $strJsonEmployee = ',"employee":{"id":'.$employee->id.',"name":"'.$employee->GetShortName().'","photo":"'.$photo.'","phone":"'.$phone.'"}';
        }
    }












    require_once('../php-scripts/db/dbImages.php');
    $dbImage = new DBImage($idDB);

    //  Запрос секвенции фоток
    $idEssential = EnumEssential::VISITS;
    $idOwner = $appointment->id;
    $strJsonPhotos = ',"photos":['.$dbImage->GetJsonPhotos($idOwner, $idEssential).']';










    //  Достанем, хранимые настройки, используемые при создании записей
    require_once('../php-scripts/db/dbSettings.php');
    $dbSettings = new DBSettings($idDB);
    $settings = $dbSettings->GetDefault();
    $strJsonSettings = ',"settings":{"isChoosePlace":'.$settings->isChoosePlace.',"isChooseMasters":'.$settings->isChooseMasters.',"isChooseResources":'.$settings->isChooseResources.',"minutesWaiting":'.$settings->intMinutesWaiting.'}';


    //  Собираем всё вместе
    $strJson = $appointment->MakeJson().$strJsonClient.$strJsonEmployee.$strJsonAdministrators.$strJsonServices.$strJsonPortfolio.$strJsonAdress.$strJsonContacts.$strJsonGroups.$strJsonCategory.$strJsonSettings;
    
    echo GetOutJson('"appointment":{'.$strJson.'}'.$strJsonPhotos);

?>