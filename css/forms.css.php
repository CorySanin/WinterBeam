<?php
header('Cache-Control: max-age=2592000'); //30days (60sec * 60min * 24hours * 30days)
header('Content-Type: text/css');
?>

form h1{
    margin:2px;
    margin-bottom:10px;
}
form input.textinput{
    position: relative;
    padding: 5px 10px;
    margin:2px;
    margin-top:5px;
    font-size:13px;
    font-weight: bold;
    border: 2px solid #ccc;
    cursor: pointer;
    color:#888;
}
.button{
    position: relative;
    padding: 5px 10px;
    margin:2px;
    margin-top:5px;
    font-size:13px;
    background-color:#ddd;
    background: #ddd;
    background: -moz-linear-gradient(top, #f7f7f7 0%, #dfdfdf 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, #f7f7f7), color-stop(100%, #dfdfdf));
    background: -webkit-linear-gradient(top, #f7f7f7 0%, #dfdfdf 100%);
    background: -o-linear-gradient(top, #f7f7f7 0%, #dfdfdf 100%);
    background: -ms-linear-gradient(top, #f7f7f7 0%, #dfdfdf 100%);
    background: linear-gradient(to bottom, #f7f7f7 0%, #dfdfdf 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f7f7f7', endColorstr='#dfdfdf', GradientType=0 );
    font-weight: bold;
    border: 1px solid #ccc;
    border-radius:3px;
    color:#222;
    cursor: pointer;
}