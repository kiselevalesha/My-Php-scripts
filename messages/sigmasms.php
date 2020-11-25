<?php error_reporting(E_ALL);
ini_set('display_errors', 1);
/* SigmaSMS REST API 
 * https://online.sigmasms.ru/docs/#/api/HTTP-REST
 */

// Название файла для сохранения токена
$token_filename = '../php-scripts/messages/sigmatoken.txt';

// Универсальная функция отправки
function apiRequest($first = false, $data = false, $url_path = false, $token = false, $file = false) {
    global $token_filename;
    $api_url = 'https://online.sigmasms.ru/api/';
    $login = 'beautymastersapp';
    $pass = 'Balsoch328';
    // Get Token
    if ($first) {
        $fields = array(
            'username' => $login,
            'password' => $pass,
            'type'     => 'local'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.'login');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        if (!$response) {
            $response = json_encode(array('error' => 'true'));
        } else {
            file_put_contents($token_filename, $response);
        }
    } elseif ($url_path && $token) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url.$url_path);
        if ($file) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: ".mime_content_type($data['file']), "Content-length: ".filesize($data['file']), "Authorization: ".$token));
            curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($data['file']));
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json;charset=UTF-8", "Accept: application/json", "Authorization: ".$token));
            if ($data && is_array($data)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $data ));
            }
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        if (!$response) {
            $response = json_encode(array('error' => 'true'));
        }
    }
    header("Content-Type: application/json;charset=UTF-8");
    return $response;
}

// Авторизация и получение токена
function apiAuth() {
    global $token_filename;
    // проверяем токен
    if (file_exists($token_filename) && (date('Y-m-d H:i:s', filemtime($token_filename)) > date('Y-m-d H:i:s', strtotime('-23 hours')))) {
        $result = file_get_contents($token_filename, true);
    } else {
        $result = apiRequest(true);
    }
    //
    $unjes = json_decode($result);
    if (isset($unjes->token) && !empty($unjes->token)) {
        $token = (string) $unjes->token;
    } else {
        $token = null;
    }
    return $token;
}

//
function clear_phone($phone) {
    $phone_number = preg_replace('/[() -]+/', '', $phone);
    return $phone_number;
}

// Загрузка файла
function uploadFile($file_path) {
    $token = apiAuth();
    if ($token) {
        $dataFile = array('file' => dirname(__FILE__).'/'.$file_path);
        return apiRequest(false, $dataFile, 'storage', $token, true);
    }
}

// Отправка одиночного сообщения
function sendOneMess($type, $recipient, $sender, $text, $button = null, $image = null) {
    $token = apiAuth();
    if ($token) {
        $params = array(
            "type"       => $type,
            "recipient"  => clear_phone($recipient),
            "payload"    => array(
                "sender" => $sender,
                "text"   => $text,
                "button" => $button, 
                "image"  => $image
            )
        );
        return apiRequest(false, $params, 'sendings', $token);
    }
}

// Отправка одиночного сообщения по расписанию
function sendOneMessSchedule($type, $recipient, $sender, $text, $schedule, $button = null, $image = null) {
    $token = apiAuth();
    if ($token) {
        $params = array(
            "type"       => $type,
            "recipient"  => clear_phone($recipient),
            "payload"    => array(
                "sender" => $sender,
                "text"   => $text,
                "button" => $button, 
                "image"  => $image
            ),
            "schedule"    => array(
                "delay" => $schedule
            )
        );
        return apiRequest(false, $params, 'sendings', $token);
    }
}

// Отправка каскада
function sendCascade($data) {
    $token = apiAuth();
    if ($token) {
        return apiRequest(false, $data, 'sendings', $token);
    }
}

// Проверка статуса
function checkStatus($id) {
    if ($id) {
        $token = apiAuth();
        if ($token) {
            return apiRequest(false, false, 'sendings/'.$id, $token);
        }
    }
}
?>