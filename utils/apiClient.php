<?
    header('Content-Type: application/json; charset="UTF-8"');
    require_once '../php-scripts/utils/json.php';

    $body = file_get_contents('php://input');
    $json = json_decode($body, false, 32);
    
    $strToken = GetCleanString($json->token);
    if (empty($strToken))   ExitEmptyError("Token is empty!");

    require_once('../php-scripts/db/dbTokenClients.php');
    $dbTokenClient = new DBTokenClient();
    $idDB = $dbTokenClient->GetIdDbByToken($strToken);
?>