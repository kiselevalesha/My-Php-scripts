<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/assistentText.php');
    
    class DBAssistentTip extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("AssistentTips", $idDb);

            $this->strFields = 'strTitle,strDescription,strComment,isClicked,isViewed';
            $this->Init("AssistentTips", $idDb);
        }


        public function AddTips() {
            $strTitle = "Добавьте ваши услуги";
            $strDescription = "Заполните прайслист, указав название услуг, их цену и длительность.";
            $this->Add($strTitle, $strDescription);

            $strTitle = "Создайте график работы";
            $strDescription = "Укажите рабочие дни и часы приёма клиентов.";
            $this->Add($strTitle, $strDescription);

            $strTitle = "Посмотрите короткие видеоуроки";
            $strDescription = "Чтобы увидеть примеры использование возможностей сервиса.";
            $this->Add($strTitle, $strDescription);

/*
            $strTitle = "";
            $strDescription = "";
            $this->Add($strTitle, $strDescription);
*/
        }

        public function Add($strTitle, $strDescription) {
            $obj = new AssistentText();
            $obj->strTitle = $strTitle;
            $obj->strDescription = $strDescription;
            //$obj->strComment = $strComment;
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