<?php
    header('Content-Type: application/json; charset="UTF-8"');
    require_once '../php-scripts/utils/utils.php';
    require_once '../php-scripts/utils/json.php';
    require_once('../php-scripts/models/essential.php');

    $body = file_get_contents('php://input');
    $json = json_decode($body, false, 32);

    $uid = GetCleanString($json->uid);
    $typeUid = GetInt($json->type);    //  EnumEssential::EMPLOYEE или EnumEssential::CLIENTS.

    $uidAndroid = GetCleanString($json->android);

    $strLogin = GetCleanString($json->login);
    $strPassword = GetCleanString($json->password);
    
    switch($typeUid) {
        case EnumEssential::EMPLOYEE:
            require_once '../php-scripts/api/v1/tokens/employee.php';
            break;
        case EnumEssential::CLIENTS:
            require_once '../php-scripts/api/v1/tokens/client.php';
            break;
        default:
            ExitEmptyError("Type is incorrect!");
    }

    echo GetOutJson('"token":"'.$token->strToken.'","host":"talon24.ru"');
?>