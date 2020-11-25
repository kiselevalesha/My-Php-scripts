<?php
    require_once 'utils/utils.php';


    require_once('db/dbUrlAppointments.php');
    $dbUrlAppointment = new DBUrlAppointment();


    $urlAppointment = new UrlAppointment();
    $urlAppointment->strUrl = $dbUrlAppointment->GenerateUrl("opa", "yes");
    $urlAppointment->idDB = 111;
    $urlAppointment->strToken = "proba";
    $urlAppointment->isSendedNotification = 1;
    $dbUrlAppointment->Save($urlAppointment);
   
    
    //Сформируем и отошлём письмо зарегистрировавшемуся
    $to = "tool.pan@yandex.ru";
    if (!empty($to)) {
        $from = 'assistent@записи.онлайн';
        $subject = 'Запустился cron';
        $body = '...';
        SendEmailFromZapisi($to, $subject, $body);
    }


    //Сформируем и отошлём письмо себе о зарегистрировавшемся
    $to = 'beautymastersapp@gmail.com';
    $from = 'assistent@записи.онлайн';
    $subject = 'Запустился cron';
    $body = 'web-...';
    SendEmail($to, $subject, $body);
  
?>