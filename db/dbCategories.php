<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/category.php');
    
    class DBCategory extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("HierarchyCategories", $idDb);
            $this->Init("HierarchyCategories", $idDb);
        }

        public function New() {
            $obj = new Category();
            //$obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetCategory($id) {
            $obj = new Category();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            //$this->AddContentValue("isDeleted", $obj->isDeleted);
            $this->AddContentValue("idEssential", $obj->idEssential);
            $this->AddContentValue("idCategory", $obj->idCategory);
            $this->AddContentValue("idOwner", $obj->idOwner);
            $this->AddContentValue("idParent", $obj->idParent);
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id < 1) {
                $this->AddContentValue("isDeleted", $obj->isDeleted);
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
            $obj = new Category();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idEssential = $row[$i++];
            $obj->idCategory = $row[$i++];
            $obj->idOwner = $row[$i++];
            $obj->idParent = $row[$i++];
            $obj->strName = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function GetJsonCategories($idEssential=0) {
            //  получим весь список элементов иерархии
            $strJson = '{"id":0,"name":"Общий раздел","essential":'.$idEssential.',"parent":-1,"owner":0,"category":0}';
            
            $sqlWhere = "isDeleted=0 AND isNew=0";
            if ($idEssential > 0)   $sqlWhere .= " AND idEssential=".$idEssential;

            $arrayCategories = $this->GetArrayOrderRows($sqlWhere, "strName");
            foreach ($arrayCategories as $category) {
                $strJson .= ',{'.$this->MakeJson($category).'}';
            }

            return $strJson;
        }
    }

?>