<?
/**
 * configuraci�n de conexion a base de datos
 */
class ConfigUser{
	var $dbType        = "mysqli";
    var $dbServer       = "127.0.0.1";
    var $dbUser         = "gadc"; 
	var $dbPassword     = "5843d58e";
    //var $dbDatabase     = "gadc_egobierno";
    var $dbDatabase     = "gadc_saig";
	var $prefix     = "gadc_";
    var $data = "./data/";
    var $debug         = false; 
 }
global $dbs;
global $configUser;
$configUser = new ConfigUser;
$dbs = &ADONewConnection($configUser->dbType);
$dbs->Connect($configUser->dbServer,$configUser->dbUser, $configUser->dbPassword, $configUser->dbDatabase);
//$db->Execute("SET NAMES latin1");
if ($configUser->debug){
	$dbs->debug = true;
}
