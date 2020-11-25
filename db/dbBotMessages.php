<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/botMessage.php');
    
    class DBBotMessage extends DBBase {

        public function __construct()
        {
            //$this->DropTable("BotMessages", "");
            $this->strFields = 'strMessage,strJsonResult,ageChanged';
            $this->arraIndexFields = array("ageChanged");
            $this->Init("BotMessages", "");
        }
        
        public function CetBotMessage($id) {
            if ($id > 0)
            $obj = $this->Get($id);
            if (!($obj instanceof BotMessage)) {
                $obj = new BotMessage();
            }
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("strMessage", $obj->strMessage);
            $this->AddContentValue("strJsonResult", $obj->strJsonResult);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id < 1) {
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
            $obj = new BotMessage();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->strMessage = $row[$i++];
            $obj->strJsonResult = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }

?>