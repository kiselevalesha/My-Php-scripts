<?
    require_once('../php-scripts/db/dbUsersSqlDbs.php');

    class DBEmployeeSqldb extends DBUserSqlDb {

        public function __construct(){
            parent::__construct();
            //$this->DropTable("EmployeeSqlDb", "");
            $this->Init("EmployeeSqlDb", "");
        }
    }
?>