<?
    require_once('../php-scripts/db/dbTokenUser.php');

    class DBTokenClient extends dbTokenUser {

        public function __construct(){
            parent::__construct();
            //$this->DropTable("TokensClients", "");
            $this->Init("TokensClients", "");
        }
    }
?>