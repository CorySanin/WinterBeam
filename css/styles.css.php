<?php
header('Cache-Control: max-age=2592000'); //30days (60sec * 60min * 24hours * 30days)
header('Content-Type: text/css');
$colors = array(
    'zunePink'      => '#ec008c',
    'outline'       => '#EEEEEE',
    'navLink'       => '#888888',
    'navLinkHover'  => '#000000',
    'link'          => '#8e8e8e'
);
?>

/*<tags>*/
body {
    margin: 0;
    text-decoration: none;
    font-family: Segoe UI, Trebuchet, Arial, Sans-Serif;
    font-weight: normal;
    text-decoration: none;
}
a{
    color:<?php echo $colors['link'] ?>;
    text-decoration:none;
}
a:hover{
    color:<?php echo $colors['zunePink'] ?>;
}
#TopNav a{
    display:inline-block;
    padding:8px;
    color:<?php echo $colors['navLink'] ?>;
}
#TopNav a:hover{
    background-color:rgba(255, 255, 255, 1);
    border-radius:4px;
    color:<?php echo $colors['navLinkHover'] ?>;
    text-decoration:none;
}
#TopNav ul li{
    display:inline;
}
#usernav img{
    width:32px;
    height:32px;
    float:right;
    margin-left:16px;
}

/*.classes*/
.columnize{
    margin:auto;
    width:80%;
}
.displayNone{
    display:none;
}
.top-padding{
    padding-top:20px;
}
.center{
    text-align:center;
}

/*#IDs*/
#header{
    position:relative;
    margin-top:20px;
    padding-bottom:8px;
    border-bottom:<?php echo $colors['outline'] ?> 1px solid;
}
#headerlogo{
    float:left;
}
#TopNav{
    display:inline-block;
}
#usernav{
    float:right;
    line-height:32px;
    height:32px;
}