<?
    include_once('../php-scripts/db/dbBase.php');

    class DBGlobalTalk extends DBBase {

        public function __construct()
        {
            //$this->DropTable("GlobalTalk", "");
            $this->strFields = 'strTokenCreator,intCountTotalMessages,ageCreated,ageChanged';
            $this->arraIndexFields = array("strTokenCreator");
            $this->Init("GlobalTalk", "");
        }

        public function AddTalk($strToken) {
            $this->CreateContentValue();
            $this->AddContentValue("strTokenCreator", $strToken);
            $this->AddContentValue("intCountTotalMessages", 0);
            $this->AddContentValue("ageCreated", $this->NowLong());
            $this->AddContentValue("ageChanged", $this->NowLong());

            $query = $this->GetInsertSQL();
            $result = $this->ExecuteQuery($query);
            $id = $this->GetInsertedId();
            return $id;
        }

        public function GetRow($row) {
            $obj = new Group();
            $obj->id = $row[0];
            $obj->strTokenCreator = $row[1];
            $obj->intCountTotalMessages = $row[2];
            $obj->ageCreated = $row[3];
            $obj->ageChanged = $row[4];
            return $obj;
        }
    }

?>