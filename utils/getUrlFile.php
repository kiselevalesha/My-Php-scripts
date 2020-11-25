<?

    $strUrlFirebaseStoreFunctions = "https://us-central1-beautymasters-84181.cloudfunctions.net/";
    $strUpdateTalkFunction = "markChangedTalk";
    $strAddTalkFunction = "addTalk";
    $strAddAndroidDeviceFunction = "addAndroidDevice";

function getUrlFile($url, $post) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    
    if(!empty($post)) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    }
    
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

/*
$otvet= getUrlFile("http://google.com/", null);
echo strlen($otvet);
echo $otvet;
*/

?>