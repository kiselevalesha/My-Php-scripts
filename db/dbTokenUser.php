<?
    require_once('../php-scripts/db/dbBase.php');
    require_once('../php-scripts/models/tokenUser.php');

    class dbTokenUser extends DBBase {
        
        public function __construct() {
            $this->strFields = "isDeleted,strToken,intCodeToken, strTokenTemp,intCodeTokenTemp,ageTempTokenAlive, idMainDB, strFirebase,intCodeFirebase, strLogin,intCodeLogin,strPassword,intCodePassword,summaTotalPayments,summaTotalWastes,isTokenActive,isInitializationed,isUrlInitializationed,ageCreated,ageChanged";
            $this->arraIndexFields = array("intCodeToken", "intCodeLogin");
        }

        public function Save($token) {
            $this->CreateContentValue();
            $this->AddContentValue("strToken", $token->strToken);
            $this->AddContentValue("intCodeToken", $this->GetSimpleCode($token->strToken));
            $this->AddContentValue("strTokenTemp", $token->strTokenTemp);
            $this->AddContentValue("intCodeTokenTemp", $this->GetSimpleCode(md5($token->strTokenTemp)));
            $this->AddContentValue("ageTempTokenAlive", $token->ageTempTokenAlive);
            $this->AddContentValue("idMainDB", $token->idMainDB);
            $this->AddContentValue("strFirebase", $token->strFirebase);
            $this->AddContentValue("intCodeFirebase", $this->GetSimpleCode($token->strFirebase));
            $this->AddContentValue("strLogin", $token->strLogin);
            $this->AddContentValue("intCodeLogin", $this->GetSimpleCode($token->strLogin));
            $this->AddContentValue("strPassword", $token->strPassword);
            $this->AddContentValue("intCodePassword", $this->GetSimpleCode($token->strPassword));
            $this->AddContentValue("summaTotalPayments", $token->summaTotalPayments);
            $this->AddContentValue("summaTotalWastes", $token->summaTotalWastes);
            $this->AddContentValue("isTokenActive", $token->isTokenActive);
            $this->AddContentValue("isInitializationed", $token->isInitializationed);
            $this->AddContentValue("isUrlInitializationed", $token->isUrlInitializationed);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($token->id == 0) {
                $this->AddContentValue("isDeleted", 0);
                $this->AddContentValue("ageCreated", $this->NowLong());
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($token->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($token->id == 0)   $token->id = $this->GetInsertedId();
            return $token->id;
        }

        public function GetRow($row) {
            $token = new TokenUser();
            $i = 0;
            $token->id = $row[$i++];
            $token->isDeleted = $row[$i++];
            $token->strToken = $row[$i++];
            $token->intCodeToken = $row[$i++];
            $token->strTokenTemp = $row[$i++];
            $token->intCodeTokenTemp = $row[$i++];
            $token->ageTempTokenAlive = $row[$i++];
            $token->idMainDB = $row[$i++];
            $token->strFirebase = $row[$i++];
            $token->intCodeFirebase = $row[$i++];
            $token->strLogin = $row[$i++];
            $token->intCodeLogin = $row[$i++];
            $token->strPassword = $row[$i++];
            $token->intCodePassword = $row[$i++];
            $token->summaTotalPayments = $row[$i++];
            $token->summaTotalWastes = $row[$i++];
            $token->isTokenActive = $row[$i++];
            $token->isInitializationed = $row[$i++];
            $token->isUrlInitializationed = $row[$i++];
            $token->ageCreated = $row[$i++];
            $token->ageChanged = $row[$i++];
            return $token;
        }

        public function GetIdDbByToken($strToken) {
            //  Вообще к токену могут относиться много баз данных (DB).
            //  Но для оптимизации мы главную(основную) его DB сохраняем вместе с токеном. И возвращаем именно её.
            $sqlWhere = "intCodeToken=".$this->GetSimpleCode($strToken)." AND strToken LIKE '$strToken'";
            return $this->GetIntField("idMainDB", $sqlWhere);
        }

        public function GetIdByLoginPassword($strLogin, $strPassword) {
            $sqlWhere = "intCodeLogin=".$this->GetSimpleCode($strLogin)." AND strLogin LIKE '$strLogin'".
                        " AND intCodePassword=".$this->GetSimpleCode($strPassword)." AND strPassword LIKE '$strPassword'";
            return $this->GetIdField($sqlWhere);
        }
    }
?>