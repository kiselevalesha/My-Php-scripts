<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/addclient.php');
    
    class DBAddClient extends DBBase {

        public function __construct()
        {
            //$this->DropTable("AddClients", "");
            $this->strFields = 'idToken,strFIO,idFIO,strTheme,idTheme,strPhoto,strServices,strSchedule,strPhone,strEmail,strVK,strLinkFrom,strLinkTo,strMessage,strDescription,strResult,strAdress,ageChanged';
            $this->arraIndexFields = array("idFIO");
            $this->Init("AddClients", "");
        }
        
        public function CetAddClient($id) {
            if ($id > 0)
            $obj = $this->Get($id);
            if (!($obj instanceof AddClient)) {
                $obj = new AddClient();
            }
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idToken", $obj->idToken);
            $this->AddContentValue("strFIO", $obj->strFIO);
            $this->AddContentValue("idFIO", $obj->idFIO);
            $this->AddContentValue("strTheme", $obj->strTheme);
            $this->AddContentValue("idTheme", $obj->idTheme);
            $this->AddContentValue("strPhoto", $obj->strPhoto);
            $this->AddContentValue("strServices", $obj->strServices);
            $this->AddContentValue("strSchedule", $obj->strSchedule);
            $this->AddContentValue("strPhone", $obj->strPhone);
            $this->AddContentValue("strEmail", $obj->strEmail);
            $this->AddContentValue("strVK", $obj->strVK);
            $this->AddContentValue("strLinkFrom", $obj->strLinkFrom);
            $this->AddContentValue("strLinkTo", $obj->strLinkTo);
            $this->AddContentValue("strMessage", $obj->strMessage);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("strResult", $obj->strResult);
            $this->AddContentValue("strAdress", $obj->strAdress);
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
            $obj = new AddClient();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->idToken = $row[$i++];
            $obj->strFIO = $row[$i++];
            $obj->idFIO = $row[$i++];
            $obj->strTheme = $row[$i++];
            $obj->idTheme = $row[$i++];
            $obj->strPhoto = $row[$i++];
            $obj->strServices = $row[$i++];
            $obj->strSchedule = $row[$i++];
            $obj->strPhone = $row[$i++];
            $obj->strEmail = $row[$i++];
            $obj->strVK = $row[$i++];
            $obj->strLinkFrom = $row[$i++];
            $obj->strLinkTo = $row[$i++];
            $obj->strMessage = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->strResult = $row[$i++];
            $obj->strAdress = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }

?>