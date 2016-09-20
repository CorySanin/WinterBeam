<?php
$root = $_SERVER['DOCUMENT_ROOT'];

include $root . "/includes/include.php";

if(isset($_GET['user']) && $_GET['user'] != ''){
    $member = $useriface->getuser($_GET['user']);
    if($_GET['type'] == background)
        $imagelocation = $root . '/uploads/backgrounds/' . $member['background'];
    else
        $imagelocation = $root . '/uploads/avatars/' . $member['avatar'];
    header("Content-type: image/jpeg");
    $image=imagecreatefromjpeg($imagelocation);
    imagejpeg($image);
}
?>