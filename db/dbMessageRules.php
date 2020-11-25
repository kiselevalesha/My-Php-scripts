<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/message.php');
    include_once('../php-scripts/models/messageRule.php');
    include_once('../php-scripts/models/essential.php');
    
    class DBMessageRule extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("MessageRules", $idDb);
            $this->Init("MessageRules", $idDb);
        }

        public function New() {
            $obj = new MessageRule();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetMessageRule($id) {
            $obj = new MessageRule();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("strBody", $obj->strBody);
            
            $this->AddContentValue("idTypeRecepient", $obj->idTypeRecepient);
            $this->AddContentValue("idTypeMessage", $obj->idTypeMessage);
            $this->AddContentValue("idTypeChannel", $obj->idTypeChannel);
            $this->AddContentValue("idTypeContent", $obj->idTypeContent);
            $this->AddContentValue("isApproved", $obj->isApproved);
            
            $this->AddContentValue("idTypeDate", $obj->idTypeDate);
            $this->AddContentValue("ageCustom", $obj->ageCustom);
            $this->AddContentValue("idTypeTime", $obj->idTypeTime);
            $this->AddContentValue("intTimeCustom", $obj->intTimeCustom);
            $this->AddContentValue("intHoursShift", $obj->intHoursShift);
            $this->AddContentValue("idTypeDelivery", $obj->idTypeDelivery);
            $this->AddContentValue("idTypeRepeat", $obj->idTypeRepeat);
            $this->AddContentValue("intRepeatCustom", $obj->intRepeatCustom);
            
            $this->AddContentValue("idCategoryClients", $obj->idCategoryClients);
            $this->AddContentValue("idCategoryEmployee", $obj->idCategoryEmployee);
            $this->AddContentValue("idCategoryProducts", $obj->idCategoryProducts);
            $this->AddContentValue("idCategoryServices", $obj->idCategoryServices);
            $this->AddContentValue("idCategoryPlaces", $obj->idCategoryPlaces);
            $this->AddContentValue("intRateByMaster", $obj->intRateByMaster);
            $this->AddContentValue("intRateByClient", $obj->intRateByClient);
            
            $this->AddContentValue("idReport", $obj->idReport);
            $this->AddContentValue("isHidden", $obj->isHidden);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("isUse", $obj->isUse);

            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id < 1) {
                $this->AddContentValue("isDeleted", $obj->isDeleted);
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($obj->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($obj->id < 1)   $obj->id = $this->GetInsertedId();
            return $obj->id;
        }

        public function GetRow($row) {
            $obj = new MessageRule();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->strName = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->strBody = $row[$i++];

            $obj->idTypeRecepient = $row[$i++];
            $obj->idTypeMessage = $row[$i++];
            $obj->idTypeChannel = $row[$i++];
            $obj->idTypeContent = $row[$i++];
            $obj->isApproved = $row[$i++];

            $obj->idTypeDate = $row[$i++];
            $obj->ageCustom = $row[$i++];
            $obj->idTypeTime = $row[$i++];
            $obj->intTimeCustom = $row[$i++];
            $obj->intHoursShift = $row[$i++];
            $obj->idTypeDelivery = $row[$i++];
            $obj->idTypeRepeat = $row[$i++];
            $obj->intRepeatCustom = $row[$i++];
            
            $obj->idCategoryClients = $row[$i++];
            $obj->idCategoryEmployee = $row[$i++];
            $obj->idCategoryProducts = $row[$i++];
            $obj->idCategoryServices = $row[$i++];
            $obj->idCategoryPlaces = $row[$i++];
            $obj->intRateByMaster = $row[$i++];
            $obj->intRateByClient = $row[$i++];
            
            $obj->idReport = $row[$i++];
            $obj->isHidden = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->isUse = $row[$i++];
            
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function AddPrepareRules() {
            $this->AddRule1();
            $this->AddRule2();
            $this->AddRule3();
            $this->AddRule4();
            $this->AddRule5();
            $this->AddRule6();
            $this->AddRule7();
            $this->AddRule8();
            $this->AddRule9();
            $this->AddRule10();
            $this->AddRule11();
            $this->AddRule12();
            $this->AddRule13();
        }
        public function AddRule1() {
            $obj = new MessageRule();
            $obj->strName = "Сообщение клиенту о создании записи";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "[ИМЯ КЛИЕНТА], Вы записаны на приём [ДАТА ПРИЁМА] в [ВРЕМЯ ПРИЁМА]. Ваш талон: [ССЫЛКА НА ТАЛОН]";

            $obj->idTypeRecepient = EnumEssential::CLIENTS;
            $obj->idTypeDate = EnumDateTypes::TypeDateCreateAppointment;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeCreateAppointment;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatOneTime;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageText;
            $obj->idTypeContent = EnumTypeContents::TypeContentText;
            $this->AddPrepareRule($obj);
        }
        public function AddRule2() {
            $obj = new MessageRule();
            $obj->strName = "Напоминание клиенту о приёме за 2 часа";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "[ИМЯ КЛИЕНТА], ждём вас на приём сегодня в [ВРЕМЯ ПРИЁМА].";

            $obj->idTypeRecepient = EnumEssential::CLIENTS;
            $obj->idTypeDate = EnumDateTypes::TypeDateNextAppointment;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeArrivalNextVisit;
            $obj->intHoursShift = -2;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatOneTime;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageText;
            $obj->idTypeContent = EnumTypeContents::TypeContentText;
            $this->AddPrepareRule($obj);
        }
        public function AddRule3() {
            $obj = new MessageRule();
            $obj->strName = "Напоминание клиенту о приёме за 24 часа";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "[ИМЯ КЛИЕНТА], ждём вас завтра на приём в [ВРЕМЯ ПРИЁМА].";

            $obj->idTypeRecepient = EnumEssential::CLIENTS;
            $obj->idTypeDate = EnumDateTypes::TypeDateNextAppointment;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeArrivalNextVisit;
            $obj->intHoursShift = -24;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatOneTime;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageText;
            $obj->idTypeContent = EnumTypeContents::TypeContentText;
            $this->AddPrepareRule($obj);
        }
        public function AddRule4() {
            $obj = new MessageRule();
            $obj->strName = "Отчёт о визите и запрос отзыва, отправляемое клиенту через 2 часа";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "[ИМЯ КЛИЕНТА], высылаем отчёт о проделанной работе [ССЫЛКА НА ОТЧЁТ].";

            $obj->idTypeRecepient = EnumEssential::CLIENTS;
            $obj->idTypeDate = EnumDateTypes::TypeDateNextAppointment;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeDepartureNextVisit;
            $obj->intHoursShift = 2;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatOneTime;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageText;
            $obj->idTypeContent = EnumTypeContents::TypeContentText;
            $this->AddPrepareRule($obj);
        }
        public function AddRule5() {
            $obj = new MessageRule();
            $obj->strName = "Отчёт об итогах дня";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "[ИМЯ СОТРУДНИКА], отчёт о ваших итогах дня [ИТОГИ ДНЯ].";

            $obj->idTypeRecepient = EnumEssential::EMPLOYEE;
            $obj->idTypeDate = EnumDateTypes::TypeDateCustom;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeEndWorkDay;
            $obj->intHoursShift = 1;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatEveryWorkDay;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageText;
            $obj->idTypeContent = EnumTypeContents::TypeContentText;
            $this->AddPrepareRule($obj);
        }
        public function AddRule6() {
            $obj = new MessageRule();
            $obj->strName = "Планы на завтра";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "[ИМЯ СОТРУДНИКА], сводка о вашем расписании на завтра.";

            $obj->idTypeRecepient = EnumEssential::EMPLOYEE;
            $obj->idTypeDate = EnumDateTypes::TypeDateCustom;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeEndWorkDay;
            $obj->intHoursShift = 1;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatEveryDay;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageText;
            $obj->idTypeContent = EnumTypeContents::TypeContentText;
            $this->AddPrepareRule($obj);
        }
        public function AddRule7() {
            $obj = new MessageRule();
            $obj->strName = "Сообщение мастеру об отмене записи";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "[ИМЯ КЛИЕНТА] отменил запись на [ДАТА ПРИЁМА] в [ВРЕМЯ ПРИЁМА].";

            $obj->idTypeRecepient = EnumEssential::EMPLOYEE;
            $obj->idTypeDate = EnumDateTypes::TypeDateNow;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeNow;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatOneTime;
            $obj->isHidden = 1;
            $obj->idTypeChannel = EnumTypeChannels::TypeChannelEmail;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageMedia;
            $obj->idTypeContent = EnumTypeContents::TypeContentHTML;
            $obj->idReport = EnumPreGeneratedReports::TypeCancelAppointment;
            $this->AddPrepareRule($obj);
        }
        public function AddRule8() {
            $obj = new MessageRule();
            $obj->strName = "Сообщение клиенту об отмене записи";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "[ИМЯ КЛИЕНТА], вы отменили запись на [ДАТА ПРИЁМА] в [ВРЕМЯ ПРИЁМА].";

            $obj->idTypeRecepient = EnumEssential::CLIENTS;
            $obj->idTypeDate = EnumDateTypes::TypeDateNow;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeNow;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatOneTime;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageText;
            $obj->idTypeContent = EnumTypeContents::TypeContentText;
            $obj->idReport = EnumPreGeneratedReports::TypeCancelAppointment;
            $this->AddPrepareRule($obj);
        }
        public function AddRule9() {
            $obj = new MessageRule();
            $obj->strName = "Письмо мастеру о создании записи к нему";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "[ИМЯ КЛИЕНТА] записался на [ДАТА ПРИЁМА] в [ВРЕМЯ ПРИЁМА].";

            $obj->idTypeRecepient = EnumEssential::EMPLOYEE;
            $obj->idTypeDate = EnumDateTypes::TypeDateCreateAppointment;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeCreateAppointment;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatOneTime;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageMedia;
            $obj->idTypeContent = EnumTypeContents::TypeContentHTML;
            $obj->idReport = EnumPreGeneratedReports::TypeCreateTalon;
            $this->AddPrepareRule($obj);
        }
        public function AddRule10() {
            $obj = new MessageRule();
            $obj->strName = "Письмо мастеру с отчётом о зарплате за день";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "Расчёт зарплаты за [ДАТА ПРИЁМА].";

            $obj->idTypeRecepient = EnumEssential::EMPLOYEE;
            $obj->idTypeDate = EnumDateTypes::TypeDateNow;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeEndWorkDay;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatEveryWorkDay;
            //$obj->idTypeChannel = EnumTypeChannels::TypeChannelEmail;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageMedia;
            $obj->idTypeContent = EnumTypeContents::TypeContentHTML;
            $obj->idReport = EnumPreGeneratedReports::TypeSalaryDay;
            $this->AddPrepareRule($obj);
        }
        public function AddRule11() {
            $obj = new MessageRule();
            $obj->strName = "Письмо мастеру с отчётом о зарплате за месяц";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "Расчёт зарплаты за месяц.";

            $obj->idTypeRecepient = EnumEssential::EMPLOYEE;
            $obj->idTypeDate = EnumDateTypes::TypeDateNow;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeEndWorkDay;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatEveryWorkDay;
            //$obj->idTypeChannel = EnumTypeChannels::TypeChannelEmail;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageMedia;
            $obj->idTypeContent = EnumTypeContents::TypeContentHTML;
            $obj->idReport = EnumPreGeneratedReports::TypeSalaryMonth;
            $this->AddPrepareRule($obj);
        }
        public function AddRule12() {
            $obj = new MessageRule();
            $obj->strName = "Письмо мастеру с отчётом об итогах за месяц";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "Расчёт итогов работы за месяц.";

            $obj->idTypeRecepient = EnumEssential::EMPLOYEE;
            $obj->idTypeDate = EnumDateTypes::TypeDateNow;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeEndWorkDay;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatEveryWorkDay;
            //$obj->idTypeChannel = EnumTypeChannels::TypeChannelEmail;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageMedia;
            $obj->idTypeContent = EnumTypeContents::TypeContentHTML;
            $obj->idReport = EnumPreGeneratedReports::TypeTotalMonth;
            $this->AddPrepareRule($obj);
        }
        public function AddRule13() {
            $obj = new MessageRule();
            $obj->strName = "Сообщение мастеру о поступлении отзыва";
            $obj->strDescription = "Автоматически созданное правило";
            $obj->strBody = "[ИМЯ КЛИЕНТА] оставил свой отзыв [ССЫЛКА НА ОТЗЫВ]";

            $obj->idTypeRecepient = EnumEssential::EMPLOYEE;
            $obj->idTypeDate = EnumDateTypes::TypeDateNow;
            $obj->idTypeTime = EnumTimeTypes::TypeTimeNow;
            $obj->idTypeRepeat = EnumRepeatTypes::TypeRepeatOneTime;
            $obj->idTypeChannel = EnumTypeChannels::TypeChannelEmail;
            $obj->idTypeMessage = EnumTypeMessage::TypeMessageMedia;
            $obj->idTypeContent = EnumTypeContents::TypeContentHTML;
            $obj->idReport = EnumPreGeneratedReports::TypeCreateReview;
            $this->AddPrepareRule($obj);
        }
        
        public function AddPrepareRule($rule) {
            //  сначала проверить не существует ли уже
            $id = $this->GetIdField("idTypeRecepient=".$rule->idTypeRecepient." AND idTypeDate=".$rule->idTypeDate.
                " AND idTypeTime=".$rule->idTypeTime." AND idTypeMessage=".$rule->idTypeMessage.
                " AND idReport=".$rule->idReport." AND intHoursShift=".$rule->intHoursShift.
                " AND idTypeRepeat=".$rule->idTypeRepeat." AND isNew=0 AND isDeleted=0");
            if ($id > 0)    $rule->id = $id;
            $rule->isApproved = 1;  //  Устанавливаем флаг, что правило одобрено.
            $rule->isNew = 0;
            $this->Save($rule);
        }
    }

?>