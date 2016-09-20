<?php
//this is a test document to get information from Xbox.

$ch = curl_init();
$timeout = 60;
//$inGT = 'CoryRS';
curl_setopt($ch, CURLOPT_URL, 'https://xboxapi.com/v2/xuid/' . $inGT);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-AUTH: 9ee41da0d353ddbae56a999ba6c88f6dcf4271c9'
    ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$xuid = curl_exec($ch);
curl_close($ch);
//echo $xuid . "<br/><br/>";

$ch = curl_init();
$timeout = 60;
curl_setopt($ch, CURLOPT_URL, 'https://xboxapi.com/v2/' . $xuid . '/gamercard');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-AUTH: 9ee41da0d353ddbae56a999ba6c88f6dcf4271c9'
    ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$data = curl_exec($ch);
curl_close($ch);

$outobj = json_decode($data, true);
//print_r($outobj);
$outBio = $outobj['bio'];
$outGT = $outobj['gamertag'];
?>