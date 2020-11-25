<?

    //  Формирование сообщений себе и зарегистрировавшемуся
    
    if ($employee->id > 0) {
        //Сформируем и отошлём письмо зарегистрировавшемуся
        require_once('../php-scripts/db/dbContacts.php');
        $dbContact = new DBContact($idDB);
        $to = $dbContact->GetEmailEmployee($employee->id);
    
        if (!empty($to)) {

            require_once('../php-scripts/db/dbUidEmployee.php');
            $dbUidEmployee = new DBUidEmployee();
            $uid = $dbUidEmployee->GetStringField("strUid","idToken=".$idDB);

            $from = 'assistent@записи.онлайн';
            $subject = 'Зарегистрирована онлайн-запись';
            $body = '<div>Онлайн-запись<br>'
            .'<b><a href="https://запишись.онлайн/'.$urlAppointment->strUrlNamed.'">запишись.онлайн/'.$urlAppointment->strUrlNamed.'</a></b><br>'
            .'готова записывать клиентов. <br><br>'
            
            .'Мы пополнили ваш счёт на <b>99</b> руб. и подключили основные функции, чтобы вы могли познакомиться с возможностями сервиса.<br>'
            .'Стоимость подключённых услуг составила <b>25</b> руб. в день. Изменить настройки можно в <a href="https://записи.онлайн/start.php?uid='.$uid.'">личном кабинете</a>.<br><br>'
    
            .'На ютубе выложены короткие ролики о полезных возможностях сервиса для вашего бизнеса.<br>'
            .'<a href="https://www.youtube.com/watch?v=5EXQoLJMNTY&list=PLql7X_Lu_visFbbYpZm8b09KJW-7YnWyo">Официальный канал сервиса</a><br><br><br>'
    
            .'С уважением, команда сервиса <a href="https://записи.онлайн">"Записи.онлайн"</a></div>';
            ///SendUniversalEmail($to, $subject, $body);
            
            
            require_once('../php-scripts/db/dbTalks.php');
            $dbTalk = new DBTalk($idDB);
            $idTalk = $dbTalk->GetIdSupportTalk();

            require_once('../php-scripts/db/dbMessages.php');
            $dbMessage = new DBMessage($idDB);
            $dbMessage->CreateEmailMessage($idTalk, $to, $subject, $body);
            
            require_once('../php-scripts/messages/sendMessages.php');
            SendMessages($idDB);
        }
    }


    //Сформируем и отошлём письмо себе о зарегистрировавшемся
    $to = 'beautymastersapp@gmail.com';
    $subject = 'Новая web-регистрация: '.$strToken;
    $body = '<div>Новая web-регистрация!<br><br>Токен:'.$strToken.' idDB='.$idDB.'<br>'
    .'Зарегистрирована ссылка:<br>'
    .'<a href="https://запишись.онлайн/'.$urlAppointment->strUrlNamed.'">запишись.онлайн/'.$urlAppointment->strUrlNamed.'</a><br><br>'
    .'<a href="https://запишись.онлайн/setToken.php?id='.$strToken.'">Посмотреть базу</a><br><br>'
    .'<a href="https://запишись.онлайн">Сервис "ЗАПИСИ.ОНЛАЙН"</a></div>';
    SendUniversalEmail($to, $subject, $body);

?>