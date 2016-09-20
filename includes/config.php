<?php
class config{
    //The domain of the website (Without HTTP:// or HTTPS:// and without the slash at the end:
    public $sitedomain = 'vcap.me';
    
    //The main subdomain (like "www." or "")
    public $sitesubdomain = 'www.';
    
    //Is SSL enabled (HTTPS://)?
    public $isSllEnabled = false;
    
    //Website name
    public $siteName = 'Codename WinterBeam';
    
    //Page title prefix
    public $titlePrefix = 'Codename WinterBeam - ';
    
    public $titleSuffix = ' - Codename WinterBeam';
    
    //Database Configuration:
        //Database hostname:
        public $databasehostname = 'localhost';
        
        //Database username:
        public $databaseusername = 'root';
        
        //Database password:
        public $databasePassword = '';
        
        //Database name:
        public $databasename = 'zocial';
    
    //Google Webmaster Tools Verification:
    public $GWTver = '';
    
    
    //Bing Webmaster Tools Verification:
    public $BWTver = '';
    
    
    //WOT Verification:
    public $WOTver = '';
    
    public $domainWiProtocol = '';
    function __construct(){
        if ($this->isSllEnabled){
            $this->domainWiProtocol = 'https://' . $this->sitesubdomain . $this->sitedomain;
        }
        else{
            $this->domainWiProtocol = 'http://' . $this->sitesubdomain . $this->sitedomain;
        }
    }
    
    function domainWiProtocolAndSub($subdomain, $ssl = ''){
        if($ssl === ''){
            $ssl = $this->isSllEnabled;
        }
        if ($ssl){
            return 'https://' . $subdomain . $this->sitedomain;
        }
        else{
            return 'http://' . $subdomain . $this->sitedomain;
        }
    }
}

$config = new config();

$db_con = mysql_connect($config->databasehostname, $config->databaseusername, $config->databasePassword); 
	if (!$db_con){
		  die('Could not connect: ' . mysql_error());
	 }
mysql_select_db($config->databasename, $db_con);

// Add a header indicating this is an OAuth server
header('X-XRDS-Location: ' . $config->domainWiProtocol .
     '/services.xrds.php');

// Connect to database
$db = new PDO('mysql:host=' . $config->databasehostname . ';dbname=' . $config->databasename, $config->databaseusername, $config->databasePassword);

// Create a new instance of OAuthStore and OAuthServer
$store = OAuthStore::instance('PDO', array('conn' => $db));
$server = new OAuthServer();
?>