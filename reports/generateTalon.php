<?
    //  Формирование тела письма для информирования мастера о записи к нему.
    
    require_once '../php-scripts/utils/utils.php';
    require_once 'utils/start.php';
    require_once "ui/interface.php";
    
    $strAppointment = $_GET['id'];
    
    require_once('../php-scripts/db/dbCodeAppointments.php');
    $dbCodeAppointment = new DBCodeAppointment();
    $codeAppointment = $dbCodeAppointment->GetByCode($strAppointment);
    $idDB = $codeAppointment->idDB;
    

    require_once('../php-scripts/db/dbAppointments.php');
    $dbAppointment = new DBAppointment($idDB);
    $appointment = $dbAppointment->Get($codeAppointment->idAppointment);
    
    $month = substr($appointment->ageOrderStart, 4, 2) * 1;
    $strMonth = GetRusNameMonth($month);


    require_once('../php-scripts/models/essential.php');


    // Найдём информацию по клиенту.
    $strClient = "";
    $strClientPhoto = "https://записи.онлайн/images/profile-60.png";
    if (!empty($appointment->idClient)) {
        require_once('../php-scripts/db/dbClients.php');
        $dbClient = new DBClient($idDB);
        $client = $dbClient->GetClient($appointment->idClient);
        
        $idSex = $client->idSex * 1;
        $strJsonClient = '"sex":'.$idSex;
        if ($client instanceof Client)  $strClient = trim($client->GetShortName());

        
        // Найдём фото
        if ($client->idMainPhoto > 0) {
            require_once('../php-scripts/db/dbImages.php');
            $dbImage = new DBImage($idDB);
            $image = $dbImage->Get($client->idMainPhoto);
            $strClientPhoto = $image->strUrl;
        }
        if (!empty($strClientPhoto)) {
            if ($idSex == 1)    $strClientPhoto = "https://записи.онлайн/images/profile-man-60.png";
            else if ($idSex == 2)    $strClientPhoto = "https://записи.онлайн/images/profile-woman-60.png";
            else $strClientPhoto = "https://записи.онлайн/images/profile-60.png";
        }

        
        require_once('../php-scripts/db/dbContacts.php');
        $dbContact = new DBContact($idDB);
        $strPhone = $dbContact->GetPhoneClient($appointment->idClient);
        if (!empty($strPhone)) {
            if (!empty($strJsonClient))     $strJsonClient .= ',';
            $strJsonClient .= '"phone":"'.$strPhone.'"';
        }
        $strEmail = $dbContact->GetEmailClient($appointment->idClient);
        if (!empty($strEmail)) {
            if (!empty($strJsonClient))     $strJsonClient .= ',';
            $strJsonClient .= '"email":"'.$strEmail.'"';
        }
    }
    if (empty($strClient))  $strClient = '<i>Имя не указано</i>';
    
    if (!empty($strPhone))
        $strClientContact ='<a style="color:black;" href="tel://'.$strPhone.'">'.$strPhone.'</a>';

    if (empty($strClientContact))
        $strClientContact ='<a style="color:black;" href="mailto://'.$strEmail.'">'.$strEmail.'</a>';


    // Найдём фотографию, если был заказ из портфолио.
    $strPhoto = "";
    if ($appointment->idPhoto > 0) {
        require_once('../php-scripts/db/dbImages.php');
        $dbImage = new DBImage($idDB);
        $strPhoto = $dbImage->GetStringField("strUrl", "id=".$appointment->idPhoto);
    }



    // Найдём информацию по услугам.
    $strServices = "<table width=100%>";

    require_once('../php-scripts/db/dbProducts.php');
    $dbProduct = new DBProduct($idDB);
    
    require_once('../php-scripts/db/dbProductsAppointments.php');
    $dbProductsAppointment = new DBProductsAppointment($idDB, EnumProductRelationTables::NameTableOrder);
    $arrayProductsAppointment = $dbProductsAppointment->GetArrayRows("idOwner=".$appointment->id." AND isChecked=1 AND idEssential=".EnumEssential::SERVICES);
    
    foreach ($arrayProductsAppointment as $serviceRelation)
        if ($serviceRelation->idProduct > 0) {
            $product = $dbProduct->Get($serviceRelation->idProduct);

                $strServices .=
                    '<tr><td>'.
                        '<div style="display: inline-block;"><div id="nameService"> '.$product->strName.'</div></div>'.
                    '</td><td>'.
                        '<div align="right"><div style="display: inline-block;"><b>'.($serviceRelation->summaTotal/100).' руб.</b></div></div>'.
                    '</td></tr>';
            
            //if (!empty($strJsonServices))   $strJsonServices .= ',';
            //$strJsonServices .= '{"name":"'.$product->strName.'","duration":"'.$serviceRelation->intMinutesDuration.'","cost":"'.$serviceRelation->summaTotal.'"}';
        }

    $strServices .= "</table>";

?>
<div style="margin:0px;padding:0px;font: 100% verdana;">

    <br>
    <div align="center" style="margin-left:70px;padding:15px;background-color:red;color:white;display:inline-block;">
        <div align="center">
            <b><div style="font-size:250%;"><? echo substr($appointment->ageOrderStart, 6, 2); ?></div></b>
            <div><? echo $strMonth; ?></div>
        </div>
    </div>


    <div style="border: 1px solid grey; padding:0px;margin:0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

    <br>
    <table>
    <tr>
        <td></td>
        <td>
            <div style="background-color:grey;padding:2px; display:inline-block;">
                <div style="background-color:white; padding:20px;" align="center">
                    <div style="display: inline-block;">
                        <img src="https://записи.онлайн/images/alarm-20.png" width=20px;>
                    </div>
                    <div style="display: inline-block; font-size:150%;"><b>
                        <? echo substr($appointment->ageOrderStart, 8, 2).':'.substr($appointment->ageOrderStart, 10, 2); ?>
                    </b></div>
                </div>
            </div>
        </td>
        <td>
            <div align="right">
            
            <div style="background-color:grey;padding:2px; display:inline-block;">
                <div style="background-color:white; padding:20px;" align="center">
                    <div style="display: inline-block;">
                        <img src="https://записи.онлайн/images/watch-15.png" width=15px;>
                    </div>
                    <div style="display: inline-block; font-size:150%;"><b><? echo $appointment->intMinutesDuration; ?> мин.</b></div>
                </div>
            </div>
            
            </div>
        </td>
        <td></td>
    </tr>
    </table>


    <table>
        <tr>
            <td width=1%;>
                <br>
                <div style="margin-left:10px;" align="center"><img src="<? echo $strClientPhoto; ?>" width=60px;></div>
            </td>
            <td>
               <div style="margin-left:10px;">
                    <br><? echo $strClient; ?>
                    <br><b><? echo $strClientContact; ?></b>
               </div>
            </td>
        </tr>
    </table>
    
    
    <div id="divBlockSalon" style="display:none;">
        <div id="nameSalon"></div>
        <div id="phoneSalon"></div>
        <div id="adress" style="padding:10px;"></div><br>
    </div>
    
    <br><div style="margin-left:15px;"><b>Услуги:</b></div>

    <div id="divPhotoPortfolio" style="display:none;" align="center"><img id="photoPortfolio" src="" width="90%"><br></div>

    <div style="padding-left:10px; padding-right:10px;">
        <? echo $strServices; ?><br>
    </div>

    <div style="background-color:lightgrey; padding:10px;">
        <div align="right">
            <a  style="color:black;">
            <div style="background-color:grey;padding:2px; display: inline-block;">
                <div style="background-color:white; padding:10px; padding-left:20px; padding-right:20px;" align="right">
                    <div style="display: inline-block; color:red; font-size: 170%; padding:10px;"><b><? echo ($appointment->costOrder)/100; ?> руб.</b></div>
                </div>
            </div>
            </a>
        </div>
    </div>


    <div class="row" id="divStatusBar"></div>

    <div id="divQRCode" style="display:none;" align="center">
        <div class = "row" style="background-color:black; height:1px;"></div>
        <img id="imageQRcode" src="" width="300px">
    </div>

    </div>

    
    <div align="center" style="margin-left:70px;padding:15px;background-color:red;color:transparent;display:inline-block;">
        <div id="monthBottom"><? echo $strMonth; ?></div>
    </div>
    
    
    <br><br>
    <div align="center">
        <div style="background-color:black; padding:20px; display:inline-block;"><a style="color:white;" href="https://записи.онлайн/appointment.php?id=<? echo $strAppointment; ?>"> изменить </a></div>
    </div>

</div>
