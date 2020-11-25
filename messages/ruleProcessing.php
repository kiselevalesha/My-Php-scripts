<?

//  Найти все сообщения с idAppointment = ...
//  Найти все сообщения, где время создания TypeTimeArrivalNextVisit или TypeTimeCreateAppointment
//  Посмотреть не создано ли уже с ними сообщения. Если создано и флаг автоматически, то - обновить
//  Чтобы создать, нужно заменить шаблонные слова. Для каждого создаваемого сообщения формировать такие слова-фразы


//  Сообщения о создании записи - мастеру (всем участвующим), администратору, менеджеру
//  Сообщения о записи - клиенту, талон
//  Сообщения о конце визита - клиенту, отчёт
//  Сообщения о планах на следующий рабочий день - мастерам-ассистентам, план
//  Сообщения о зарплате - в конце рабочего дня - сотрудникам, итого
//  Сообщения о итогах денег и отзывов за срок какой-то - менеджеру (указываем периодичность), прикрепляем отчёт (за неделю, за месяц), формируем ссылку - за период


    require_once('../php-scripts/db/dbMessageRules.php');
    $dbMessageRule = new DBMessageRule($idDB);
    
    require_once('../php-scripts/db/dbMessages.php');
    $dbMessage = new DBMessage($idDB);

    require_once('../php-scripts/db/dbContacts.php');
    $dbContact = new DBContact($idDB);

    require_once('../php-scripts/utils/utils.php');
    require_once('../php-scripts/models/age.php');
    require_once('../php-scripts/utils/age.php');


    $arrayReservedWords = array("ИМЯ КЛИЕНТА", "ФАМИЛИЯ КЛИЕНТА", "ИМЯ МАСТЕРА", "ФАМИЛИЯ МАСТЕРА",
        "НАЗВАНИЕ САЛОНА", "АДРЕС", "ДАТА ПРИЁМА", "ВРЕМЯ ПРИЁМА", "ССЫЛКА НА ТАЛОН", "ССЫЛКА НА ОТЧЁТ",
        "ССЫЛКА НА ОТЗЫВ", "ССЫЛКА НА ПЛАНЫ", "ССЫЛКА НА ИТОГИ", "ССЫЛКА НА ИТОГО");
    //$arrayReservedRequests = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    $arrayReservedRequests = array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
    $arrayReservedHaves = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    $arrayReservedValues = array("", "", "", "", "", "", "", "", "", "", "", "", "", "");
    
    function FillReservedWordsForAppointment($idDB, $idClient, $idEmployee, $idSalon, $date, $time) {
        global $arrayReservedRequests, $arrayReservedValues;

        require_once('../php-scripts/db/dbClients.php');
        $dbClient = new DBClient($idDB);
        
        $i = 0;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = $dbClient->GetStringField("strName", "id=".$idClient);
            $arrayReservedRequests[$i] = 1;
        }
        $i = 1;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = $dbClient->GetStringField("strSurname", "id=".$idClient);
            $arrayReservedRequests[$i] = 1;
        }
        

        require_once('../php-scripts/db/dbEmployee.php');
        $dbEmployee = new DBEmployee($idDB);
        
        $i = 2;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = $dbEmployee->GetStringField("strName", "id=".$idEmployee);
            $arrayReservedRequests[$i] = 1;
        }
        $i = 3;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = $dbEmployee->GetStringField("strSurname", "id=".$idEmployee);
            $arrayReservedRequests[$i] = 1;
        }

        
        $i = 4;
        if ($arrayReservedRequests[$i] == 1) {
            require_once('../php-scripts/db/dbSalons.php');
            $dbSalon = new DBSalon($idDB);
            
            $arrayReservedValues[$i] = $dbSalon->GetStringField("strName", "id=".$idSalon);
            $arrayReservedRequests[$i] = 1;
        }

        
        $i = 5;
        if ($arrayReservedRequests[$i] == 1) {
            require_once('../php-scripts/db/dbAdresses.php');
            $dbAdress = new DBAdress($idDB);
            
            //  Ищем адрес салона. Но может быть и адрес самого мастера, если он без салона работает.
            $adress = $dbAdress->GetRowBySql("idOwner=".$idSalon." AND idEssential=".EnumEssential::SALONS." AND isDeleted=0");
            if ($adress instanceof Adress) {
                $arrayReservedValues[$i] = $adress->ToString();
                $arrayReservedRequests[$i] = 1;
            }
        }


        $i = 6;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = FormatDate($date);
            $arrayReservedRequests[$i] = 1;
        }


        $i = 7;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = GetTimeFormat($time);
            $arrayReservedRequests[$i] = 1;
        }

    }
    
    function FillReservedWordsForAppointmentLinks($code) {
        global $arrayReservedRequests, $arrayReservedValues;

        $i = 8;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = 'https://запишись.онлайн/talon.php?id='.$code;
            $arrayReservedRequests[$i] = 1;
        }

        $i = 9;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = 'https://запишись.онлайн/report.php?id='.$code;
            $arrayReservedRequests[$i] = 1;
        }

        $i = 10;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = 'https://запишись.онлайн/review.php?id='.$code;
            $arrayReservedRequests[$i] = 1;
        }
    }
    
    function FillReservedWordsForEmployeeLinks($idEmployee, $idSalon) {
        global $arrayReservedRequests, $arrayReservedValues;

        $i = 11;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = 'https://записи.онлайн/plan.php?employee='.$idEmployee.'&salon='.$idSalon;
            $arrayReservedRequests[$i] = 1;
        }

        $i = 12;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = 'https://записи.онлайн/salary.php?employee='.$idEmployee.'&salon='.$idSalon;
            $arrayReservedRequests[$i] = 1;
        }

        $i = 13;
        if ($arrayReservedRequests[$i] == 1) {
            $arrayReservedValues[$i] = 'https://записи.онлайн/total.php?employee='.$idEmployee.'&salon='.$idSalon;
            $arrayReservedRequests[$i] = 1;
        }
    }

    function FillReservedWordsInMessage($strBodyTemplate) {
        global $arrayReservedWords, $arrayReservedHaves, $arrayReservedValues;
        $str = $strBodyTemplate;
        for ($i = 0; $i < sizeOf($arrayReservedWords); $i++) {
            //if ($arrayReservedHaves[$i] == 1)
                $str = str_replace('['.$arrayReservedWords[$i].']', $arrayReservedValues[$i], $str);
        }
        return $str;
    }
    
    
    /////////////////////////

    //  Создание сообщения для клиента о создании Записи
    function MakeMessageCreateAppointmentToClient($idDB, $appointment, $isDraft) {

        $start = $appointment->ageOrderStart;
        $date = substr($start, 0, 8);
        $time = substr($start, 8, 4);
        FillReservedWordsForAppointment($idDB, $appointment->idClient, $appointment->idMaster1, $appointment->idSalon, $date, $time);
        FillReservedWordsForAppointmentLinks($appointment->longCode);
        
        $sql = "idTypeDate=".EnumDateTypes::TypeDateCreateAppointment.
        " AND idTypeTime=".EnumTimeTypes::TypeTimeCreateAppointment.
        " AND idTypeRecepient=".EnumEssential::CLIENTS." AND isNew=0 AND isDeleted=0 AND isUse=1";
        UpdateMessages($sql, $appointment, GetContactClient($idDB, $appointment->idClient), $isDraft);
    }    

    //  Создание сообщений для клиента напоминаний о Записи
    function MakeMessagesRemindersAppointmentToClient($idDB, $appointment, $isDraft) {

        $start = $appointment->ageOrderStart;
        $date = substr($start, 0, 8);
        $time = substr($start, 8, 4);
        FillReservedWordsForAppointment($idDB, $appointment->idClient, $appointment->idMaster1, $appointment->idSalon, $date, $time);
        
        $sql = "idTypeDate=".EnumDateTypes::TypeDateNextAppointment.
        " AND idTypeTime=".EnumTimeTypes::TypeTimeArrivalNextVisit.
        " AND idTypeRecepient=".EnumEssential::CLIENTS." AND isNew=0 AND isDeleted=0 AND isUse=1";
        UpdateMessages($sql, $appointment, GetContactClient($idDB, $appointment->idClient), $isDraft);
    }
    function DeleteMessagesRemindersAppointmentToClient($appointment) {
        global $dbMessageRule, $dbMessage;
        
        $sql = "idTypeDate=".EnumDateTypes::TypeDateNextAppointment.
        " AND idTypeTime=".EnumTimeTypes::TypeTimeArrivalNextVisit.
        " AND idTypeRecepient=".EnumEssential::CLIENTS." AND isNew=0 AND isDeleted=0 AND isUse=1";

        $arrayMessageRules = $dbMessageRule->GetArrayRows($sql);
        foreach ($arrayMessageRules as $messageRule) {
            $message = $dbMessage->GetRowBySql("idAppointment=".$appointment->id." AND idMessageRule=".$messageRule->id." AND ageWasSended=0 AND isDeleted=0");
            if ($message instanceof Message) {
                $dbMessage->Delete($message->id);
            }
        }
    }

    //  Создание сообщения для клиента об отмене Записи
    function MakeMessageCancelAppointmentToClient($idDB, $appointment) {
        
        $start = $appointment->ageOrderStart;
        $date = substr($start, 0, 8);
        $time = substr($start, 8, 4);
        FillReservedWordsForAppointment($idDB, $appointment->idClient, $appointment->idMaster1, $appointment->idSalon, $date, $time);

        $sql = "idTypeDate=".EnumDateTypes::TypeDateNow.
        " AND idTypeTime=".EnumTimeTypes::TypeTimeNow.
        " AND idReport=".EnumPreGeneratedReports::TypeCancelAppointment.
        " AND idTypeRecepient=".EnumEssential::CLIENTS." AND isNew=0 AND isDeleted=0 AND isUse=1";
        UpdateMessages($sql, $appointment, GetContactClient($idDB, $appointment->idClient), 0);
    }    

    //  Создание сообщения для клиента с отчётом о визите и запросом отзыва
    function MakeMessageRateVisitToClient($idDB, $appointment) {
        
        $start = $appointment->ageOrderStart;
        $date = substr($start, 0, 8);
        $time = substr($start, 8, 4);
        FillReservedWordsForAppointment($idDB, $appointment->idClient, $appointment->idMaster1, $appointment->idSalon, $date, $time);
        FillReservedWordsForAppointmentLinks($appointment->longCode);
        
        $sql = "idTypeDate=".EnumDateTypes::TypeDateNextAppointment.
        " AND idTypeTime=".EnumTimeTypes::TypeTimeDepartureNextVisit.
        " AND idTypeRecepient=".EnumEssential::CLIENTS." AND isNew=0 AND isDeleted=0 AND isUse=1";
        UpdateMessages($sql, $appointment, GetContactClient($idDB, $appointment->idClient), 0);
    }    


    
    //  Создание сообщений сотрудникам о создании записи
    function MakeMessageCreateAppointmentToEmployees($idDB, $appointment) {
        if ($appointment->idMaster1 > 0)
            MakeMessageCreateAppointmentToEmployee($idDB, $appointment, $appointment->idMaster1);
        
        if ($appointment->idMaster2 > 0)
            MakeMessageCreateAppointmentToEmployee($idDB, $appointment, $appointment->idMaster2);
        
        if ($appointment->idMaster3 > 0)
            MakeMessageCreateAppointmentToEmployee($idDB, $appointment, $appointment->idMaster3);

        
        if ($appointment->idAssistent1 > 0)
            MakeMessageCreateAppointmentToEmployee($idDB, $appointment, $appointment->idAssistent1);
        
        if ($appointment->idAssistent2 > 0)
            MakeMessageCreateAppointmentToEmployee($idDB, $appointment, $appointment->idAssistent2);
        
        if ($appointment->idAssistent3 > 0)
            MakeMessageCreateAppointmentToEmployee($idDB, $appointment, $appointment->idAssistent3);
    }
    function MakeMessageCreateAppointmentToEmployee($idDB, $appointment, $idEmployee) {
        $start = $appointment->ageOrderStart;
        $date = substr($start, 0, 8);
        $time = substr($start, 8, 4);
        FillReservedWordsForAppointment($idDB, $appointment->idClient, $idEmployee, $appointment->idSalon, $date, $time);

        $sql = "idTypeDate=".EnumDateTypes::TypeDateCreateAppointment.
        " AND idTypeTime=".EnumTimeTypes::TypeTimeCreateAppointment.
        " AND idTypeRecepient=".EnumEssential::EMPLOYEE." AND isNew=0 AND isDeleted=0 AND isUse=1";
        UpdateMessages($sql, $appointment, GetContactEmployee($idDB, $idEmployee), 0);
    }

    //  Создание сообщений для сотрудников об оставленном отзыве.
    function MakeMessageCreateReviewToEmployees($idDB, $appointment) {
        
        FillReservedWordsForAppointmentLinks($appointment->longCode);
        
        if ($appointment->idMaster1 > 0)
            MakeMessageCreateReviewToEmployee($idDB, $appointment, $appointment->idMaster1);
            
        if ($appointment->idMaster2 > 0)
            MakeMessageCreateReviewToEmployee($idDB, $appointment, $appointment->idMaster2);

        if ($appointment->idMaster3 > 0)
            MakeMessageCreateReviewToEmployee($idDB, $appointment, $appointment->idMaster3);

        if ($appointment->idAssistent1 > 0)
            MakeMessageCreateReviewToEmployee($idDB, $appointment, $appointment->idAssistent1);

        if ($appointment->idAssistent2 > 0)
            MakeMessageCreateReviewToEmployee($idDB, $appointment, $appointment->idAssistent2);

        if ($appointment->idAssistent3 > 0)
            MakeMessageCreateReviewToEmployee($idDB, $appointment, $appointment->idAssistent3);
    }
    function MakeMessageCreateReviewToEmployee($idDB, $appointment, $idEmployee) {
        
        $start = $appointment->ageOrderStart;
        $date = substr($start, 0, 8);
        $time = substr($start, 8, 4);
        FillReservedWordsForAppointment($idDB, $appointment->idClient, $idEmployee, $appointment->idSalon, $date, $time);

        $sql = "idTypeDate=".EnumDateTypes::TypeDateNow.
        " AND idTypeTime=".EnumTimeTypes::TypeTimeNow.
        " AND idReport=".EnumPreGeneratedReports::TypeCreateReview.
        " AND idTypeRecepient=".EnumEssential::EMPLOYEE." AND isNew=0 AND isDeleted=0 AND isUse=1";
        UpdateMessages($sql, $appointment, GetContactEmployee($idDB, $idEmployee), 0);
    }    

    //  Создание сообщений для сотрудников об отмене Записи.
    function MakeMessageCancelAppointmentToEmployees($idDB, $appointment) {
        if ($appointment->idMaster1 > 0)
            MakeMessageCancelAppointmentToEmployee($idDB, $appointment, $appointment->idMaster1);
            
        if ($appointment->idMaster2 > 0)
            MakeMessageCancelAppointmentToEmployee($idDB, $appointment, $appointment->idMaster2);

        if ($appointment->idMaster3 > 0)
            MakeMessageCancelAppointmentToEmployee($idDB, $appointment, $appointment->idMaster3);

        if ($appointment->idAssistent1 > 0)
            MakeMessageCancelAppointmentToEmployee($idDB, $appointment, $appointment->idAssistent1);

        if ($appointment->idAssistent2 > 0)
            MakeMessageCancelAppointmentToEmployee($idDB, $appointment, $appointment->idAssistent2);

        if ($appointment->idAssistent3 > 0)
            MakeMessageCancelAppointmentToEmployee($idDB, $appointment, $appointment->idAssistent3);
    }
    function MakeMessageCancelAppointmentToEmployee($idDB, $appointment, $idEmployee) {
        
        $start = $appointment->ageOrderStart;
        $date = substr($start, 0, 8);
        $time = substr($start, 8, 4);
        FillReservedWordsForAppointment($idDB, $appointment->idClient, $idEmployee, $appointment->idSalon, $date, $time);

        $sql = "idTypeDate=".EnumDateTypes::TypeDateNow.
        " AND idTypeTime=".EnumTimeTypes::TypeTimeNow.
        " AND idReport=".EnumPreGeneratedReports::TypeCancelAppointment.
        " AND idTypeRecepient=".EnumEssential::EMPLOYEE." AND isNew=0 AND isDeleted=0 AND isUse=1";
        UpdateMessages($sql, $appointment, GetContactEmployee($idDB, $idEmployee), 0);
    }    

    //  Создание сообщений для сотрудников о расчёте зарплаты за день.
    //  Это ещё совсем не сделано. Только наброски. Потом всё нужно будет переделать по-правильному.
    function MakeMessageCalcSalaryToEmployees($idDB) {
        //  По всем салонам и всех их сотрудниках
        /*
        if ($appointment->idMaster1 > 0)
            MakeMessageCalcSalaryToEmployee($idDB, $appointment, $appointment->idMaster1);
            
        if ($appointment->idMaster2 > 0)
            MakeMessageCalcSalaryToEmployee($idDB, $appointment, $appointment->idMaster2);

        if ($appointment->idMaster3 > 0)
            MakeMessageCalcSalaryToEmployee($idDB, $appointment, $appointment->idMaster3);

        if ($appointment->idAssistent1 > 0)
            MakeMessageCalcSalaryToEmployee($idDB, $appointment, $appointment->idAssistent1);

        if ($appointment->idAssistent2 > 0)
            MakeMessageCalcSalaryToEmployee($idDB, $appointment, $appointment->idAssistent2);

        if ($appointment->idAssistent3 > 0)
            MakeMessageCalcSalaryToEmployee($idDB, $appointment, $appointment->idAssistent3);
        */
    }
    function MakeMessageCalcSalaryToEmployee($idDB, $idEmployee) {
        
        $start = $appointment->ageOrderStart;
        $date = substr($start, 0, 8);
        $time = substr($start, 8, 4);
        //FillReservedWordsForAppointment($idDB, $appointment->idClient, $idEmployee, $appointment->idSalon, $date, $time);

        $sql = "idTypeDate=".EnumDateTypes::TypeDateNow.
        " AND idTypeTime=".EnumTimeTypes::TypeTimeEndWorkDay.
        " AND idReport=".EnumPreGeneratedReports::TypeSalaryDay.
        " AND idTypeRecepient=".EnumEssential::EMPLOYEE." AND isNew=0 AND isDeleted=0 AND isUse=1";
        UpdateMessages($sql, $appointment, GetContactEmployee($idDB, $idEmployee), 0);
    }    


    
    function UpdateMessages($sql, $appointment, $contact, $isDraft) {
        global $dbMessage, $dbMessageRule;

        $age = new Age();
        $age->SetNow();
        $ticsNow = $age->GetLongAge();
        
        $age->AddToAge(0, 0, 0, 1, 0, 0);
        $ticsOneHourAfterNow = $age->GetLongAge();   //  Текущее время + 1 час
        
        $age->SetNow();
        $age->AddToAge(0, 0, 0, 2, 0, 0);
        $ticsTwoHoursAfterNow = $age->GetLongAge();   //  Текущее время + 2 часа
        
        

        $arrayMessageRules = $dbMessageRule->GetArrayRows($sql);
        foreach ($arrayMessageRules as $messageRule) {

            //  Ищем не создано ли уже по этому правилу сообщения
            //  Создай поле для проверки ручного редактирования
            $message = $dbMessage->GetRowBySql("idAppointment=".$appointment->id." AND idMessageRule=".$messageRule->id);
            
            if ((empty($message)) || (!($message instanceof Message))) {
                //  Создаём новое сообщение
                $message = $messageRule->ToMessage();
                $message->idAppointment = $appointment->id;
                $message->isNew = 0;
                $message->isDraft = $isDraft;

                if (($isDraft == 1)) {
                    $dbMessage->Save($message);
                    continue;
                }
            }
            
            //  Если не было ручного редактирования сообщения и сообщение ещё не отправлено
            if (($message->isManualEdited == 0) && ($message->ageWasSended == 0)) {

                //  Проверим, что контакт для отсылки сообщения был найден
                if (sizeOf($contact) == 2) {

                    // Возьмём контакты получателя.
                    $message->idTypeChannel = $contact[0];
                    $message->strAdress = $contact[1];

                    //  Найдём дату отправки сообщения
                    //$date = 0;
                    switch($messageRule->idTypeDate) {
                        case EnumDateTypes::TypeDateNow:
                            $date = substr($ticsNow, 0, 8);
                            break;
                        case EnumDateTypes::TypeDateNextAppointment:
                            $date = substr($appointment->ageOrderStart, 0, 8);
                            break;
                        case EnumDateTypes::TypeDateCreateAppointment:
                            $date = substr($appointment->ageCreated, 0, 8);
                            break;
                        default:
                            continue 2;
                    }
                    
                    //  Найдём время отправки сообщения
                    //$time = 0;
                    switch($messageRule->idTypeTime) {
                        case EnumTimeTypes::TypeTimeNow:
                            $time = substr($ticsNow, 8, 4);
                            break;
                        case EnumTimeTypes::TypeTimeArrivalNextVisit:
                            $time = substr($appointment->ageOrderStart, 8, 4);
                            break;
                        case EnumTimeTypes::TypeTimeDepartureNextVisit:
                            $age = new Age();
                            $start = $appointment->ageOrderStart;
                            $age->SetDateTime(substr($start, 0, 8), substr($start, 8, 4));
                            $age->AddToAge(0, 0, 0, 0, $appointment->intMinutesDuration, 0);
                            $ticsEnd = $age->GetLongAge();
                            $time = substr($ticsEnd, 8, 4);
                            break;
                        case EnumTimeTypes::TypeTimeCreateAppointment:
                            $time = substr($appointment->ageCreated, 8, 4);
                            break;
                        default:
                            continue 2;
                    }
                    
                    //  Если время корректно установлено
                    if ((($date * 1) > 0) && (($time * 1) > 0)) {

                        //  Рассчитаем время отсылки сообщения
                        $age = new Age();
                        $age->SetDateTime($date, $time);
                        $age->AddToAge(0, 0, 0, $messageRule->intHoursShift, 0, 0);
                        $ticsSend = $age->GetLongAge();

                        //  Проверим, что время отправки сообщений ещё не поздно. Нет смысла отсылать напоминания, если человек записался, например, за пару часов до Визита.
                        $flagAgeIsFit = 0;
                        switch($messageRule->idTypeTime) {
                            case EnumTimeTypes::TypeTimeNow:
                                //  Все сообщения с типом - ПРЯМО СЕЙЧАС - отсылаем без ограничений
                                $flagAgeIsFit = 1;
                                $ticsSend = 0;
                                break;
                            case EnumTimeTypes::TypeTimeDepartureNextVisit:
                                //  Все сообщения после Визита отсылаем без ограничений
                                //  А вот здесь не проверяем, сравнивая рассчитанное время с текущим
                                $flagAgeIsFit = 1;
                                break;
                            case EnumTimeTypes::TypeTimeArrivalNextVisit:
                                //  Проверим, что до начала Визита больше 2-х часов
                                //  И ещё проверим, что рассчитанное время отсылки сообщения не меньше текущего
                                if ($ticsTwoHoursAfterNow < $appointment->ageOrderStart)
                                    $flagAgeIsFit = 1;
                                break;
                            case EnumTimeTypes::TypeTimeCreateAppointment:
                                //  Проверим, что создаётся Запись как минимум за 1 час до начала Визита
                                //  И ещё проверим, что рассчитанное время отсылки сообщения не меньше текущего
                        
                                $start = $appointment->ageCreated;
                                $date = substr($start, 0, 8);
                                $time = substr($start, 8, 4);
                                $age = new Age();
                                $age->SetDateTime($date, $time);
                                $age->AddToAge(0, 0, 0, 1, 0, 0);
                                $ticsCreatedPlusOneHour = $age->GetLongAge();
                                
                                //  Если до начала Визита больше часа времени или если это первое (а значит - тестовое) сообщение
                                if (($ticsCreatedPlusOneHour < $appointment->ageOrderStart) || ($appointment->id == 1)) {
                                    $flagAgeIsFit = 1;
                                    $ticsSend = 0;
                                }
                                break;
                        }
                        
                        //  Если указаны конкретная дата и время отправки, то мы можем их проверить на такие условия...
                        if ($ticsSend > 0) {
                            
                            //  Проверим, что дата и время отправки ещё не прошли
                            if ($ticsNow > $ticsSend)   $flagAgeIsFit = 0;
                        
                            //  Проверим, что время отправки не раньше 9:00
                            $time = substr($ticsSend, 8, 4) * 1;
                            if ($time < 900)    $flagAgeIsFit = 0;
                            
                            //  Проверим, что время отправки не позже 21:00
                            if ($time > 2100)    $flagAgeIsFit = 0;
                        }



                        //  Если проверка на время отправки пройдена
                        if ($flagAgeIsFit == 1) {
                            $message->ageWillSend = $ticsSend;

                            //  Теперь нужно сгенерировать сообщение в зависимости от его типа текстовое/медийное(Html/video/audio)/голосовое
                            switch($message->idTypeMessage) {
                                case EnumTypeMessage::TypeMessageText:
                                    //  Для текстового сообщения просто заменим Зарезервированные слова.
                                    $message->strBodyOut = FillReservedWordsInMessage($messageRule->strBody);
                                    $message->strBodyOut = CorrectMessage($message->strBodyOut);
                                    break;
                                case EnumTypeMessage::TypeMessageMedia:
                                    require_once '../php-scripts/utils/getUrlFile.php';
                                    
                                    //  Выбираем из подготовленных отчётов
                                    switch($messageRule->idReport) {
                                        case EnumPreGeneratedReports::TypeCreateTalon:
                                            //  Пока сделал только генерацию талона для сотрудника
                                            $message->strBodyOut = getUrlFile("https://запишись.онлайн/api/v1/appointments/generateTalon.php?id=".$appointment->longCode, null);
                                            //  А сюда вставляю заголовок письма. Теперь уже неважно, что затрём...
                                            $message->strBody = CorrectMessage(FillReservedWordsInMessage($messageRule->strBody));
                                            break;
                                        case EnumPreGeneratedReports::TypeCancelAppointment:
                                            $message->strBodyOut = CorrectMessage(FillReservedWordsInMessage($messageRule->strBody));
                                            $message->strBody = "Отмена записи клиентом";
                                            break;
                                        case EnumPreGeneratedReports::TypeCreateReview:
                                            $message->strBodyOut = CorrectMessage(FillReservedWordsInMessage($messageRule->strBody));
                                            $message->strBody = "Клиент оставил отзыв";
                                            break;
                                            break;
                                    }
                                    break;
                                case EnumTypeMessage::TypeMessageVoice:
                                    //  Подготовить сообщение для робота
                                    //  Для голосового сообщения пока тоже просто заменим Зарезервированные слова.
                                    $message->strBodyOut = FillReservedWordsInMessage($messageRule->strBody);
                                    $message->strBodyOut = CorrectMessage($message->strBodyOut);
                                    break;
                            }
                            $dbMessage->Save($message);
                        }
                        else {
                            //  Если сообщение не проходит по времени, то ставим ему флаг удаления. Но сохраняем в базе, чтобы не воссоздавать повторно
                            $dbMessage->Delete($message->id);
                        }
                    }
                }
            }
        }
    }

    
    function GetContactUser($idDB, $idUser, $idTypeUser) {
        require_once('../php-scripts/db/dbContacts.php');
        $dbContact = new DBContact($idDB);
        
        $email = $dbContact->GetAlllowedContact($idUser, $idTypeUser, EnumTypeContacts::TypeEmail);
        if (!empty($email))
            return array(EnumTypeChannels::TypeChannelEmail, $email);
        
        $vk = $dbContact->GetAlllowedContact($idUser, $idTypeUser, EnumTypeContacts::TypeVK);
        if (!empty($vk))
            return array(EnumTypeChannels::TypeChannelVk, $vk);
        
        $phone = $dbContact->GetAlllowedContact($idUser, $idTypeUser, EnumTypeContacts::TypePhone);
        if (!empty($phone))
            return array(EnumTypeChannels::TypeChannelPhone, $phone);

        return array();
    }
    function GetContactClient($idDB, $idClient) {
        return GetContactUser($idDB, $idClient, EnumEssential::CLIENTS);
    }
    function GetContactEmployee($idDB, $idEmployee) {
        return GetContactUser($idDB, $idEmployee, EnumEssential::EMPLOYEE);
    }
    
    function CorrectMessage($str) {
        $strRet = trim($str);
        $char = mb_substr($strRet, 0, 1);
        $zikl = true;
        $count = strlen($strRet);
        while ($zikl) {
            if (($char == ',') || ($char == '.') || ($char == '?') || ($char == '!') || ($char == '-') || ($char == '+')) {
                $strRet = mb_substr($strRet, 1);
                $strRet = trim($strRet);
                $char = mb_substr($strRet, 0, 1);
            }
            else    $zikl = false;
            $count--;
            if ($count < 0) $zikl = false;
        }

        $strRet = mb_strtoupper(mb_substr($strRet, 0, 1)).mb_substr($strRet, 1);
        return $strRet;
    }

?>