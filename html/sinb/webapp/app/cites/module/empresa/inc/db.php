<?PHP
/**
 * Application database connection settings
 */
$dbSetting = array();
$dbSetting= $appDB;
/**
 * Configuración principal de base de datos
 */
$dbConfig = $dbSetting[0];
$dsn  = $dbConfig["type"].':host='.$dbConfig["server"].';dbname='.$dbConfig["database"].';port='.$dbConfig["port"];
$dbm = newAdoConnection('pdo');
//$dbm->debug = true;
$dbm->setCharset('utf8');
$res = $dbm->connect($dsn,$dbConfig["user"],$dbConfig["password"]);
if(!$res){
    echo "<div style='background:#fffdf7;text-align:center;font-size:17px;padding: 10px;border:1px solid #dd7272;'><span style='color:red;font-family: Arial;'><strong>[ ERROR APP ]</strong><br> Connection</span>";
    print_struc($dbm->ErrorMsg());
    echo "</div>";
    exit;
}
$dbm->SetFetchMode(ADODB_FETCH_ASSOC);
$ADODB_QUOTE_FIELDNAMES = 'NATIVE';
/**
 * Other connections
 */


