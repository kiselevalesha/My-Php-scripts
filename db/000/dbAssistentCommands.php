<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/assistentText.php');
    
    class DBAssistentCommand extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("AssistentCommands", $idDb);

            $this->strFields = 'strTitle,strDescription,strComment,isClicked,isViewed';
            $this->Init("AssistentCommands", $idDb);
        }

        public function AddCommands() {
            $strTitle = "Запиши клиента";
            $strDescription = "Для записи клиента на приём.";
            $strComment = "Создай запись, Новая запись, Добавь запись";
            $this->Add($strTitle, $strDescription, $strComment);

            $strTitle = "Рассчитай клиента";
            $strDescription = "Для рассчёта итоговой суммы оплаты.";
            $strComment = "Посчитай итог, Счёт за услуги, Сделай рассчёт оплаты, Рассчитай оплату";
            $this->Add($strTitle, $strDescription, $strComment);

            $strTitle = "Рассчитай итоги";
            $strDescription = "Для рассчёта итоговых сумм по салону и по каждому работавшему сотруднику.";
            $strComment = "Подбей итоги, Сделай полный расчёт, Расчёт за сегодня, Сегодняшние итоги";
            $this->Add($strTitle, $strDescription, $strComment);

            $strTitle = "Покажи расписание записей";
            $strDescription = "Для формирования графика приёма клиентов";
            $strComment = "Нужен график, Покажи моё рассписание, Какие сегодня планы, Кто сегодня записан";
            $this->Add($strTitle, $strDescription, $strComment);
/*
            $strTitle = "";
            $strDescription = "";
            $strComment = "";
            $this->Add($strTitle, $strDescription, $strComment);
*/
        }

        public function Add($strTitle, $strDescription, $strComment) {
            $obj = new AssistentText();
            $obj->strTitle = $strTitle;
            $obj->strDescription = $strDescription;
            $obj->strComment = $strComment;
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            //$this->AddContentValue("idEssential", $obj->idEssential);
            $this->AddContentValue("strTitle", $obj->strTitle);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("strComment", $obj->strComment);
            $this->AddContentValue("isClicked", $obj->isClicked);
            $this->AddContentValue("isViewed", $obj->isViewed);

            if ($obj->id == 0) {
                //$this->AddContentValue("isDeleted", $obj->isDeleted);
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
            $obj = new AssistentText();
            $obj->id = $row[0];
            $obj->strTitle = $row[1];
            $obj->strDescription = $row[2];
            $obj->strComment = $row[3];
            $obj->isClicked = $row[4];
            $obj->isViewed = $row[5];
            return $obj;
        }
    }

?>