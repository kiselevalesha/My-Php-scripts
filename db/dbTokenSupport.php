<?
    require_once('../php-scripts/db/dbTokenUser.php');

    class DBTokenSupport extends dbTokenUser {

        public function __construct() {
            parent::__construct();
            //$this->DropTable("TokensSupport", "");
            $this->Init("TokensSupport", "");
        }
    }
?>