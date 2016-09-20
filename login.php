<?php
//log in doesn't do anything yet

session_start();
$root = $_SERVER['DOCUMENT_ROOT'];

$page['type'] = 'login';
$page['title'] = 'Log In';

include $root . "/includes/include.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include $root . "/includes/dochead.php"; ?>
    </head>
    <body>
        <div class="center top-padding">
            <a href="<?php echo $config->domainWiProtocol; ?>/">
                <img src="<?php echo $config->domainWiProtocol; ?>/assets/logo/CodenameWinterBeam.png" />
            </a>
        </div>
        <div style="width:200px;margin:auto;padding-top:30px;">
            <form method="post">
                <h1>Sign In</h1>
                <label class="displayNone" for="loginname">ZuneTag or Email</label>
                <input type="text" class="textinput" id="loginname" name="username" placeholder="ZuneTag or Email" required="required" /><br/>
                <label class="displayNone" for="loginpass">Password</label>
                <input type="password" class="textinput" id="loginpass" name="password" placeholder="Password" required="required" /><br/>
                <input class="button" type="submit" id="signin" value="Sign In" name="submit" />
            </form>
        </div>
    </body>
</html>