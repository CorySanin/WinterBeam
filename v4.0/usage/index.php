<?php

$XMLstring = @file_get_contents('php://input');
$requestSXML = simplexml_load_string($XMLstring);

$namespaces['i'] = "http://www.w3.org/2001/XMLSchema-instance";

foreach($requestSXML->actions->action as $action){
    echo $action->track->mediaId;
}
?>