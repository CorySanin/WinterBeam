<?php
require($root . "/includes/PHPMailer/class.phpmailer.php");

class userInterface{
    private $config;
    private $dbname;
    
    function __construct() {
        $config = new config();
        $dbname = $config->databasename;
    }//end of constructor
    
    //****************************************************************************
    
    function makeStringSafe($string){
        $changes = array(
            "'" => "\'",
            '<' => '\<',
            '>' => '\>',
            '´' => '\`');
        return strtr($string, $changes);
    }//end of makeStringSafe()

    //****************************************************************************

    function makeStringHtmlSafe($string){
        $changes = array(
            "'" => "&#39;",
            '"' => "&#34;",
            '<' => '&#60;',
            '>' => '&#62;',
            '´' => '&#180;');
        return strtr($string, $changes);
    }//end of makeStringHtmlSafe()

    //****************************************************************************

    function useridquery($userid){
        $userid = $this->makeStringSafe($userid);
        
        $user_query = mysql_query("SELECT * FROM `users` WHERE `ID` ='" . $userid . "'");
        if (mysql_num_rows($user_query) == 1){
            $user = mysql_fetch_array($user_query);
            if($user['ID'] === $userid){
                return $user;
            }
            else{
                return false;
            }
        }
        else return false;
    }//end of useridquery()

    //****************************************************************************

    function usernamequery($username){
        $username = $this->makeStringSafe($username);
        
        $user_query = mysql_query("SELECT * FROM `users` WHERE `zuneTag` = '" . $this->makeStringSafe($username) . "'");
        if (mysql_num_rows($user_query) == 1){
            return mysql_fetch_array($user_query);
        }
        else return false;
    }//end of usernamequery()

    //****************************************************************************

    function emailquery($email){
        $email = $this->makeStringSafe($email);
        
        $user_query = mysql_query("SELECT * FROM `users` WHERE `email` = '" . $this->makeStringSafe($email) . "'");
        if (mysql_num_rows($user_query) == 1){
            return mysql_fetch_array($user_query);
        }
        else return false;
    }//end of emailquery()

    //****************************************************************************

    function guidquery($guid){    
        $user_query = mysql_query("SELECT * FROM `users` WHERE `guid` = '" . $this->makeStringSafe($guid) . "'");
        if (mysql_num_rows($user_query) == 1){
            return mysql_fetch_array($user_query);
        }
        else return false;
    }//end of guidquery()

    //****************************************************************************

    function xuidquery($xuid){    
        $user_query = mysql_query("SELECT * FROM `users` WHERE `xuid` = '" . $this->makeStringSafe($xuid) . "'");
        if (mysql_num_rows($user_query) == 1){
            return mysql_fetch_array($user_query);
        }
        else return false;
    }//end of xuidquery()

    //****************************************************************************

    function getUser($user){
        if ($this->useridquery($user) <> false){
            //user is using an ID, for some reason
            return $this->useridquery($user);
        }
        elseif ($this->usernamequery($user) <> false){
            //user is using a username
            return $this->usernamequery($user);
        }
        elseif ($this->emailquery($user) <> false){
            //user is using an email
            return $this->emailquery($user);
        }
        else return false;
    }//end of getUser()
    
    //****************************************************************************
    
    function searchUsers($search){
        $search = $this->makeStringSafe($search);
        
        $user_query = mysql_query("SELECT * FROM `users` WHERE  `zuneTag` LIKE  '%" . $search . "%' or `name` LIKE '%" . $search . "%' LIMIT 0 , 30");
        return $user_query;
    }//end of searchUsers()

    //****************************************************************************

    function getNewestMember(){
        $user_query = mysql_query("SELECT * FROM `users` ORDER BY `ID` DESC limit 0,1");
        if (mysql_num_rows($user_query) == 1){
            return mysql_fetch_array($user_query);
        }
    }

    //****************************************************************************

    function tryLogin($user, $password){
        if ($this->getUser($user) <> false){
            $userdata = $this->getUser($user);
            if ($this->pbkdf2($password, $userdata['salt']) == $userdata['password']){
                if($userdata['activated'] == 1){
                    return true;
                }
                else{
                    return 2;
                }
            }
            else{
                return 3;
            }
        }
        else return 4;
    }//end of tryLogin()

    //****************************************************************************

    function login($user){
        if ($this->getuser($user) <> false){
            if($this->getuser($user)['activated'] == 0){
                $this->logOut();
                return false;
            }
            $userdata = $this->getuser($user);
            $_SESSION['id'] = $userdata['ID'];
            return $userdata;
        }
        else{
            $this->logOut();
            return false;
        }
    }//end of tryLogin()

    //****************************************************************************

    function createUser($name, $gamertag, $email, $password){
        $config = new config();
        $dbname = $config->databasename;
        
        $name = $this->makeStringSafe($name);
        $gamertag = $this->makeStringSafe($gamertag);
        $email = $this->makeStringSafe($email);

        if ($this->usernamequery($gamertag) == false){
            if($this->emailquery($email) == false){
                if (strlen($password) >= 6){

                    //mysql_query("INSERT INTO  `" . $dbname . "`.`scores` (`numPlayed64`)VALUES (0);") or die(mysql_error());

                    $salt = $this->rand_string(18);

                    return mysql_query("INSERT INTO  `" . $dbname . "`.`users` (`name` ,`zuneTag` ,`email` ,`password` ,`salt`)VALUES ('" . $name . "',  '" . $gamertag . "',  '" . $email . "',  '" . $this->pbkdf2($password, $salt) . "',  '" . $salt . "');") or die(mysql_error());
                }
                else{
                    return 2;
                }
            }
            else{
                return 3;
            }
        }
        else{
            return 4;
        }
    }//end of createUser()

    //****************************************************************************
    
    /*function getMedals($username){
        $user = $this->getuser($username);
        
        if($user != false){
            $medal_query = mysql_query("SELECT `medals`.* FROM `usermedals` LEFT JOIN `medals` ON `usermedals`.`medalID` = `medals`.`ID` WHERE `userID` = " . $user['ID'] . ' ORDER BY `usermedals`.`ID` DESC LIMIT 0 , 30');
            if (mysql_num_rows($medal_query) > 0){
                //return mysql_fetch_array($medal_query);
                return $medal_query;
            }
            else return false;
        }
    }//end of getMedals()*/
    
    //****************************************************************************
    
    /*function userhavemedal($username,$medalid){
        $user = $this->getuser($username);
        
        if($user != false && is_int($medalid)){
            $medal_query = mysql_query("SELECT `ID` FROM `usermedals` WHERE `userID` = " . $user['ID'] . ' AND `medalID` = ' . $medalid);
            if (mysql_num_rows($medal_query) == 1){
                return true;
            }
            else return 1;
        }
        else return false;
    }//end of userhavemedal()*/
    
    //****************************************************************************
    
    /*function awardMedal($username,$medalid){
        $config = new config();
        $dbname = $config->databasename;
        
        $result = $this->userhavemedal($username,$medalid);
        if($result === true){
            return true;
        }
        elseif($result === 1){
            $user = $this->getuser($username);
            mysql_query("INSERT INTO  `" . $dbname . "`.`usermedals` (`userID` ,`medalID`)VALUES ('" . $user['ID'] . "',  '" . $medalid . "');") or die(mysql_error());
            return true;
        }
        else return false;
    }//end of awardMedal()*/
    
    //****************************************************************************
    
    /*function getmedalearners($id){
        $id = $this->makeStringSafe($id);
        
        try{
            $id = intval($id);
        }
        catch (Exception $e) {
        }
        if (is_int($id)){
            $medal_query = mysql_query("SELECT * FROM `usermedals` LEFT JOIN `users` ON `usermedals`.`userID` = `users`.`ID` WHERE `medalID` =" . $id . " ORDER BY  `usermedals`.`ID` DESC");
            return $medal_query;
        }
        else return false;
    }//end of getmedalearners()*/
    
    //****************************************************************************
    
    /*function deleteUser($user){
        $config = new config();
        $dbname = $config->databasename;
        
        if ($this->getuser($user) <> false){
            $userdata = $this->getuser($user);
            $result = mysql_query("DELETE FROM `" . $dbname . "`.`users` WHERE `users`.`ID` = " . $userdata['ID']);
            return $result;
        }
        else return false;
    }//end of deleteUser()*/
    
    //****************************************************************************

    function changeUserData($user, $col, $value){
        $config = new config();
        $dbname = $config->databasename;
        
        $value = $this->makeStringSafe($value);
        
        $table = 'users';
        $idfield = 'ID';
        
        if ($this->getUser($user) <> false){
            $col_query = mysql_query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '" . $dbname . "' AND TABLE_NAME = '" . $table . "' AND COLUMN_NAME = '" . $col . "'");
            if (mysql_num_rows($col_query) == 1){
                return mysql_query("UPDATE  `" . $dbname . "`.`" . $table . "` SET  `" . $col . "` =  '" . $value . "' WHERE  `" . $table . "`.`" . $idfield . "` =  '" . $this->getUser($user)['ID'] . "';");
            }
            else return false;
        }
        else return false;
    }//end of changeUserData()

    //****************************************************************************

    function updatePassword($user, $newpass){
        if ($this->getUser($user) <> false){
            $salt = $this->rand_string(18);
            $this->changeUserData($user, 'salt', $salt);
            return $this->changeUserData($user, 'password', $this->pbkdf2($newpass, $salt));
        }
        else return false;
    }//end of changeUserData()
    
    //****************************************************************************
    
    function confirmEmail($user){
        if ($this->getUser($user) <> false){
            $userdata = $this->getUser($user);
            if ($userdata['veremail'] != 1){
                
                if ($userdata['verCode'] == ''){
                    $code = md5(date(DATE_RSS));
                    $this->changeUserData($user, 'verCode', $code);
                }
                else{
                    $code = $userdata['verCode'];
                }

                $config = new config();
                $mail = new PHPMailer();

                $mail->IsSMTP();  // telling the class to use SMTP
                $mail->IsHTML(true); //Is html. Yes.
                $mail->Host     = "so2.infinitysrv.com"; // SMTP server
                $mail->SMTPAuth = true;     // turn on SMTP authentication
                $mail->SMTPSecure = "tls"; //USE IT because I said so
                $mail->Username = 'no-reply@plattevillesmash.com';  // a valid email here
                $mail->Password = 'y@u%FPlgz-=}N+#';  // the password from email
                $mail->SetFrom('no-reply@plattevillesmash.com','Platteville Smash'); // email and name sent from
                $mail->AddReplyTo('no-reply@plattevillesmash.com', 'Platteville Smash');

                $mail->AddAddress($userdata['email'],$userdata['name']); //

                $mail->Subject  = "Welcome to Platteville Smash - Verify Email";

                //$mail->AddEmbeddedImage($root . "/images/textLogo_RasterSmall.png", 'spicelogo', 'textLogo_RasterSmall.png');

                $mail->Body = '<html style="background-color: #231f20;height: 100%;color: #fff;font-family: Arial, Helvetica, sans-serif;padding: 0px;margin: 0px;">
                              <head>
                                <title>Platteville Smash - Verify Email</title>
                              </head>
                              <body style="background-color: #231f20;height: 100%;color: #fff;font-family: Arial, Helvetica, sans-serif;padding: 0px;margin: 0px;">
                                <div id="container" style="background-color: #000;width: 80%;margin: auto;min-height: calc(100% - 30px);">
                                  <div id="logoContainer" style="text-align: center;width: 90%;margin: auto;margin-bottom: 25px;">
                                    Spice Club
                                  </div>
                                  <div id="content" style="width: 90%;margin: auto;line-height: 35px;font-size: 16pt;padding-bottom: 35px;">
                                    Hello, ' . $userdata['name'] . '<br>
                                    Your Platteville Smash account has been created. Before you can do anything else, you must verify this email address. Please click the button to verify this address.
                                    <div id="buttonHolder" style="text-align: center;margin-top: 25px;margin-bottom: 30px;">
                                      <a class="button yellow" href="' . $config->domainWiProtocol . '/?action=verifyemail&user=' . $userdata['ID'] . '&code=' . $code . '" style="position: relative;padding: 10px 15px;margin: 2px;font-size: 16pt;background-color:#000;font-weight: bold;border: 2px solid;cursor: pointer;text-decoration: none;color: #fff200;border-color: #fff200;">Verify</a>
                                    </div>
                                    By clicking "Verify," you are agreeing to the terms of use.<br/>If you did not sign up for Platteville Smash, please ignore this message. Sorry.<br>
                                  </div>
                                </div>
                                <div id="footer" style="text-align: center;margin-top: 12px;color: #888;">
                                  Do not respond to this email.
                                </div>
                              </body>
                            </html>';

                $mail->AltBody = 'Hello, ' . $userdata['name'] . '. Your email needs to be verified. Please paste the following address in the address bar of your browser.  ' . $config->domainWiProtocol . '/?action=verifyemail&user=' . $userdata['ID'] . '&code=' . $code;

                $mail->Send();

                return true;
            }
            else return false;
        }
        else return false;
    }//end of confirmEmail()
    
    //****************************************************************************
    
    function checkEmail($user, $code){
        if ($this->getUser($user) <> false){
            $userdata = $this->getUser($user);
            $code = $this->makeStringSafe($code);
            if ($code == $userdata['verCode']){
                $this->changeUserData($user, 'verCode', '');
                $this->changeUserData($user, 'veremail', 1);
                return true;
            }
            else return false;
        }
        else return false;
    }//end of checkEmail()
    
    //****************************************************************************
    
    function resetPassword($useremail){
        if($this->emailquery($useremail) <> false){
            $userdata = $this->emailquery($useremail);
            if ($userdata['veremail'] == 1){
                $basewords = array('watermelon','summer','gamecube','nintendo','science','program','baloon','smash','future');
                $rand1 = rand(0,8);
                $rand2 = rand(10,99);
                $newpassword = $basewords[$rand1] . $rand2;
                if($newpassword != ''){
                    
                    
                    
                    $config = new config();
                    $mail = new PHPMailer();

                    $mail->IsSMTP();  // telling the class to use SMTP
                    $mail->IsHTML(true); //Is html. Yes.
                    $mail->Host     = "so2.infinitysrv.com"; // SMTP server
                    $mail->SMTPAuth = true;     // turn on SMTP authentication
                    $mail->SMTPSecure = "tls"; //USE IT because I said so
                    $mail->Username = 'no-reply@plattevillesmash.com';  // a valid email here
                    $mail->Password = 'y@u%FPlgz-=}N+#';  // the password from email
                    $mail->SetFrom('no-reply@plattevillesmash.com','Platteville Smash'); // email and name sent from
                    $mail->AddReplyTo('no-reply@plattevillesmash.com', 'Platteville Smash');

                    $mail->AddAddress($userdata['email'],$userdata['name']); //

                    $mail->Subject  = "Platteville Smash - New Password";

                    $mail->Body = '<html style="background-color: #231f20;height: 100%;color: #fff;font-family: Arial, Helvetica, sans-serif;padding: 0px;margin: 0px;">
                                  <head>
                                    <title>Platteville Smash - New Password</title>
                                  </head>
                                  <body style="background-color: #231f20;height: 100%;color: #fff;font-family: Arial, Helvetica, sans-serif;padding: 0px;margin: 0px;">
                                    <div id="container" style="background-color: #000;width: 80%;margin: auto;min-height: calc(100% - 30px);">
                                      <div id="logoContainer" style="text-align: center;width: 90%;margin: auto;margin-bottom: 25px;">
                                        Spice Club
                                      </div>
                                      <div id="content" style="width: 90%;margin: auto;line-height: 35px;font-size: 16pt;padding-bottom: 35px;">
                                        Hello, ' . $userdata['name'] . '<br>
                                        Your Platteville Smash account password has been reset. Your new password is ' . $newpassword . '. Use this password to log in to change your password.
                                      </div>
                                    </div>
                                    <div id="footer" style="text-align: center;margin-top: 12px;color: #888;">
                                      Do not respond to this email.
                                    </div>
                                  </body>
                                </html>';

                    $mail->AltBody = 'Hello, ' . $userdata['name'] . '. Your Platteville Smash account password has been reset. Your new password is ' . $newpassword . '. Use this password to log in to change your password.';

                    $mail->Send();
                    
                    
                    
                    return $this->updatePassword($userdata['username'],$newpassword);
                }
                else
                    return false;
            }
            else return 2;
        }
        else return 3;
    }//end of resetPassword()
    
    //****************************************************************************
    
    function logOut(){
        unset($_SESSION['id']);
        return true;
    }//end of logOut()
    
    //****************************************************************************
    
    function pbkdf2($password, $salt, $algorithm = 'md5', $count = 5000, $key_length = 32, $raw_output = false){
        if(!in_array($algorithm, hash_algos(), true)) {
            exit('pbkdf2: Hash algoritme is niet geinstalleerd op het systeem.');
        }

        if($count <= 0 || $key_length <= 0) {
            $count = 20000;
            $key_length = 128;
        }

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for($i = 1; $i <= $block_count; $i++) {
            $last = $salt . pack("N", $i);
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            for ($j = 1; $j < $count; $j++) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        if($raw_output) {
            return substr($output, 0, $key_length);
        }
        else {
            return base64_encode(substr($output, 0, $key_length));
        }
    }//end of pbkdf2()
    
    //****************************************************************************
    
    function rand_string($length){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

        $size = strlen($chars);
        for($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }//end of rand_string()
}//end of pcInterface class
$useriface = new userInterface();
?>