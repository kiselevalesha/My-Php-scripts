<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/city.php');
    
    class DBCity extends DBBase {

        public function __construct()
        {
            $this->strTableName = "SrvCities";
            //$this->idTable = 21;
            //echo "DBCity constructor";
        }

        public function CreateTable() {
            $query = "CREATE TABLE ".$this->strTableName." (id INTEGER not null primary key auto_increment,
            strName BLOB,
            idRegion TINYINT)";
            $result = mysql_query($query);
            if (!$result) $this->DBExitError($strDBErrorCreateTable.mysql_error()." - ".$query);
            //echo "DBCity CreateTable ".$this->strTableName;
        }
        
        public function Save($city) {
            $this->CreateContentValue();
            $this->AddContentValue("idRegion", $city->idRegion);
            $this->AddContentValue("strName", $city->strName);

            if ($city->id == 0) {
                $this->AddContentValue("dateTimeCreated", (new DateTime())->getTimestamp());
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($city->id);
            }

            //echo "<br>query=$query";
            $result = mysql_query($query);
            if (!$result) $this->DBExitError(mysql_error()." - ".$query);
        }
        
        public function GetArrayCities() {
            $arrayCities = array();
            
            $city = new City();
            $city->id = 1;
            $city->strName = "Москва";
            $city->$strRName = "Москве";
            array_push($arrayCities, $city);
            
            $city = new City();
            $city->id = 2;
            $city->strName = "Санкт-Петербург";
            $city->$strRName = "Санкт-Петербурге";
            array_push($arrayCities, $city);
            
            $city = new City();
            $city->id = 3;
            $city->strName = "Самара";
            $city->$strRName = "Самаре";
            array_push($arrayCities, $city);
            
            $city = new City();
            $city->id = 4;
            $city->strName = "Сочи";
            $city->$strRName = "Сочи";
            array_push($arrayCities, $city);
            
            $city = new City();
            $city->id = 5;
            $city->strName = "Балашиха";
            $city->$strRName = "Балашихе";
            array_push($arrayCities, $city);

            return $arrayCities;
        }

        public function GetNameCityById($id) {
            $arrayCities = $this->GetArrayCities();
            for ($i = 0; $i < sizeOf($arrayCities); $i++)
                if (strcmp($arrayCities[$i]->id, $id) == 0) return $arrayCities[$i]->strName;
            return "";
        }

        public function GetNameRCityById($id) {
            $arrayCities = $this->GetArrayCities();
            for ($i = 0; $i < sizeOf($arrayCities); $i++)
                if (strcmp($arrayCities[$i]->id, $id) == 0) return $arrayCities[$i]->$strRName;
            return "";
        }
    }
?>