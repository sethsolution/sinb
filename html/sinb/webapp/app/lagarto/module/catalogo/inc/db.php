<?PHP
/**
 * Application database connection settings
 */
$dbSetting = array();
$dbSetting[]= $coreDB;
/*
$dbSetting[]=[
    "type" =>"",
    "server" => "",
    "user"=> "",
    "password" => "",
    "database" => "",
    "port" => "",
];
*/

/*
$dbm->debug = true;
$dbm->Connect($dbSetting[0]["server"],$dbSetting[0]["user"] ,$dbSetting[0]["password"],$dbSetting[0]["database"]) or die("ERROR CONNECT " . $dbSetting[0]["database"]);
$dbm->setCharset('utf8');
$dbm->SetFetchMode(ADODB_FETCH_ASSOC);
*/
$dbm = $db;
/**
 * Other connections
 */


