<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/message.php');


    class DBMessage extends DBBase {
        
        public $strFolderUpload = "uploads/";

        public function __construct($idDb)
        {
            //$this->DropTable("Msg", $idDb);

            $this->strFields = 'isDeleted,idTalk,idAppointment,idTypeContent,strBody,strBodyOut,strUidUser,intCodeUidUser,idUser,
            idEssential,ageWillSend,ageWasSended,ageIncome,idTypeChannel,strAdress,idMessageRule,isApproved,idReport,idTypeMessage,
            isNew,isHidden,isDraft,isManualEdited,idTypeError,idSenderError,strSenderError,costSender,cost,strIdSigmaMessage,strJson,ageChanged';
            $this->arrayIndexFields = array("idTalk", "idAppointment", "ageWillSend");
            $this->idTable = EnumIdTables::Messages;
            $this->Init("Msg", $idDb);
        }

        public function New() {
            $obj = new Message();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function Save($message) {
            $this->CreateContentValue();
            $this->AddContentValue("idTalk", $message->idTalk);
            $this->AddContentValue("idAppointment", $message->idAppointment);
            $this->AddContentValue("idTypeContent", $message->idTypeContent);
            $this->AddContentValue("strBody", $message->strBody);
            $this->AddContentValue("strBodyOut", $message->strBodyOut);
            
            $this->AddContentValue("strUidUser", $message->strUidUser);
            $this->AddContentValue("intCodeUidUser", $this->GetSimpleCode($message->strUidUser));
            
            $this->AddContentValue("idUser", $message->idUser);
            $this->AddContentValue("idEssential", $message->idEssential);
            
            $this->AddContentValue("ageWillSend", $message->ageWillSend);
            $this->AddContentValue("ageWasSended", $message->ageWasSended);
            $this->AddContentValue("ageIncome", $message->ageIncome);
            
            $this->AddContentValue("idTypeChannel", $message->idTypeChannel);
            $this->AddContentValue("strAdress", $message->strAdress);
            $this->AddContentValue("idMessageRule", $message->idMessageRule);
            $this->AddContentValue("isApproved", $message->isApproved);
            
            $this->AddContentValue("idReport", $message->idReport);
            $this->AddContentValue("idTypeMessage", $message->idTypeMessage);
            $this->AddContentValue("isNew", $message->isNew);
            $this->AddContentValue("isHidden", $message->isHidden);
            $this->AddContentValue("isDraft", $message->isDraft);
            $this->AddContentValue("isManualEdited", $message->isManualEdited);
            
            $this->AddContentValue("idTypeError", $message->idTypeError);
            $this->AddContentValue("idSenderError", $message->idSenderError);
            $this->AddContentValue("strSenderError", $message->strSenderError);
            $this->AddContentValue("costSender", $message->costSender);
            
            $this->AddContentValue("cost", $message->cost);
            $this->AddContentValue("strIdSigmaMessage", $message->strIdSigmaMessage);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($message->id == 0) {
                $this->AddContentValue("isDeleted", $message->isDeleted);
                $query = $this->GetInsertSQLWithoutClean();
            }
            else {
                $query = $this->GetUpdateSQLWithoutClean($message->id);
            }
            
            $result = $this->ExecuteQuery($query);
            if ($message->id == 0)   $message->id = $this->GetInsertedId();
            
            $this->SetFlagChanges();
            return $message->id;
        }

        public function GetRow($row) {
            $obj = new Message();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idTalk = $row[$i++];
            $obj->idAppointment = $row[$i++];
            $obj->idTypeContent = $row[$i++];
            $obj->strBody = $row[$i++];
            $obj->strBodyOut = $row[$i++];

            $obj->strUidUser = $row[$i++];
            $obj->intCodeUidUser = $row[$i++];
            $obj->idUser = $row[$i++];
            $obj->idEssential = $row[$i++];

            $obj->ageWillSend = $row[$i++];
            $obj->ageWasSended = $row[$i++];
            $obj->ageIncome = $row[$i++];
            $obj->idTypeChannel = $row[$i++];
            $obj->strAdress = $row[$i++];
            $obj->idMessageRule = $row[$i++];
            $obj->isApproved = $row[$i++];
            
            $obj->idReport = $row[$i++];
            $obj->idTypeMessage = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->isHidden = $row[$i++];
            $obj->isDraft = $row[$i++];
            $obj->isManualEdited = $row[$i++];
            
            $obj->idTypeError = $row[$i++];
            $obj->idSenderError = $row[$i++];
            $obj->strSenderError = $row[$i++];
            $obj->costSender = $row[$i++];
            
            $obj->cost = $row[$i++];
            $obj->strIdSigmaMessage = $row[$i++];
            
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        
        /*public function MakeJson($obj) {
            return '"id":"'.$obj->id.'",'
                //.'"name":"'.$obj->strName.'",'
                //.'"description":"'.$obj->strDescription.'",'
                .'"changed":'.$obj->ageChanged;
        }*/


        public function GetMessages($idTalk, $idAppointment) {
            $sql = $this->GetSqlForByTalkAndAppointment($idTalk, $idAppointment);
            return $this->GetArrayOrderRows($sql, "ageWasSended, ageWillSend");
        }

        public function GetJsonMessages($idTalk, $idAppointment) {
            return $this->OutJsonMessages($this->GetSqlForByTalkAndAppointment($idTalk, $idAppointment));
        }

        public function GetSqlForByTalkAndAppointment($idTalk, $idAppointment) {
            $sql = "isDeleted=0 AND isHidden=0 AND NOT idTypeContent=".EnumTypeContents::TypeContentHTML;
            if ($idAppointment > 0)    $sql = "idAppointment=".$idAppointment." AND ".$sql;
            else if ($idTalk > 0)    $sql = "idTalk=".$idTalk." AND ".$sql;
            return  $sql;
        }
        
        public function OutJsonMessages($sql) {
            $arrayMessages = $this->GetArrayOrderRows($sql, "ageWasSended, ageWillSend");
        
            $strJsonMessages = "";
            foreach ($arrayMessages as $message) {
                switch($message->idTypeContent) {
                    case EnumTypeContents::TypeContentText:
                    case EnumTypeContents::TypeContentHTML:
                        if (!empty($strJsonMessages))   $strJsonMessages .= ',';
                        $strJsonMessages = $strJsonMessages.'{'.$message->MakeJsonBody().'}';
                        break;
                    case EnumTypeContents::TypeContentImage:
                        if (!empty($strJsonMessages))   $strJsonMessages .= ',';
                        $strJsonMessages = $strJsonMessages.'{"body":"'.$this->strFolderUpload.$message->strBody.'",'.$message->MakeJson().'}';
                        break;
                }
            }
            return  $strJsonMessages;
        }



        
        public function AddUpdateByRule($messageRule, $idAppointment) {
            $id = $this->GetIdField("idAppointment=".$idAppointment." AND idMessageRule=".$messageRule->id." AND isDeleted=0");
            if ($id > 0)
                $obj = $this->Get($id);
            else {
                $obj = $messageRule->ToMessage();
                $obj->idAppointment = $idAppointment;
                $obj->idTypeContent = EnumTypeContents::TypeContentText;
                //$obj->idTypeChannel = EnumTypeChannels::TypeChannelSMS;
                $obj->isNew = 0;
            }
            $this->Save($obj);
        }
        
        
        public function CreateEmailMessage($idTalk, $email, $title, $body) {
            $message = new Message();
            $message->idTalk = $idTalk;
            $message->idTypeContent = EnumTypeContents::TypeContentHTML;
            $message->strBody = $title;
            $message->strBodyOut = $body;

            $message->idTypeChannel = EnumTypeChannels::TypeChannelEmail;
            $message->strAdress = $email;
            $message->idTypeMessage = EnumTypeMessage::TypeMessageMedia;
            $message->isApproved = 1;
            $message->isNew = 0;
            $message->isHidden = 1;
            $message->isDraft = 0;
            $this->Save($message);
        }

        public function GetTotalWastes() {
            $arrayWastes = $this->GetArrayRows("");
            $cost = 0;
            foreach ($arrayWastes as $waste) {
                $cost = $cost + $waste->cost;
            }
            return $cost;
        }

    }
?>