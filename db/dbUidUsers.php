<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/uid.php');

    class DBUidUser extends DBBase {
        
        public function __construct() {
            $this->strFields = "strUid,intCodeUid,idToken,ageCreated";
            $this->arraIndexFields = array("intCodeUid","idToken");
        }

        public function Add($strUid, $idToken) {
            
            //  На всякий случай попытаемся удалить вдруг существующий uid
            if (!empty($strUid))
                $this->DeleteRowsBySql("intCodeUid=".$this->GetSimpleCode($strUid)." AND strUid LIKE '$strUid'");
            
            $uid = new Uid();
            if (empty($strUid)) $uid->strUid = uniqid();
            else                $uid->strUid = $strUid;
            $uid->intCodeUid = $this->GetSimpleCode($uid->strUid);
            $uid->idToken = $idToken;
            $uid->ageCreated = $this->NowLong();
            $uid->id = $this->Save($uid);
            return $uid;
        }

        public function Save($uid) {
            $this->CreateContentValue();
            $this->AddContentValue("strUid", $uid->strUid);
            $this->AddContentValue("intCodeUid", $this->GetSimpleCode($uid->strUid));
            $this->AddContentValue("idToken", $uid->idToken);
            $this->AddContentValue("ageCreated", $uid->ageCreated);

            if ($uid->id == 0) {
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($uid->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($uid->id == 0)   $uid->id = $this->GetInsertedId();
            return $uid->id;
        }

        public function GetRow($row) {
            $uid = new Uid();
            $i=0;
            $uid->id = $row[$i++];
            $uid->strUid = $row[$i++];
            $uid->intCodeUid = $row[$i++];
            $uid->idToken = $row[$i++];
            $uid->ageCreated = $row[$i++];
            return $uid;
        }

        public function GetIdTokenByUid($strUid) {
            $idToken = 0;
            if (strlen($strUid) > 0) {
                $sqlWhere = "intCodeUid=".$this->GetSimpleCode($strUid)." AND strUid LIKE '$strUid'";
                $idToken = $this->GetIntField("idToken", $sqlWhere);
            }
            return $idToken;
        }

    }
?>