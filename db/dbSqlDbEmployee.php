<?
    require_once('../php-scripts/db/dbSqlDbUser.php');

    class DBSqlDbEmployee extends DBSqlDBUser {

        public function __construct() {
            parent::__construct();
            //$this->DropTable("SqlDbEmployee", "");
            $this->Init("SqlDbEmployee", "");
        }
    }
?>