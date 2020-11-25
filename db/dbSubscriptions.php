<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/subscription.php');
    
    class DBSubscription extends DBBase {

        public function __construct()
        {
            //$this->DropTable("Subscriptions", "");
            
            $this->strFields = 'idService,idSection,strName,strDescription,cost,idTypeWhat,isAccessable';
            $this->arraIndexFields = array("idService");
            $this->Init("Subscriptions", "");
            //$this->AddServices();
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idService", $obj->idService);
            $this->AddContentValue("idSection", $obj->idSection);
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("cost", $obj->cost);
            $this->AddContentValue("idTypeWhat", $obj->idTypeWhat);
            $this->AddContentValue("isAccessable", $obj->isAccessable);

            if ($obj->id == 0) {
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($obj->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($obj->id == 0)   $obj->id = $this->GetInsertedId();
            return $obj->id;
        }

        public function GetRow($row) {
            $obj = new Subscription();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->idService = $row[$i++];
            $obj->idSection = $row[$i++];
            $obj->strName = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->cost = $row[$i++];
            $obj->idTypeWhat = $row[$i++];
            $obj->isAccessable = $row[$i++];
            return $obj;
        }
        
        
        public function SaveService($idService, $idSection, $name, $description, $cost, $period, $isAccessable) {
            $obj = new Subscription();
            $obj->idService = $idService;
            $obj->idSection = $idSection;
            $obj->strName = $name;
            $obj->strDescription = $description;
            $obj->cost = $cost;
            $obj->idTypeWhat = $period;
            $obj->isAccessable = $isAccessable;
            $this->Save($obj);
        }
        
        function AddServices() {
            $YES = 1;
            $NO = 0;

            $idSection = 1;
            $description = 'Позвольте клиентам записываться к вам самостоятельно, не отвлекая вас от текущих дел. Это просто и удобно для клиента (он видит ваш рабочий график и доступные часы) и убирает с вас необходимость тратить время на телефонные звонки и переписку.';
            $this->SaveService(EnumTypeServices::ONLINEAPPOINTMENTS, $idSection, "Функционал онлайн-записи", $description, 300, EnumSubscriptionWhat::DAY, $YES);
            
            $description = 'Больше возможностей по индивидуальной проработке отношений с клиентами. Аналитика и планирование действий по каждому клиенту.';
            $this->SaveService(EnumTypeServices::CLIENTBASE, $idSection, "Функционал по ведению базы клиентов", $description, 100, EnumSubscriptionWhat::DAY, $YES);
            
            $description = 'Удобно вести учёт и отчётность не только в количественном, но и в визуальном виде, сохраняя фото оказанных клиентам услуг и храня доказательства количественного расхода материалов.';
            $this->SaveService(EnumTypeServices::PHOTOHOSTING, $idSection, "Функционал по хранению фотоматериалов", $description, 1500, EnumSubscriptionWhat::DAY, $YES);
            
            $description = 'Чтобы иметь возможность прослушать любой телефонный разговор администратора с клиентом полезно подключить услугу хранения аудиоматериалов.';
            $this->SaveService(EnumTypeServices::AUDIOHOSTING, $idSection, "Функционал по хранению аудиоматериалов", $description, 2000, EnumSubscriptionWhat::DAY, $YES);
            
            $description = 'Чтобы быть защищёнными от чьей-то случайности или намеренного удаления информации, подключите услугу ежедневного резервирования данных.';
            $this->SaveService(EnumTypeServices::BACKUP, $idSection, "Ежедневное создание копии данных", $description, 300, EnumSubscriptionWhat::DAY, $YES);
            
            $description = 'Весь финансовый учёт в простой и наглядной форме. Для понимания откуда и сколько поступает денег.';
            $this->SaveService(EnumTypeServices::FINANCIALANALYTICS, $idSection, "Функционал по ведению учёта расчётов и оплат", $description, 300, EnumSubscriptionWhat::DAY, $YES);
            
            $description = 'Будьте в курсе что, у кого и когда вы покупаете. А также узнавайте лучшие предложения на рынке от наших партнёров.';
            $this->SaveService(EnumTypeServices::VENDORS, $idSection, "Функционал по ведению учёта закупок", $description, 100, EnumSubscriptionWhat::DAY, $NO);
            
            $description = 'Чтобы эффективно удерживать клиентскую базу, нужно много усилий. Мы помогаем эффективно выполнять эту работу.';
            $this->SaveService(EnumTypeServices::MARKETING, $idSection, "Функционал механик программ лояльности", $description, 1500, EnumSubscriptionWhat::DAY, $NO);
            
            $description = 'Простая возможность подключить онлайн-кассу. В РФ это требует законодательство.';
            $this->SaveService(EnumTypeServices::ONLINEKASSA, $idSection, "Подключение онлайн-кассы", $description, 1500, EnumSubscriptionWhat::DAY, $NO);
            
            $description = 'Сервис может отправлять автоматически сформированные по заданным правилам сообщения вашим клиентам (и вам) в смс, мессенджерах и через социальные сети.';
            $this->SaveService(EnumTypeServices::MESSAGESENDING, $idSection, "Рассылка сообщений от имени сервиса", $description, 500, EnumSubscriptionWhat::SMS, $YES);
            
            $description = 'Помимо отправки текстовых сообщений мы можем предложить услуги коммуникаций посредством голосового робота. Робот может как озвучить заданное сообщение, так и поучаствовать в типичной коммуникации.';
            $this->SaveService(EnumTypeServices::VOICEROBOT, $idSection, "Услуги голосового робота", $description, 600, EnumSubscriptionWhat::MINUTE, $YES);
            
            
            $idSection = 2;
            $description = 'Подключите робота в <b>Телеграм</b> для обработки типичных обращений клиентов.';
            $this->SaveService(EnumTypeServices::BOTTELEGRAM, $idSection, "Чат-бот для Телеграм", $description, 500, EnumSubscriptionWhat::DAY, $NO);
            
            $description = 'Подключите робота во <b>ВКонтакте</b> для обработки типичных обращений клиентов.';
            $this->SaveService(EnumTypeServices::BOTVK, $idSection, "Чат-бот для ВКонтакте", $description, 500, EnumSubscriptionWhat::DAY, $NO);
            
            $description = 'Подключите робота в <b>Фейсбук</b> для обработки типичных обращений клиентов.';
            $this->SaveService(EnumTypeServices::BOTFACEBOOK, $idSection, "Чат-бот для Фейсбук", $description, 500, EnumSubscriptionWhat::DAY, $NO);
            
            
            $idSection = 3;
            $description = 'Проанализируйте динамику своих показателей в наглядном графическом виде, удобном для понимания. Узнайте свои сильные и слабые стороны.';
            $this->SaveService(EnumTypeServices::ANALYTICS, $idSection, "Аналитика ключевых показателей", $description, 300, EnumSubscriptionWhat::DAY, $YES);
            
            $description = 'Доверьте расчёт зарплаты алгоритмам. Ежедневно рассчитанные итоговые заработанные суммы сотрудником будут высылаться вам и сотруднику.';
            $this->SaveService(EnumTypeServices::SALARYCALCULATION, $idSection, "Расчёт зарплаты для одного сотрудника", $description, 100, EnumSubscriptionWhat::DAY, $YES);
            
            $description = 'Если вам важно контролировать расход материалов, можно вести простой и точный учёт.';
            $this->SaveService(EnumTypeServices::MATERIALWASTE, $idSection, "Учёт расхода материалов", $description, 300, EnumSubscriptionWhat::DAY, $NO);
            
            $description = 'Если вам важно снять с себя обязанность отслеживания наличия материалов и прогнозирования времени их закупки, поручите это сервису.';
            $this->SaveService(EnumTypeServices::FORECASTBUYING, $idSection, "Прогноз закупки материалов", $description, 300, EnumSubscriptionWhat::DAY, $NO);
            
            $description = 'Панель с основной статистикой, показываемой в реальном времени. Вы в любой момент оперативно видите, что происходит в вашем бизнесе.';
            $this->SaveService(EnumTypeServices::REALTIMEPANEL, $idSection, "Панель итоговых показателей", $description, 2000, EnumSubscriptionWhat::DAY, $NO);
            
            $description = 'Результирующие итоги по накапливаемым данным за любой отрезок времени в табличном или графическом виде.';
            $this->SaveService(EnumTypeServices::REPORTS, $idSection, "Функционал формирования отчётов", $description, 100, EnumSubscriptionWhat::DAY, $NO);

/*
            $idSection = 4;
            $description = 'Чтобы клиенты возвращались к вас снова, они должны быть довольны. Чтобы узнавать насколько они остались довольны и качественно ли им была оказана услуга по их мнению, предлагаем подключить удалённый сервис контроля качества.';
            $this->SaveService(EnumTypeServices::REQUESTREVIWOPERATOR, $idSection, "Запрос отзыва оператором", $description, 1100, EnumSubscriptionWhat::REQUEST, $NO);
            
            $description = 'Всё тоже самое, но обращаться с клиентом будет робот, а не человек. Это дешевле и эмоционально нейтрально. (Ваши специалисты будут работать ответственнее, а вы будете в курсе обо всех недостатках в ваших процессах.)';
            $this->SaveService(EnumTypeServices::REQUESTREVIWBOT, $idSection, "Запрос отзыва роботом", $description, 400, EnumSubscriptionWhat::REQUEST, $NO);
            
            
            $idSection = 5;
            $description = 'Мы предлагаем подключить удалённого администратора из колл-центра, который сможет отвечать на звонки в не рабочее время и выходные дни в вашу компанию и записывать клиентов на услуги.';
            $this->SaveService(EnumTypeServices::INCOMECALLOPERATOR, $idSection, "Обработка обращения оператором", $description, 1500, EnumSubscriptionWhat::REQUEST, $NO);
            
            $description = 'Возможно подключить на входящие звонки робота для ответа на частые вопросы и записи на услуги в то время, когда ваши администраторы не работают. (Ночное время и выходные дни). Оплата только за обращения. Если к вам никто не обращается, вы ничего не платите.';
            $this->SaveService(EnumTypeServices::INCOMECALLBOT, $idSection, "Обработка обращения роботом", $description, 1000, EnumSubscriptionWhat::REQUEST, $NO);
*/
        }

/*
"templates":[
    {"name":"Максимум возможностей", "description":"Получите максимум пользы от предлагаемых возможностей", "details":"", "ids":""},
    {"name":"Сотрудник салона", "description":"Типовой набор услуг для пользователя сервиса, работающего в коллективе", "details":"", "ids":""},
    {"name":"Индивидуальный мастер", "description":"Типовой набор услуг для пользователя сервиса, работающего индивидуально", "details":"", "ids":""},
    {"name":"Сервис удалённых администраторов", "description":"Возможность заменить штатного администратора внешним сервисом.", "details":"", "ids":""},
    {"name":"Сервис контроля качества", "description":"Возможность повысить качество оказываемых услуг, поручив внешнему сервису контроль работы сотрудников", "details":"", "ids":""}
],
*/

    }

?>