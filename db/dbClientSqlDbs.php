<?
    require_once('../php-scripts/db/dbUsersSqlDbs.php');

    class DBClientSqldb extends DBUserSqlDb {

        public function __construct(){
            parent::__construct();
            //$this->DropTable("ClientSqlDb", "");
            $this->Init("ClientSqlDb", "");
        }
    }
?>