<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/message.php');
    
    class DBMessageTemplate extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("MessageTemplates", $idDb);
            $this->Init("MessageTemplates", $idDb);
        }

        public function Save($message) {
            $this->CreateContentValue();
            $this->AddContentValue("idType", $message->idType);
            $this->AddContentValue("strBody", $message->strBody);
            $this->AddContentValue("strUidUser", $message->strUidUser);
            $this->AddContentValue("intCodeUidUser", $this->GetSimpleCode($message->strUidUser));
            $this->AddContentValue("ageWillSend", $message->ageWillSend);
            $this->AddContentValue("ageWasSended", $message->ageWasSended);
            $this->AddContentValue("idTypeChannel", $message->idTypeChannel);
            $this->AddContentValue("strAdress", $message->strAdress);
            $this->AddContentValue("idMessageRule", $message->idMessageRule);
            $this->AddContentValue("idReport", $message->idReport);
            $this->AddContentValue("isTextMessage", $message->isTextMessage);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($message->id == 0) {
                $this->AddContentValue("isDeleted", $message->isDeleted);
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($message->id);
            }
            
            $result = $this->ExecuteQuery($query);
            if ($message->id == 0)   $message->id = $this->GetInsertedId();
            return $message->id;
        }

        public function GetRow($row) {
            $obj = new Message();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idType = $row[$i++];
            $obj->strBody = $row[$i++];
            $obj->strUidUser = $row[$i++];
            $obj->intCodeUidUser = $row[$i++];

            $obj->ageWillSend = $row[$i++];
            $obj->ageWasSended = $row[$i++];
            $obj->idTypeChannel = $row[$i++];
            $obj->strAdress = $row[$i++];
            $obj->idMessageRule = $row[$i++];
            $obj->idReport = $row[$i++];
            $obj->isTextMessage = $row[$i++];
            
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

    }

?>